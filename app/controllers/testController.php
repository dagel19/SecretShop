<?php

namespace App\Controllers;

use Libs\Controller;

class TestController extends Controller
{
    public function __construct()
    {
        $this->loadDirectoryTemplate('test');
    }
    public function index()
    {
        echo $this->templates->render('index');
    }
}