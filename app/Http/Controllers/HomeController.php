<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    //    public function __construct()
    //    {
    //        $this->middleware('auth:user');
    //        auth()->shouldUse('user');
    //    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index()
    {
        return view('frontend.home');
    }

    public function about()
    {
        return view('frontend.about');
    }

    public function courses()
    {
        return view('frontend.courses');
    }

    public function courseDetails()
    {
        return view('frontend.course-details');
    }

    public function trainers()
    {
        return view('frontend.trainers');
    }

    public function contact()
    {
        return view('frontend.contact');
    }
}