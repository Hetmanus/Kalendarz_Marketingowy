<?php

namespace App\Http\Controllers;

class AdminController extends Controller
{
    public function index()
    {
        return view('welcome');
    }
    public function handleShops()
    {
        return view('pages/calendar');
    }
}
