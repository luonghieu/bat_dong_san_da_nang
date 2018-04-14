<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use App\Models\News;
use App\Models\Project;


class PublicController extends Controller
{
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
		return view('public.gioithieu');
	}

	// duan
	public function duan()
	{
		return view('public.duan');
	}

    // gioithieu
	public function chitietduan()
	{
		return view('public.chitietduan');
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
	public function tintuc()
	{
		return view('public.tintuc');
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


}