<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\News;

class FrontController extends Controller
{
    public function home()
    {
        $slider = News::orderBy('created_at', 'DESC')->limit(6)->get();
        $firstNews = News::orderBy('created_at', 'DESC')->first();
        $news = News::orderBy('created_at', 'DESC')->where('id', $firstNews)->limit(6)->get();

    	return view('front.home', compact('slider', 'firstNews', 'news'));
    }

    public function news()
    {
        $news = News::paginate(12);

    	return view('front.news', compact('news'));
    }

    public function newsDetail($slug)
    {
        $news = News::where('slug', $slug)->first();

        $relatedNews = News::where('id', '!=', $news->id)->inRandomOrder()->limit(4)->get();

    	return view('front.news-detail', compact('news', 'relatedNews'));
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
