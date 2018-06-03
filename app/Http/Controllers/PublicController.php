<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Http\Cookie;
use App\Models\Slider;
use App\Models\News;
use App\Models\Project;
use App\Models\Product;
use App\Models\CatNew;
use App\Models\Category;
use App\Models\Introduce;
use App\Models\District;
use App\Models\Village;
use App\Models\Street;
use App\Models\UnitPrice;
use App\Models\TypePost;
use App\Models\Post;
use App\Models\Poster;
use App\Models\User;
use App\Models\Consult;
use App\Models\Contact;
use App\Models\Announcement;
use App\Models\AnnouncementRecieves;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use App\Http\Requests\PostCreateRequest;
use App\Http\Requests\ContactCreateRequest;

class PublicController extends Controller
{
	public function __construct()
	{
		$catNews= CatNew::where('active', 1)->get();
		$bdsBan= Category::where('type_transaction', Category::TYPETRANSACTION['sale'])->get();
		$bdsChoThue= Category::where('type_transaction', Category::TYPETRANSACTION['lease'])->get();
		view()->share('catNews',$catNews);
		view()->share('bdsBan',$bdsBan);
		view()->share('bdsChoThue',$bdsChoThue);
	} 

    // index
	public function index()
	{
		$sliders = Slider::where('active', 1)->get();
		$featureNews = News::where('active', 1)->orderBy('view', 'desc')
		->orderBy('created_at', 'desc')
		->take(2)
		->get();

		$news = News::where('active', 1)->orderBy('view', 'desc')
		->orderBy('view', 'desc')
		->skip(2)
		->take(3)
		->get();

		$projects = Project::where('status', '!=', Project::STATUS['stop'])
		->orderBy('created_at', 'DESC')->get();
		return view('public.trangchu', ['sliders' => $sliders, 'news' => $news, 'featureNews' => $featureNews, 'projects' => $projects]);
	}

	// gioithieu
	public function gioithieu()
	{
		$list = Introduce::where('active', 1)->get();
		return view('public.gioithieu', ['list' => $list]);
	}

	// duan
	public function duan()
	{
		$list = Project::where('status', '!=', Project::STATUS['stop'])
		->orderBy('created_at', 'DESC')->paginate(6);
		return view('public.duan', ['list' => $list]);
	}

    // gioithieu
	public function chitietduan($name, $id)
	{
		$obj = Project::find($id);
		$nameCookie = getNameCookie('project', $id);
		if (!checkCookie($nameCookie)) {
			setcookie($nameCookie, $nameCookie, time() + 5);
			$obj->increment('view');
		} 
		$featureProjects = Project::where('id','!=',$obj->id)
		->orderBy('view', 'desc')
		->orderBy('created_at', 'desc')
		->take(5)
		->get();

		$product = Product::select([
			\DB::raw('count(distinct(block)) as block'),
			\DB::raw('count(distinct(land)) as land'),
			\DB::raw('sum(case when apartment is NULL then 0 else apartment end) as apartment'),
			\DB::raw('count(case when floor = 0 and apartment = 0 then 1 else NULL end) as another'),
		])->where('project_id', $id)->first();

		$report = Transaction::select([
			\DB::raw('count(transactions.id) as total'),
			\DB::raw('count(case when transactions.status = 0 then 1 else NULL end) as sum_processing'),
			\DB::raw('count(case when transactions.status = 1 then 1 else NULL end) as sum_registered'),
			\DB::raw('count(case when transactions.status = 2 then 1 else NULL end) as sum_deposit'),
			\DB::raw('count(case when transactions.status = 3 then 1 else NULL end) as sum_payment'),
		])->join('registers', 'registers.id', 'transactions.register_id')
		->where('registers.project_id', $id)->first();
		return view('public.chitietduan', ['obj' => $obj, 'featureProjects' => $featureProjects, 'report' => $report, 'product' => $product]);
	}

// gioithieu
	public function sanphamduan($id)
	{
		$project = Project::find($id);
		$list = Product::where('project_id', $id)->orderBy('id')->get();
		$cats = Category::where('type_transaction', Category::TYPETRANSACTION['sale'])
		->pluck('name', 'id')->toArray();

		$directions = Product::DIRECTION;
		$prices = [
			'Thỏa thuận',
			'< 500 triệu',
			'500 - 800 triệu',
			'800 - 1 tỷ',
			'1 - 5 tỷ',
			'> 5 tỷ'
		];
		$areas = [
			'Không xác định',
			'<= 30 m2',
			'30-80 m2',
			'80-150 m2',
			'150-300 m2',
			'300-500 m2',
			'> 500 m2',
		];
		$statuses = [
			0 => 'Hết hàng',
			1 => 'Còn hàng'
		];
		return view('public.sanphamduan', [
			'list' => $list,
			'project' => $project,
			'cats' => $cats,
			'prices' => $prices,
			'areas' => $areas,
			'statuses' => $statuses,
			'directions' => $directions,
		]);
	}

