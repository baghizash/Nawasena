<?php

namespace App\Controllers;

class utama extends BaseController
{
    public function index(): string
    {
        return view('utama/index');
    }
}
