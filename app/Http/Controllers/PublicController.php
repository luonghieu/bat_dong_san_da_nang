<?php

namespace App\Http\Controllers;


class PublicController extends Controller
{
    // index
	public function index()
	{
		return view('public.trangchu');
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