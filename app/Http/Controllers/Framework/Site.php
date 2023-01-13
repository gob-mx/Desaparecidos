<?php

namespace App\Http\Controllers\Framework;
use Illuminate\Http\Request;
use Helpme;

class Site extends Controller
{
  public function index()
  {
        return view('site/plantilla/index');
  }
  public function site()
  {
      return view('site/plantilla/index');
  }
}