	// searchTransaction
	public function timkiemsanphamduan(Request $request)
	{
		$product = Product::where('project_id', $request->projectId);
		$project = Project::find($request->projectId);
		$cats = Category::where('type_transaction', Category::TYPETRANSACTION['sale'])
		->pluck('name', 'id')->toArray();

		$directions = Product::DIRECTION;
		$prices = [
			'Thỏa thuận',
			'< 500 triệu',
			'500 - 800 triệu',
			'800 - 1 tỷ',
			'1 - 5 tỷ',
			'> 5 tỷ'
		];
		$areas = [
			'Không xác định',
			'<= 30 m2',
			'30-80 m2',
			'80-150 m2',
			'150-300 m2',
			'300-500 m2',
			'> 500 m2',
		];
		$statuses = [
			0 => 'Hết hàng',
			1 => 'Còn hàng'
		];

		if ($request->cat_id != -1) {
			$product = $product->where('cat_id', $request->cat_id);
		}

		if ($request->area != -1) {
			switch ($request->area) {
				case 0: $product = $product->where('area', 0);
				break;
				case 1: $product = $product->where('area', '<=', 30);
				break;
				case 2: $product = $product->whereBetween('area', [30, 80]);
				break;
				case 3: $product = $product->whereBetween('area', [80, 150]);
				break;
				case 4: $product = $product->whereBetween('area', [150, 300]);
				break;
				case 5: $product = $product->whereBetween('area', [300, 500]);
				break;
				case 6: $product = $product->where('area', '>', 500);
				break;
			}
		}

		if ($request->price != -1) {
			switch ($request->price) {
				case 0: $product = $product->where('unit_price_id', 1);
				break;
				case 1: $product = $product->where('unit_price_id', 2)->where('price', '<', 500);
				break;
				case 2: $product = $product->where('unit_price_id', 2)->whereBetween('price', [500, 800]);
				break;
				case 3: $product = $product->where(function ($query) {
					$query->where('unit_price_id', 2)
					->whereBetween('price', [800, 999]);
				})->orWhere(function ($query) {
					$query->where('unit_price_id', 3)
					->where('price', 1);
				});
				break;
				case 4: $product = $product->where('unit_price_id', 3)
				->whereBetween('price', [1, 5]);
				break;
				case 5: $product = $product->where('unit_price_id', 3)
				->where('price', '>', 5);
				break;
			}
		}

		if ($request->status != -1) {
			$product = $product->where('status', $request->status);
		}

		if ($request->direction != -1) {
			$product = $product->where('direction', $request->direction);
		}

		$list = $product->get();
		$search = [
			'price' => $request->price,
			'direction' => $request->direction,
			'status' => $request->status,
			'area' => $request->area,
			'cat_id' => $request->cat_id,
		];

		return view('public.sanphamduan', [
			'list' => $list,
			'project' => $project,
			'cats' => $cats,
			'prices' => $prices,
			'areas' => $areas,
			'statuses' => $statuses,
			'directions' => $directions,
			'search' => $search
		]);
	}

	// gioithieu
	public function tinhtrangduan($id)
	{
		$status = getListStatusTransactionVN();
		$obj = Project::find($id);
		$products = Product::where('project_id', $id);
		$blocks = array_unique($products->pluck('block')->toArray());
		$transactions = Transaction::select('transactions.*')->join('products', 'products.id', 'transactions.product_id')
		->join('projects', 'products.project_id', 'projects.id')
		->where('projects.id', $id)->get();

		return view('public.tinhtrangduan', ['obj' => $obj, 'products' => $products->get(), 'transactions' => $transactions, 'status' => $status, 'blocks' => $blocks]);
	}

	   // detail purchase transaction
	public function getBlockByProject(Request $request)
	{
		$blocks = Product::where('project_id', $request->projectId)
		->pluck('block')->toArray();

		echo json_encode(array_unique($blocks));

	}

    // detail purchase transaction
	public function getLandByBlock(Request $request)
	{
		$lands = Product::where('project_id', $request->projectId)
		->where('block', $request->block)
		->pluck('land')->toArray();

		echo json_encode($lands);

	}

    // detail purchase transaction
	public function getFloorByLand(Request $request)
	{
		$floor = Product::where('project_id', $request->projectId)
		->where('block', $request->block)
		->where('land', $request->land)->first()->floor;
		$floors = ($floor) ? range(1, $floor) : 0;
		echo json_encode($floors);
	}

	public function timgiaodich(Request $request)
	{
		$transaction = Transaction::select('transactions.*')
		->join('products', 'products.id', 'transactions.product_id')
		->where('products.project_id', $request->projectId);
		$blocks = $lands = $floors = [];
		$blocks = array_unique(Product::where('project_id', $request->projectId)
			->pluck('block')->toArray());
		if ($request->block != -1) {
			$transaction = $transaction->where('products.block', $request->block);

			$lands = Product::where('project_id', $request->projectId)
			->where('block', $request->block)
			->pluck('land')->toArray();
		}

		if ($request->land != -1) {
			$transaction = $transaction->where('land', $request->land);


			$floor = Product::where('project_id', $request->projectId)
			->where('block', $request->block)
			->where('land', $request->land)->first()->floor;
			$floors = ($floor) ? range(1, $floor) : [];

		}

		if ($request->floor != -1) {
			$transaction = $transaction
			->join('apartments', 'apartments.id', 'transactions.apartment_id')
			->where('apartments.floor', $request->floor);
		}

		if ($request->status != -1) {
			$transaction = $transaction->where('transactions.status', $request->status);
		}

		$status = getListStatusTransactionVN();
		$obj = Project::find($request->projectId);
		$products = Product::where('project_id', $obj->id)->get();
		$transactions = $transaction->get();
		$search = [
			'block' => $request->block,
			'floor' => $request->floor,
			'land' => $request->land,
			'status' => $request->status,
		];

		return view('public.tinhtrangduan', ['obj' => $obj, 'products' => $products, 'transactions' => $transactions, 'status' => $status, 'search' => $search, 'floors' => $floors, 'lands' => $lands, 'blocks' => $blocks]);

	}

