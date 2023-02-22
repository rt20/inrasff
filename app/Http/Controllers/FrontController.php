<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

use App\Models\News;
use App\Models\Category;
use App\Models\Gallery;
use App\Models\Kementrian;
use App\Models\FAQ;
use App\Models\ContactUs;
use App\Models\Slider;

use App\Models\DownStreamNotification;
use App\Models\NotificationAttachment;
use App\Models\Institution;

use DB;
use App\Events\NotificationContactUs;

class FrontController extends Controller
{
    public function home(Request $request)
    {
        $runningText = News::published()->orderBy('published_at', 'DESC')->limit(3)->get(['title', 'slug']);
        $slider = Slider::where('location', 'home_page')->first();
        $firstNews = News::published()->orderBy('published_at', 'DESC')->first();
        if($firstNews) {
            $news = News::published()->orderBy('published_at', 'DESC')->where('id', '!=', $firstNews->id)->limit(6)->get();
        } else {
            $news = News::published()->limit(6)->get();
        }
        $category = Category::get();
        $gallery = Gallery::orderBy('created_at', 'DESC')->limit(12)->get();
        $kementrian = Kementrian::limit(6)->get();
        $downstreamnotification = DB::table('down_stream_notifications')
            -> join ('notification_attachments','down_stream_notifications.id', '=' ,'notification_attachments.na_id')
            -> select ('down_stream_notifications.created_at','notification_attachments.na_id', 'down_stream_notifications.number', 'notification_attachments.id', 'notification_attachments.title' )
            -> where ('status',['done'])
            -> where ('notification_attachments.info',['original_notification'])
            -> orderBy('down_stream_notifications.id', 'desc')
            -> limit(10)
            -> get();
          #dd($downstreamnotification);

    	return view('front.home', compact('slider', 'firstNews', 'news', 'category', 'gallery', 'kementrian', 'runningText','downstreamnotification'));
    }

    public function news(Request $request)
    {
        $news = News::published()->orderBy('published_at', 'DESC')->paginate(12);
        if($request->search) {
            $news = News::published()->where('title', 'LIKE', '%'.$request->search.'%')->orderBy('published_at', 'DESC')->paginate(12);
        }
        if($request->category) {
            $news = News::published()->where('category_id', $request->category)->orderBy('published_at', 'DESC')->paginate(12);
        }

    	return view('front.news', compact('news'));
    }

    public function newsDetail($slug)
    {
        $news = News::published()->where('slug', $slug)->first();

        $relatedNews = News::published()->inRandomOrder()->limit(4)->get();
        if($news)
            $relatedNews = News::published()->where('id', '!=', $news->id)->inRandomOrder()->limit(4)->get();

    	return view('front.news-detail', compact('news', 'relatedNews'));
    }

    public function kementrian()
    {
        $kementrian = Kementrian::get();

        $slider = Slider::where('location', 'home_page')->first();

    	return view('front.kementrian', compact('kementrian', 'slider'));
    }

    public function aboutus()
    {
        $kementrian = Kementrian::get();

    	return view('front.aboutus', compact('kementrian'));
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
        $faq = FAQ::get();

    	return view('front.contactus', compact('faq'));
    }

    public function contactusSubmit(Request $request)
    {
         $validator = Validator::make($request->all(), [
            'name' => ['required', 'max:255'],
            'email' => ['required', 'max:255'],
            'message' => ['required'],
            'g-recaptcha-response' => ['required', 'captcha'],
        ]);

        if($validator->fails()) {
            return redirect('contactus#sendMessage')->withErrors($validator)->withInput();
        }

        try {
            DB::beginTransaction();
            $n = ContactUs::make($request->only(['name', 'email', 'message']));
            $n->save();
            DB::commit();
            
            event(new NotificationContactUs);
        } catch (Exception $e) {
            DB::rollback();
            report($e);
            return redirect()->back()->withInput()->withError($e->getMessage());

        }

        $faq = FAQ::get();

        return redirect('contactus#sendMessage')->with('faq', $faq)->withSuccess('Pesan berhasil dikirim!');
    }
    public function identification(Request $request)
    {
        $news = News::published()->orderBy('published_at', 'DESC')->paginate(12);
        if($request->search) {
            $news = News::published()->where('title', 'LIKE', '%'.$request->search.'%')->orderBy('published_at', 'DESC')->paginate(12);
        }
        if($request->category) {
            $news = News::published()->where('category_id', $request->category)->orderBy('published_at', 'DESC')->paginate(12);
        }

    	return view('front.identification', compact('news'));
    }

}
