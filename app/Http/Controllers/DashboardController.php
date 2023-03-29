<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
  public function index()
  {
    return Inertia::render('Dashboard');
  }
  public function profile()
  {
    return Inertia::render('View/Profile');
  }
  public function tables()
  {
    return Inertia::render('View/Tables');
  }
  public function forms()
  {
    return Inertia::render('View/Forms');
  }
  public function ui()
  {
    return Inertia::render('View/Ui');
  }
  public function error()
  {
    return Inertia::render('View/Error');
  }
}
