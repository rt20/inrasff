<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\News;
use App\Models\Category;
use App\Models\Gallery;
use App\Models\Kementrian;

class FrontController extends Controller
{
    public function home()
    {
        $slider = News::published()->orderBy('published_at', 'DESC')->limit(6)->get();
        $firstNews = News::published()->orderBy('published_at', 'DESC')->first();
        $news = News::published()->orderBy('published_at', 'DESC')->where('id', '!=', $firstNews->id)->limit(6)->get();
        $category = Category::get();
        $gallery = Gallery::orderBy('created_at', 'DESC')->limit(12)->get();
        $kementrian = Kementrian::limit(6)->get();

    	return view('front.home', compact('slider', 'firstNews', 'news', 'category', 'gallery', 'kementrian'));
    }

    public function news(Request $request)
    {
        $news = News::published()->paginate(12);
        if($request->search) {
            $news = News::published()->where('title', 'LIKE', $request->search)->paginate(12);
        }
        if($request->category) {
            $news = News::published()->where('category_id', $request->category)->paginate(12);
        }

    	return view('front.news', compact('news'));
    }

    public function newsDetail($slug)
    {
        $news = News::published()->where('slug', $slug)->first();

        $relatedNews = News::published()->where('id', '!=', $news->id)->inRandomOrder()->limit(4)->get();

    	return view('front.news-detail', compact('news', 'relatedNews'));
    }

    public function kementrian()
    {
        $kementrian = Kementrian::get();

    	return view('front.kementrian', compact('kementrian'));
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