 // gioithieu
	public function chitietsanpham($id)
	{
		$obj = Product::find($id);
		$nameCookie = getNameCookie('product', $id);
		if (!checkCookie($nameCookie)) {
			setcookie($nameCookie, $nameCookie, time() + 5);
			$obj->increment('view');
		} 
		$objRelated = Product::where('project_id', $obj->project_id)
		->where('id', '!=', $obj->id)
		->where(function ($query) use ($obj) {
			$query->where('block', $obj->block)
			->orWhere(function ($query) use ($obj) {
				$query->where('price', $obj->price)
				->where('unit_price_id', $obj->unit_price_id);
			});
		})->get();
		return view('public.chitietsanpham', ['obj' => $obj, 'objRelated' => $objRelated]);
	}

    // gioithieu
	public function sangiaodich($type)
	{
		$menu = Category::where('type_transaction', $type)->pluck('name', 'id')->toArray();
		$list = Post::whereIn('cat_id', array_keys($menu))
		->where('end_time', '>=', Carbon::now())
		->where('start_time', '<=', Carbon::now())
		->where('status',Post::STATUS['processed'])
		->whereNull('deleted_at')
		->orderBy('start_time', 'DESC')->paginate(6);
		return view('public.sangiaodich', ['menu' => $menu, 'list' => $list, 'type' => $type]);
	}

	// gioithieu
	public function sangiaodichtheloai($id)
	{
		$cat = Category::find($id);
		$menu = Category::where('type_transaction', $cat->type_transaction)->pluck('name', 'id')->toArray();

		$list = Post::where('cat_id', $id)
		->where('end_time', '>=', Carbon::now())
		->where('start_time', '<=', Carbon::now())
		->where('status',Post::STATUS['processed'])
		->whereNull('deleted_at')
		->orderBy('start_time', 'DESC')->paginate(6);
		return view('public.sangiaodich', ['menu' => $menu, 'list' => $list, 'cat' => $cat]);
	}

    // gioithieu
	public function chitietsanbatdongsan($name, $id)
	{
		$obj = Post::find($id);
		$nameCookie = getNameCookie('post', $id);
		if (!checkCookie($nameCookie)) {
			setcookie($nameCookie, $nameCookie, time() + 5);
			$obj->increment('view');
		} 
		$objRelated = Post::join('categories', 'categories.id', 'posts.cat_id')
		->where('posts.id', '!=', $obj->id)
		->where('end_time', '>=', Carbon::now())
		->where('start_time', '<=', Carbon::now())
		->where('status',Post::STATUS['processed'])
		->whereNull('deleted_at')
		->where(function ($query) use ($obj) {
			$query->where('cat_id', $obj->cat_id)
			->orWhere(function ($query) use ($obj) {
				$query->where('type_transaction', $obj->cat->type_transaction);
			});
		})
		->orderBy('start_time', 'DESC') 
		->take(3)->get();
		return view('public.chitietsanbatdongsan', ['obj' => $obj, 'objRelated' => $objRelated]);
	}


    // gioithieu
	public function tintuc($catId)
	{
		$cat = CatNew::find($catId);
		$list = News::where('cat_new_id', $catId)->paginate(2);
		$featureNews = News::where('active', 1)
		->whereNotIn('id', $list->pluck('id')->toArray())
		->orderBy('view', 'desc')
		->orderBy('created_at', 'desc')
		->take(5)
		->get();
		return view('public.tintuc', ['list' => $list, 'featureNews' => $featureNews, 'cat' => $cat]);
	}

	 // gioithieu
	public function listtintuc()
	{
		$featureNews = News::where('active', 1)
		->orderBy('view', 'desc')
		->orderBy('created_at', 'desc')
		->take(5)
		->get();

		$list = News::where('active', 1)
		->whereNotIn('id', $featureNews->pluck('id')->toArray())
		->orderBy('created_at', 'desc')
		->paginate(2);
		return view('public.tintuc', ['list' => $list, 'featureNews' => $featureNews]);
	}

	// gioithieu
	public function chitiettintuc($name, $id)
	{
		$obj = News::find($id);
		$nameCookie = getNameCookie('news', $id);
		if (!checkCookie($nameCookie)) {
			setcookie($nameCookie, $nameCookie, time() + 5);
			$obj->increment('view');
		} 
		
		$relatedNews = News::where('cat_new_id', $obj->cat_new_id)
		->where('id','!=', $obj->id)
		->orderBy('view', 'desc')
		->orderBy('created_at', 'desc')
		->take(5)
		->get();

		return view('public.chitiettintuc', ['obj' => $obj, 'relatedNews' => $relatedNews]);
	}


    // gioithieu
	public function lienhe()
	{
		return view('public.lienhe');
	}

	// gioithieu
	public function taolienhe(ContactCreateRequest $request)
	{
		$data = $request->all();
		$data['created_at'] = Carbon::now();
		if (Contact::create($data)) {
			return redirect()->route('public.lienhe')->with('success', 'Success');
		} else {
			return redirect()->back()->withInput()->with('error', 'Fail');
		}
	}

    // gioithieu
	public function tuyendung()
	{
		return view('public.tuyendung');
	}

	// gioithieu
	public function dangtin()
	{
		$unitPrice = UnitPrice::where('type_transaction', UnitPrice::TYPETRANSACTION['sale'])->get();
		$district = District::pluck('name', 'id')->toArray();
		$direction = Post::DIRECTION;
		return view('public.dangtin', ['district' => $district, 'unitPrice' => $unitPrice, 'direction' => $direction]);
	}

