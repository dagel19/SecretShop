<?php

namespace App\Controllers;

use Libs\Controller;

class DesarrolladoresController extends Controller
{
    public function __construct()
    {
        $this->loadDirectoryTemplate('desarrolladores');
    }

    public function index()
    {
        echo $this->template->render('desarrolladores');
    }
}
