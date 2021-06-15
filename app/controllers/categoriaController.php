<?php

namespace App\Controllers;

use App\DAO\CategoriaDAO;
use Libs\Controller;
use stdClass;

class categoriaController extends Controller
{
    public function __construct()
    {
        $this->loadDirectoryTemplate('categoria');
        $this->loadDao('categoria');
    }
    public function index()
    {
        $data = $this->dao->getAll(true);

        echo $this->template->render('index', ['data' => $data]);
    }
    public function detail($param = null)
    {
        $id = isset($param[0]) ? $param[0] : 0;
        $data = $this->dao->get($id);
        echo $this->template->render('detail', ['data' => $data]);
    }
    public function save()
    {
        $obj = new stdClass();

        $obj->IdCategoria = isset($_POST['idcategoria']) ? intval($_POST['idcategoria']) : 0;
        $obj->Nombre = isset($_POST['nombre']) ? $_POST['nombre'] : 0;
        $obj->Descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : 0;

        if (isset($_POST['estado'])) {
            if ($_POST['estado'] == 'on') {
                $obj->Estado = true;
            } else {
                $obj->Estado = false;
            }
        } else {
            $obj->Estado = false;
        }

        if ($obj->IdCategoria > 0) {
            $this->dao->update($obj);
        } else {
            $this->dao->create($obj);
        }
        header('Location:' . URL . 'categoria/index');
    }
    public function delete($param = null)
    {
        $id = isset($param[0]) ? $param[0] : 0;

        if ($id > 0) {
            $this->dao->delete($id);
        }
        header('Location:' . URL . 'categoria/index');
    }
}
