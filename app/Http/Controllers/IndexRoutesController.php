<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexRoutesController extends Controller
{
    public function index() {

        return view('index');
    }

    public function registration() {
        return view('Registration.item');
    }
    public function login() {
        return view('Login.item');
    }

    public function adminPanel()
    {
        return view('AdminPanel.CategoriesAndAttributes.layout');
    }
}
