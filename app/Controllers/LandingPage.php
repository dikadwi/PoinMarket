<?php

namespace App\Controllers;


class LandingPage extends BaseController
{

    public function index()
    {
        return view('LandingPage/index');
    }

    public function gamifikasi()
    {
        return view('LandingPage/gamifikasi');
    }

    public function gaya_belajar()
    {
        return view('LandingPage/gaya_belajar');
    }

    public function about()
    {
        return view('LandingPage/about');
    }

    public function contact()
    {
        return view('LandingPage/contact');
    }

    public function privacy()
    {
        return view('LandingPage/privacy_policy');
    }

    public function terms_service()
    {
        return view('LandingPage/terms_of_service');
    }

    public function help()
    {
        return view('LandingPage/help_center');
    }

    public function register()
    {
        return view('LandingPage/register');
    }


    // Template
    public function invitation()
    {
        return view('auth/Page/invitation');
    }

    public function pilih()
    {
        return view('auth/Page/pilih');
    }

    public function tes()
    {
        return view('auth/Page/tespage');
    }

    public function tes1()
    {
        return view('auth/Page/tespage1');
    }

    public function tes2()
    {
        return view('auth/Page/tespage2');
    }

    public function tes3()
    {
        return view('auth/Page/tespage3');
    }

    public function tes4()
    {
        return view('auth/Page/tespage4');
    }

    public function tes5()
    {
        return view('auth/Page/tespage5');
    }

    public function page()
    {
        return view('auth/Page/landingpage');
    }

    public function page1()
    {
        return view('auth/Page/landingpage1');
    }

    public function page2()
    {
        return view('auth/Page/landingpage2');
    }

    public function page3()
    {
        return view('auth/Page/landingpage3');
    }

    public function page4()
    {
        return view('auth/Page/landingpage4');
    }

    public function page5()
    {
        return view('auth/Page/landingpage5');
    }
}
