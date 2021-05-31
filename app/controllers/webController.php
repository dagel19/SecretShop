<?php

namespace App\Controllers;

use Libs\Controller;

class WebController extends Controller
{
    public function __construct()
    {
        $this->loadDirectoryTemplate('web');
    }
    public function menu()
    {
        echo $this->templates->render('menu');
    }

}