	// gioithieu
	public function taotin(PostCreateRequest $request)
	{
		$end_time = Carbon::parse($request->end_time);
		$start_time = Carbon::parse($request->start_time);
		if ($end_time->diffInDays($start_time)>14) {
			return redirect()->back()->withInput()->with('error', 'Ngày hết hạn phải lớn hơn thời gian đăng không quá 14 ngày');
		}
		$objCustomer = session()->get('objCustomer'); 
		$data = $request->all();
		$insert = [
			'name' => $data['name'], 
			'description'  => $data['description'],
			'direction' => $data['direction'], 
			'cat_id' => $data['cat_id'], 
			'district_id' => $data['district_id'], 
			'village_id' => $data['village_id'], 
			'street_id' => $data['street_id'], 
			'project' => $data['project_id'] ?? '', 
			'price' => ($data['unit_price_id'] == 1 || $data['unit_price_id'] == 4) ? 0 : $data['price'], 
			'area' => $data['area'], 
			'unit_price_id' => $data['unit_price_id'],
			'frontispiece' => !empty($data['frontispiece']) ? $data['frontispiece'] : 0,
			'road_ahead' => !empty($data['road_ahead']) ? $data['road_ahead'] : 0,
			'number_of_floor' => !empty($data['number_of_floor']) ? $data['number_of_floor'] : 0,
			'number_of_room' => !empty($data['number_of_room']) ? $data['number_of_room'] : 0,
			'number_of_toilet' => !empty($data['number_of_toilet']) ? $data['number_of_toilet'] : 0,
			'furniture' => !empty($data['furniture']) ? $data['furniture'] : '',
			'poster_id' => $objCustomer->poster->id,
			'info_contact' => $data['fullname'] . '|' . $data['address'] . '|' . $data['phone'] . '|' . $data['email'],
			'start_time' => Carbon::parse($request->start_time)->hour(date('H'))->minute(date('i')),
			'end_time' => Carbon::parse($request->end_time)->hour(date('H'))->minute(date('i')),
			'created_at' => Carbon::now(),
		];

		$images = [];
		if ($files = $request->file('images')) {
			if (count($files) > 3) {
				return redirect()->back()->withInput()->with('error', 'Fail');
			}
			if (!empty($files)) {
				foreach ($files as $file) {
					$path = "images/posts/";
					$fileName = str_random('10') . time() . '.' . $file->getClientOriginalExtension();
					$file->move($path, $fileName);
					$imagePath = $path . $fileName;
					$images[] = $imagePath;
				}
				$insert['images'] = implode("|", $images);
			}
		}

		$district = District::find($data['district_id'])->name;
		$village = Village::find($data['village_id'])->name;
		$street = Street::find($data['street_id'])->name;
		$address = $street . ' ' . $village . ' ' . $district;
		$map = getMap($address);
		$insert['map'] = $map['latitude'] . '|' . $map['longitude'];

		if ($posts = Post::create($insert)) {
			return redirect()->route('public.trangcanhan')->with('success', 'Đăng tin thành công');
		} else {
			return redirect()->back()->withInput()->with('error', 'Fail');
		}
	}

	// gioithieu
	public function danglai($id)
	{
		$obj = Post::find($id);
		$end_time = Carbon::parse($obj->end_time);
		$start_time = Carbon::parse($obj->start_time);

		$period = $end_time->diffInDays($start_time);
		$obj->update([
			'start_time' => Carbon::now()->format('Y-m-d H:i'),
			'end_time' => Carbon::now()->addDays($period)->format('Y-m-d H:i'),
		]);
		
		return redirect()->route("public.trangcanhan")->with('success', 'Thành công');
	}

	// gioithieu
	public function suatin($id)
	{
		$obj = Post::find($id);
		$unitPrice = UnitPrice::where('type_transaction', $obj->unitPrice->type_transaction)->pluck('name', 'id')->toArray();
		$district = District::pluck('name', 'id')->toArray();
		$village = Village::where('district_id', $obj->district_id)->pluck('name', 'id')->toArray();
		$street = Street::where('village_id', $obj->village_id)->pluck('name', 'id')->toArray();
		$direction = Post::DIRECTION;
		$infcontact = explode("|",$obj->info_contact);
		$bdsBan = Category::where('type_transaction', $obj->cat->type_transaction)->get();
		return view('public.suatin', [
			'district' => $district,
			'unitPrice' => $unitPrice,
			'direction' => $direction,
			'obj' => $obj,
			'village' => $village,
			'street' => $street,
			'infcontact' => $infcontact,
			'bdsBan' => $bdsBan
		]);
	}

