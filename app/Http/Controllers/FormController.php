<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FormController extends Controller
{
    public function create()
    {
        return view('formulario/crear');
    }

    public function store()
    {
        return view('formulario/store');
    }
}
