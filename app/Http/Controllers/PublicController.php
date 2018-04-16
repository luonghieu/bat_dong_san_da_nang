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

		return view('public.dangtin', ['district' => $district, 'unitPrice' => $unitPrice, 'typePost' => $typePost, 'direction' => $direction]);
	}

	// gioithieu
	public function dangnhap()
	{
		return view('public.dangnhap');
	}

	// gioithieu
	public function xulydangnhap(Requests $request)
	{
		$passWord = md5(trim($request->password));
        $objUser = User::where(function ($query) {
		    $query->where("username","=",$request->name)
		          ->orWhere('email', '=', $request->name);
		})->Where("password","=",$passWord)->where('active','=',1)->where('role', User::ROLE['customer'])->first();
        if (!empty($objUser)) {
            $id=$objUser->id;
            $request->session()->put('objUser', $objUser);
            return redirect()->route("public.trangcanhan");
        }else{
            $request->session()->flash('msg','Tài khoản không đúng');
            return redirect()->route("public.dangnhap");
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
		return view('public.trangcanhan');
	}


}