	// cap nhat tin
	public function capnhattin(PostCreateRequest $request)
	{
		$end_time = Carbon::parse($request->end_time);
		$start_time = Carbon::parse($request->start_time);
		if ($end_time->diffInDays($start_time)>14) {
			return redirect()->back()->withInput()->with('error', 'Ngày hết hạn phải lớn hơn thời gian đăng không quá 14 ngày');
		}
		$data = $request->all();
		$objCustomer = session()->get('objCustomer'); 
		$oldObj = Post::find($request->id);
		$update = [
			'name' => $data['name'], 
			'description'  => $data['description'],
			'direction' => $data['direction'], 
			'cat_id' => $data['cat_id'], 
			'district_id' => $data['district_id'], 
			'village_id' => $data['village_id'], 
			'street_id' => $data['street_id'], 
			'project' => $data['project'] ?? '', 
			'price' => ($data['unit_price_id'] == 1 || $data['unit_price_id'] == 4) ? 0 : $data['price'], 
			'area' => $data['area'], 
			'unit_price_id' => $data['unit_price_id'],
			'frontispiece' => !empty($data['frontispiece']) ? $data['frontispiece'] : 0,
			'road_ahead' => !empty($data['road_ahead']) ? $data['road_ahead'] : 0,
			'number_of_floor' => !empty($data['number_of_floor']) ? $data['number_of_floor'] : 0,
			'number_of_room' => !empty($data['number_of_room']) ? $data['number_of_room'] : 0,
			'number_of_toilet' => !empty($data['number_of_toilet']) ? $data['number_of_toilet'] : 0,
			'furniture' => !empty($data['furniture']) ? $data['furniture'] : '',
			'info_contact' => $data['fullname'] . '|' . $data['address'] . '|' . $data['phone'] . '|' . $data['email'],
			'start_time' => Carbon::parse($request->start_time)->hour(date('H'))->minute(date('i')),
			'end_time' => Carbon::parse($request->end_time)->hour(date('H'))->minute(date('i')),
		];

		$images = [];
		if ($files = $request->file('images')) {
			if (count($files) > 3) {
				return redirect()->back()->withInput()->with('error', 'Fail');
			}
			if (!empty($files)) {
				foreach(explode("|", $oldObj->images) as $item) {
					if (!empty($item)) {
						unlink($item);
					}
				}

				foreach ($files as $file) {
					$path = "images/posts/";
					$fileName = str_random('10') . time() . '.' . $file->getClientOriginalExtension();
					$file->move($path, $fileName);
					$imagePath = $path . $fileName;
					$images[] = $imagePath;
				}
				$update['images'] = implode("|", $images);
			}
		}

		$district = District::find($data['district_id'])->name;
		$village = Village::find($data['village_id'])->name;
		$street = Street::find($data['street_id'])->name;
		$address = $street . ' ' . $village . ' ' . $district;
		$map = getMap($address);
		$update['map'] = $map['latitude'] . '|' . $map['longitude'];

		if ($oldObj->update($update)) {
			return redirect()->route('public.trangcanhan')->with('success', 'Cập nhật thành công');
		} else {
			return redirect()->back()->withInput()->with('error', 'Fail');
		}
	}

	// gioithieu
	public function xoatin($id)
	{
		$obj = Post::find($id)->delete();
		return redirect()->route('public.trangcanhan')->with('success', 'Success');
	}

	// gioithieu
	public function dangnhap()
	{
		return view('public.dangnhap');
	}

	// gioithieu
	public function xulydangnhap(Request $request)
	{
		$passWord = md5(trim($request->password));
		$objCustomer = User::where('email', '=', $request->name)
		->Where("password","=",$passWord)->where('active','=',1)->where('role', User::ROLE['customer'])->first();
		if (!empty($objCustomer)) {
			$request->session()->put('objCustomer', $objCustomer);

			return redirect()->route("public.trangcanhan");
		}else{
			return redirect()->route("public.dangnhap")->with('msg','Tài khoản không đúng');
		}
	}


	// gioithieu
	public function dangky()
	{
		return view('public.dangky');
	}

	public function postdangky(Request $request)
	{
		$rules = $this->validate($request,
			[
				'name' => 'required',
				'email' => 'required|email',
				'phone' => 'required|numeric',
				'address' => 'required',
				'password' => 'required',
				'passwordagain' => 'required|same:password',
			],
			[
				'name.required' => 'Name is required',
				'email.required' => 'Email is required',
				'email.email' => 'Email is not valid',
				'phone.required' => 'Phone is required',
				'phone.numeric' => 'Phone must be number',
				'address.required' => 'Address is required',
				'password.required' => 'Password is required',
				'passwordagain.required' => 'Password confirm is required',
				'passwordagain.same' => 'Password and password confirm is not same',
			]
		);

		$data = [
			'email' => $request->email,
			'username' => '',
			'password' => md5($request->password),
			'active' => 1,
			'role' => User::ROLE['customer'],
			'image' => ''
		];

		$user = User::create($data);

		$poster = [
			'name' => $request->name,
			'phone' => $request->phone,
			'address' => $request->address,
			'created_at' => Carbon::now(),
			'user_id' => $user->id,
		];

		if (Poster::create($poster)) {
			return redirect()->route('public.dangky')->with('success', 'Success');
		} else {
			return redirect()->back()->withInput()->with('error', 'Fail');
		}

	}

	// gioithieu
	public function trangcanhan()
	{
		$objCustomer = session()->get('objCustomer');
		$posts = Post::where('poster_id', $objCustomer->poster->id)->get();
		return view('public.trangcanhan', ['posts' => $posts]);
	}

	// gioithieu
	public function timkiemtrangcanhan(Request $request)
	{
		$objCustomer = session()->get('objCustomer');
		$posts = Post::where('poster_id', $objCustomer->poster->id);
		if($request->type != 0) {
			switch ($request->type) {
				case 1:
				$posts = $posts->where('end_time', '>=', Carbon::now())
				->where('start_time', '<=', Carbon::now())
				->where('status',Post::STATUS['processed'])
				->whereNull('deleted_at');
				break;
				case 2:
				$posts = $posts->where('end_time', '<', Carbon::now())
				->where('status',Post::STATUS['processed'])
				->whereNull('deleted_at');
				break;
				case 3:
				$posts = $posts->whereNotNull('deleted_at');
				break;
				case 4:
				$posts = $posts->where('status',Post::STATUS['processing'])
				->whereNull('deleted_at');
				break;
				case 5:
				$posts = $posts->where('status',Post::STATUS['cancel'])
				->whereNull('deleted_at');
				break;
			}
		}
		if ($request->date_from != '') {
			$posts = $posts->where('start_time', '>=', Carbon::parse($request->date_from));
		}

		if ($request->date_to != '') {
			$posts = $posts->where('end_time', '<=', Carbon::parse($request->date_to));
		}

		$posts = $posts->get();
		return view('public.trangcanhan', [
			'posts' => $posts,
			'date_from' => $request->date_from,
			'date_to' => $request->date_to,
			'type' => $request->type
		]);
	}

