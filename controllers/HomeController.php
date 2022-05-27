<?php
namespace controllers;

use models\Movie;

class HomeController
{
    public function index()
    {
        return view('index');
    }

}