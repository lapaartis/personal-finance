<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
  public function index()
  {
    return Inertia::render('DashboardView');
  }
  public function profile()
  {
    return Inertia::render('View/ProfileView');
  }
  public function tables()
  {
    return Inertia::render('View/TablesView');
  }
  public function forms()
  {
    return Inertia::render('View/FormsView');
  }
  public function ui()
  {
    return Inertia::render('View/UiView');
  }
  public function error()
  {
    return Inertia::render('View/ErrorView');
  }
}