	public function thaydoithongtincanhan()
	{
		return view('public.thaydoithongtincanhan');
	}

	public function postthaydoithongtincanhan(Request $request)
	{
		$rules = $this->validate($request,
			[
				'name' => 'required',
				'phone' => 'required|numeric',
				'address' => 'required',
			],
			[
				'name.required' => 'Name is required',
				'phone.required' => 'Phone is required',
				'phone.numeric' => 'Phone must be number',
				'address.required' => 'Address is required',
			]
		);

		$data = [
			'name' => $request->name,
			'phone' => $request->phone,
			'address' => $request->address,
		];

		if (Poster::find($request->id)->update($data)) {
			return redirect()->route('public.trangcanhan.thaydoithongtincanhan')->with('success', 'Success');
		} else {
			return redirect()->back()->withInput()->with('error', 'Fail');
		}
	}

	public function thaydoimatkhau()
	{
		return view('public.thaydoimatkhau');
	}

	public function postthaydoimatkhau(Request $request)
	{
		$rules = $this->validate($request,
			[
				'oldpassword' => 'required',
				'newpassword' => 'required',
				'passwordagain' => 'required|same:newpassword',
			],
			[
				'oldpassword.required' => 'Old password is required',
				'newpassword.required' => 'New password is required',
				'passwordagain.required' => 'Password agian is required',
				'passwordagain.required' => 'Password agian and new password is not same',
			]
		);

		$check = User::where('id', $request->id)->where('password', md5($request->oldapassword))->get();
		if (!empty($check[0])) {
			User::find($request->id)->update(['password' => $request->newpassword]);
			return redirect()->route('public.trangcanhan.thaydoimatkhau')->with('success', 'Success');
		} else {
			return redirect()->back()->withInput()->with('error', 'Old password is not correct');
		}
	}

	// gioithieu
	public function chitiettuvan($idPost)
	{
		$list = Consult::where('product_id', $idPost)
		->where('type', Consult::TYPE['post'])
		->orderBy('created_at', 'desc')
		->get();
		return view('public.chitiettuvan', ['list' => $list]);
	}

	// gioithieu
	public function xoatuvan($id)
	{
		$obj = Consult::find($id);
		$obj->delete();
		return redirect()->route('public.trangcanhan.chitiettuvan', ['idPost' => $obj->product_id])->with('success', 'Delete success');
	}

	public function tuvan(Request $request)
	{
		$data = [
			'product_id' => $request->id,
			'name' => $request->name,
			'email' => $request->email,
			'phone' => $request->phone,
			'created_at' => Carbon::now(),
			'type' => Consult::TYPE['post'],
			'message' => ''
		];
		Consult::create($data);
		echo json_encode('ok');
	}

	public function tuvanduan(Request $request)
	{
		$data = [
			'product_id' => $request->id,
			'name' => $request->name,
			'email' => $request->email,
			'phone' => $request->phone,
			'created_at' => Carbon::now(),
			'type' => Consult::TYPE['project'],
			'message' => ''
		];
		Consult::create($data);

		$createAnnouncement = [
			'title' => Announcement::TITLE['customer'],
			'content' => Announcement::CONTENT['customer'],
			'active' => 1,
			'created_at' => Carbon::now()
		];

		$announcement = Announcement::create($createAnnouncement);
		$manager = Employee::join('users', 'employees.user_id', 'users.id')->where('role', User::ROLE['leader'])->pluck('users.id')->toArray();
		foreach ($manager as $id) {
			AnnouncementRecieves::create([
				'announcement_id' => $announcement->id,
				'reciever_id' => $id,
				'is_read' => 0
			]);
		}

		echo json_encode('ok');
	}

	public function tuvansanpham(Request $request)
	{
		$data = [
			'product_id' => $request->projectId,
			'sub_product_id' => $request->productId,
			'name' => $request->name,
			'email' => $request->email,
			'phone' => $request->phone,
			'created_at' => Carbon::now(),
			'type' => Consult::TYPE['project'],
			'message' => ''
		];
		Consult::create($data);

		$createAnnouncement = [
			'title' => Announcement::TITLE['customer'],
			'content' => Announcement::CONTENT['customer'],
			'active' => 1,
			'created_at' => Carbon::now()
		];

		$announcement = Announcement::create($createAnnouncement);
		$manager = Employee::join('users', 'employees.user_id', 'users.id')->where('role', User::ROLE['leader'])->pluck('users.id')->toArray();
		foreach ($manager as $id) {
			AnnouncementRecieves::create([
				'announcement_id' => $announcement->id,
				'reciever_id' => $id,
				'is_read' => 0
			]);
		}

		echo json_encode('ok');
	}

	public function dangkyduan(Request $request)
	{
		$rules = $this->validate($request,
			[
				'name' => 'required|max:50',
				'email' => 'required|email',
				'phone' => 'required|numeric',
				'message' => 'nullable|max:255'
			],
			[
				'name.required' => 'Name is required',
				'name.max' => 'Name is not greater than 50 character',
				'email.required' => 'Email is required',
				'email.email' => 'Email is not valid',
				'phone.required' => 'Phone is required',
				'phone.numeric' => 'Phone must be number',
				'message.max' => 'Message is not greater than 255 character',
			]
		);


		$data = [
			'product_id' => $request->id,
			'name' => $request->name,
			'email' => $request->email,
			'phone' => $request->phone,
			'created_at' => Carbon::now(),
			'type' => Consult::TYPE['project'],
			'message' => $request->message,
		];
		Consult::create($data);

		$createAnnouncement = [
			'title' => Announcement::TITLE['customer'],
			'content' => Announcement::CONTENT['customer'],
			'active' => 1,
			'created_at' => Carbon::now()
		];

		$announcement = Announcement::create($createAnnouncement);
		$manager = Employee::join('users', 'employees.user_id', 'users.id')->where('role', User::ROLE['leader'])->pluck('users.id')->toArray();
		foreach ($manager as $id) {
			AnnouncementRecieves::create([
				'announcement_id' => $announcement->id,
				'reciever_id' => $id,
				'is_read' => 0
			]);
		}
		$obj = Project::find($request->id);
		return redirect()->route('public.chitietduan', ['name' => $obj->name, 'id' => $request->id])->with('success', 'Success');
	}

