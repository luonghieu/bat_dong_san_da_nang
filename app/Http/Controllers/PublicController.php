<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\News;
use App\Models\Project;
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
use Carbon\Carbon;
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

		$projects = Project::all();
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
		$list = Project::paginate(6);
		return view('public.duan', ['list' => $list]);
	}

    // gioithieu
	public function chitietduan($id)
	{
		$obj = Project::find($id);
		$featureProjects = Project::where('id','!=',$obj->id)
		->orderBy('view', 'desc')
		->orderBy('created_at', 'desc')
		->take(5)
		->get();
		return view('public.chitietduan', ['obj' => $obj, 'featureProjects' => $featureProjects]);
	}

    // gioithieu
	public function sangiaodich($type)
	{
		$menu = Category::where('type_transaction', $type)->pluck('name', 'id')->toArray();
		$list = Post::whereIn('cat_id', array_keys($menu))->orderBy('type_post_id', 'ASC')->paginate(6);
		return view('public.sangiaodich', ['menu' => $menu, 'list' => $list, 'type' => $type]);
	}


    // gioithieu
	public function chitietsanbatdongsan()
	{
		return view('public.chitietsanbatdongsan');
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
	public function chitiettintuc($id)
	{
		$obj = News::find($id);
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
		$typePost = TypePost::all();
		$unitPrice = UnitPrice::where('type_transaction', UnitPrice::TYPETRANSACTION['sale'])->get();
		$district = District::all();
		$direction = Post::DIRECTION;
		return view('public.dangtin', ['district' => $district, 'unitPrice' => $unitPrice, 'typePost' => $typePost, 'direction' => $direction]);
	}

	// gioithieu
	public function taotin(PostCreateRequest $request)
	{
		$data = $request->all();

		$insert = [
			'name' => $data['name'], 
			'description'  => $data['description'],
			'direction' => $data['direction'], 
			'cat_id' => $data['cat_id'], 
			'district_id' => $data['district_id'], 
			'image', 
			'village_id' => ($data['village_id'] != -1) ? $data['village_id'] : 0, 
			'street_id' => ($data['street_id'] != -1) ? $data['street_id'] : 0, 
			'project_id' => ($data['project_id'] != -1) ? $data['project_id'] : 0, 
			'price' => $data['price'], 
			'area' => $data['area'], 
			'unit_price_id' => $data['unit_price_id'],
			'type_post_id' => $data['type_post_id'],
			'frontispiece' => !empty($data['frontispiece']) ? $data['frontispiece'] : '',
			'road_ahead' => !empty($data['road_ahead']) ? $data['road_ahead'] : '',
			'number_of_floor' => !empty($data['number_of_floor']) ? $data['number_of_floor'] : '',
			'number_of_room' => !empty($data['number_of_room']) ? $data['number_of_room'] : '',
			'number_of_toilet' => !empty($data['number_of_toilet']) ? $data['number_of_toilet'] : '',
			'furniture' => !empty($data['furniture']) ? $data['furniture'] : '',
			'poster_id' => $request->poster_id,
			'info_contact' => $data['fullname'] . $data['address'] . $data['phone'] . $data['email'],
			'start_time' => $data['start_time'],
			'end_time' => $data['end_time'],
		];

		if ($request->hasFile('image')) {
			$path = "images/posts/";
			$fileName = str_random('10') . time() . '.' . $request->image->getClientOriginalExtension();
			$request->image->move($path, $fileName);
			$insert['image'] = $path . $fileName;
		} else {
			$insert['image'] = "";
		}

		if (Post::create($insert)) {
			$posts = Post::where('poster_id', $$objUser->id)->get();
			return redirect()->route('public.dangtin', ['posts' => $posts])->with('success', 'Success');
		} else {
			return redirect()->back()->withInput()->with('error', 'Fail');
		}
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
		$objUser = User::where(function ($query) use ($request) {
			$query->where("username","=",$request->name)
			->orWhere('email', '=', $request->name);
		})->Where("password","=",$passWord)->where('active','=',1)->where('role', User::ROLE['customer'])->first();
		if (!empty($objUser)) {
			$request->session()->put('objUser', $objUser);

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
			'role' => User::ROLE['customer']
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
		$objUser = session()->get('objUser');
		$posts = Post::where('poster_id', $objUser->poster->id)->get();
		return view('public.trangcanhan', ['posts' => $posts]);
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
		$manager = Employee::join('users', 'employee.user_id', 'users.id')->where('role', User::ROLE['manager'])->pluck('users.id')->toArray();
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
		return redirect()->route('public.chitietduan', ['id' => $request->id])->with('success', 'Success');
	}

	public function dangxuat()
	{
		session()->forget('objUser');
		return redirect()->route('public.trangchu');
	}

	public function timkiem()
	{
		$sale = Category::where('type_transaction', Category::TYPETRANSACTION['sale'])
		->pluck('name', 'id')
		->toArray();
		$district = District::pluck('name', 'id')->toArray();
		$direction = Post::DIRECTION;
		return view('public.timkiem', ['sale' => $sale, 'district' => $district, 'direction' => $direction]);
	}


}