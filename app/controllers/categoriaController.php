<?php

namespace App\Controllers;

use App\DAO\CategoriaDAO;
use Libs\Controller;

class categoriaController extends Controller
{
    public function __construct()
    {
     $this->loadDirectoryTemplate('categoria');   
    }
    public function index()
    {
        $data = (new CategoriaDAO())->getAll();
        echo $this->template->render('index', ['data' => $data]);
    }
}