	public function dangxuat()
	{
		session()->forget('objCustomer');
		return redirect()->route('public.trangchu');
	}

	public function timkiemsangiaodich()
	{
		$lcat = Category::where('type_transaction', Category::TYPETRANSACTION['sale'])
		->pluck('name', 'id')
		->toArray();
		$ldistrict = District::pluck('name', 'id')->toArray();
		$ldirection = Post::DIRECTION;
		$lsort = [
			'Thông thường',
			'Giá thấp nhất',
			'Giá cao nhất',
			'Diện tích nhỏ nhất',
			'Diện tích lớn nhất',
		];
		$larea = [
			'Không xác định',
			'<= 30 m2',
			'30-80 m2',
			'80-150 m2',
			'150-300 m2',
			'300-500 m2',
			'> 500 m2',
		];
		$lroom = [
			'Không xác định',
			'1+',
			'2+',
			'3+',
			'4+',
			'5+',
		];
		$lprice = [
			'Thỏa thuận',
			'< 500 triệu',
			'500 - 800 triệu',
			'800 - 1 tỷ',
			'1 - 5 tỷ',
			'> 5 tỷ'
		];

		$list = Post::where('end_time', '>=', Carbon::now())
		->where('start_time', '<=', Carbon::now())
		->where('status',Post::STATUS['processed'])
		->whereNull('deleted_at')
		->orderBy('created_at', 'desc')
		->whereIn('cat_id', array_keys($lcat))
		->paginate(5);

		foreach ($ldistrict as $key => $value) {
			$report[$key] = Post::where('start_time', '<=', Carbon::now())
			->where('end_time', '>=', Carbon::now())
			->where('status',Post::STATUS['processed'])
			->whereNull('deleted_at')
			->where('district_id', $key)
			->count();
		}
		return view('public.timkiemsangiaodich', [
			'lcat' => $lcat,
			'larea' => $larea,
			'lroom' => $lroom, 
			'lsort' => $lsort, 
			'lprice' => $lprice,
			'ldistrict' => $ldistrict, 
			'ldirection' => $ldirection, 
			'list' => $list,
			'report' => $report
		]);
	}

