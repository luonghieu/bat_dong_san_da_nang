<?php

namespace App\Http\Controllers;

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
use App\Models\User;
use App\Http\Requests\PostCreateRequest;

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
		$list = Project::all();
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
	public function sangiaodich()
	{
		return view('public.sangiaodich');
	}


    // gioithieu
	public function chitietsanbatdongsan()
	{
		return view('public.chitietsanbatdongsan');
	}


    // gioithieu
	public function tintuc($catId)
	{
		$newsByCat = News::where('cat_id', $catId)->get();
		$featureNews = News::where('active', 1)
			->orderBy('view', 'desc')
			->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
		return view('public.tintuc', ['newsByCat' => $newsByCat, 'featureNews' => $featureNews]);
	}

	// gioithieu
	public function chitiettintuc($id)
	{
		$obj = News::find($id);
		$relatedNews = News::where('cat_id', $obj->cat_id)->where('id','!=', $obj->id)
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
	public function taotin(PostCreateRequest $request, $id)
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
			'poster_id' => $id,
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
            return redirect()->route('admins.product.sale.list', ['posts' => $posts])->with('success', 'Success');
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

	// gioithieu
	public function trangcanhan()
	{
		$objUser = session()->get('objUser');
		$posts = Post::where('poster_id', $objUser->poster->id)->get();
		return view('public.trangcanhan', ['posts' => $posts]);
	}


}