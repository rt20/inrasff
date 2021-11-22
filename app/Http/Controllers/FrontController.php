<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function home()
    {
    	return view('front.home');
    }

    public function news()
    {
    	return view('front.news');
    }

    public function newsDetail($slug)
    {
    	return view('front.news-detail');
    }

    public function kementrian()
    {
    	return view('front.kementrian');
    }

    public function aboutus()
    {
    	return view('front.aboutus');
    }

    public function logical()
    {
    	return view('front.logical');
    }

    public function baganalir()
    {
    	return view('front.baganalir');
    }

    public function contactus()
    {
    	return view('front.contactus');
    }
}