    // post tim kiem
	public function posttimkiemsangiaodich(Request $request)
	{
		$ldirection = Post::DIRECTION;
		$ldistrict = District::pluck('name', 'id')->toArray();
		$type = $request->type;

		$lcat = Category::where('type_transaction',$type)
		->pluck('name', 'id')
		->toArray();

		$lsort = [
			'Thông thường',
			'Giá thấp nhất',
			'Giá cao nhất',
			'Diện tích nhỏ nhất',
			'Diện tích lớn nhất',
		];
		$larea = [
			'Không xác định',
			'<= 30 m2',
			'30-80 m2',
			'80-150 m2',
			'150-300 m2',
			'300-500 m2',
			'> 500 m2',
		];
		$lroom = [
			'Không xác định',
			'1+',
			'2+',
			'3+',
			'4+',
			'5+',
		];

		$lvillage = $lstreet = [];

		$query = Post::where('end_time', '>=', Carbon::now())
		->where('start_time', '<=', Carbon::now())
		->where('status',Post::STATUS['processed'])
		->whereIn('cat_id', array_keys($lcat))
		->whereNull('deleted_at');

		if ($request->cat != -1) {
			$query = $query->where('cat_id', $request->cat);
		}
		if ($request->area != -1) {
			switch ($request->area) {
				case 0: $query = $query->where('area', 0);
				break;
				case 1: $query = $query->where('area', '<=', 30);
				break;
				case 2: $query = $query->whereBetween('area', [30, 80]);
				break;
				case 3: $query = $query->whereBetween('area', [80, 150]);
				break;
				case 4: $query = $query->whereBetween('area', [150, 300]);
				break;
				case 5: $query = $query->whereBetween('area', [300, 500]);
				break;
				case 6: $query = $query->where('area', '>', 500);
				break;
			}
		}
		if ($request->district != -1) {
			$query = $query->where('district_id', $request->district);
			$village = Village::where('district_id', $request->district)
			->pluck('name', 'id')->toArray();

		}
		if ($request->village != -1) {
			$query = $query->where('village_id', $request->village);

			$street = Street::where('village_id', $request->village)
			->pluck('name', 'id')->toArray();
		}
		if ($request->direction != -1) {
			$query = $query->where('direction', $request->direction);
		}
		if ($request->street != -1) {
			$query = $query->where('street', $request->street);
		}
		
		if ($request->room != -1) {
			switch ($request->room) {
				case 0: $query = $query->where('number_of_room', 0);
				break;
				case 1: $query = $query->where('number_of_room', '>=', 1);
				break;
				case 2: $query = $query->where('number_of_room', '>=', 2);
				break;
				case 3: $query = $query->where('number_of_room', '>=', 3);
				break;
				case 4: $query = $query->where('number_of_room', '>=', 4);
				break;
				case 5: $query = $query->where('number_of_room', '>=', 5);
				break;
				case 6: $query = $query->where('number_of_room', '>=', 6);
				break;
			}
		}
		if ($type == Category::TYPETRANSACTION['sale']) {
			$lprice = [
				'Thỏa thuận',
				'< 500 triệu',
				'500 - 800 triệu',
				'800 - 1 tỷ',
				'1 - 5 tỷ',
				'> 5 tỷ'
			];
			if ($request->price != -1) {
				switch ($request->price) {
					case 0: $query = $query->where('unit_price_id', 1);
					break;
					case 1: $query = $query->where('unit_price_id', 2)->where('price', '<', 500);
					break;
					case 2: $query = $query->where('unit_price_id', 2)->whereBetween('price', [500, 800]);
					break;
					case 3: $query = $query->where(function ($query) {
						$query->where('unit_price_id', 2)
						->whereBetween('price', [800, 999]);
					})->orWhere(function ($query) {
						$query->where('unit_price_id', 3)
						->where('price', 1);
					});
					break;
					case 4: $query = $query->where('unit_price_id', 3)
					->whereBetween('price', [1, 5]);
					break;
					case 5: $query = $query->where('unit_price_id', 3)
					->where('price', '>', 5);
					break;
				}
			}
		} else {
			$lprice = [
				'Thỏa thuận',
				'< 1 triệu',
				'1 - 5 triệu',
				'5 - 10 triệu',
				'10 - 40 triệu',
				'> 40 triệu'
			];
			if ($request->price != -1) {
				switch ($request->price) {
					case 0: $query = $query->where('unit_price_id', 4);
					break;
					case 1: $query = $query->where('unit_price_id', 5)->where('price', '<', 999);
					break;
					case 2: $query = $query->where('unit_price_id', 6)
					->whereBetween('price', [1, 5]);
					break;
					case 3: $query = $query->where('unit_price_id', 6)
					->whereBetween('price', [5, 10]);
					break;
					case 4: $query = $query->where('unit_price_id', 6)
					->whereBetween('price', [10, 40]);
					break;
					case 5: $query = $query->where('unit_price_id', 6)
					->where('price', '>', 40);
					break;
				}
			}
		}
		switch ($request->sort) {
			case 0: $query = $query->orderBy('start_time', 'desc');
			break;
			case 1: $query = $query->orderBy('price', 'desc');
			break;
			case 2: $query = $query->orderBy('price', 'asc');
			break;
			case 3: $query = $query->orderBy('area', 'asc');
			break;
			case 4: $query = $query->orderBy('area', 'desc');
			break;
		}
		$list = $query->orderBy('created_at', 'desc')->paginate(5);
		foreach ($ldistrict as $key => $value) {
			$report[$key] = Post::where('start_time', '<=', Carbon::now())
			->where('end_time', '>=', Carbon::now())
			->where('status',Post::STATUS['processed'])
			->whereNull('deleted_at')
			->where('district_id', $key)
			->count();
		}

		return view('public.timkiemsangiaodich', [
			'list' => $list,
			'type' => $type,
			'cat' => $request->cat,
			'sort' => $request->sort,
			'area' => $request->area,
			'district' => $request->district,
			'price' => $request->price,
			'village' => $request->village,
			'street' => $request->street,
			'room' => $request->room,
			'project' => $request->project,
			'direction' => $request->direction,
			'lcat' => $lcat,
			'larea' => $larea,
			'lroom' => $lroom,
			'lsort' => $lsort,
			'lprice' => $lprice,
			'ldistrict' => $ldistrict,
			'ldirection' => $ldirection,
			'lvillage' => $lvillage,
			'lstreet' => $lstreet,
			'report' => $report
		]);

	}

	public function timkiemduan()
	{
		$status = getListStatusProjectVN();
		$list  = Project::where('status', '!=', Project::STATUS['stop'])->paginate(5);
		$districts = District::pluck('name', 'id')->toArray();

		foreach ($districts as $key => $value) {
			$report[$key] = Project::where('status', '!=', Project::STATUS['stop'])
			->where('district_id', $key)->count();
		}
		return view('public.timkiemduan', ['list' => $list, 'status' => $status, 'districts' => $districts, 'report' => $report]);
	}

	// searchTransaction
	public function posttimkiemduan(Request $request)
	{
		$project =  Project::where('status', '!=', Project::STATUS['stop']);
		$districts = $villages = $streets = [];
		$districts = District::pluck('name', 'id')->toArray();
		foreach ($districts as $key => $value) {
			$report[$key] = Project::where('status', '!=', Project::STATUS['stop'])
			->where('district_id', $key)->count();
		}

		if ($request->district != -1) {
			$project = $project->where('district_id', $request->district);

			$villages = Village::where('district_id', $request->district)
			->pluck('name', 'id')->toArray();
		}

		if ($request->village != -1) {
			$project = $project->where('village_id', $request->village);

			$streets = Street::where('village_id', $request->village)
			->pluck('name', 'id')->toArray();
		}

		if ($request->street != -1) {
			$project = $project->where('street_id', $request->street);
		}

		if ($request->status != -1) {
			$project = $project->where('status', $request->status);
		}

		$status = getListStatusProjectVN();

		$list = $project->paginate(5);
		$search = [
			'district' => $request->district,
			'village' => $request->village,
			'street' => $request->street,
			'status' => $request->status,
		];

		return view('public.timkiemduan', ['list' => $list, 'status' => $status, 'search' => $search, 'districts' => $districts, 'villages' => $villages, 'streets' => $streets, 'report' => $report]);

	}

}