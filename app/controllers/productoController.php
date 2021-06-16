<?php

namespace App\Controllers;

use GUMP;
use Libs\Controller;
use stdClass;

class ProductoController extends Controller
{
    public function __construct()
    {
        $this->loadDirectoryTemplate('producto');
        $this->loadDao('producto');
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
        $valid_data = $this->valida($_POST);

        $status = $valid_data['status'];
        $data = $valid_data['data'];

        if ($status == true) {
            $obj = new stdClass();

            $obj->IdProducto = isset($_POST['idproducto']) ? intval($_POST['idproducto']) : 0;
            $obj->IdMarca = isset($_POST['idmarca']) ? $_POST['idmarca'] : 0;
            $obj->IdCategoria = isset($_POST['idcategoria']) ? $_POST['idcategoria'] : 0;
            $obj->IdUnidad = isset($_POST['idunidad']) ? $_POST['idunidad'] : 0;
            $obj->Nombre = isset($_POST['nombre']) ? $_POST['nombre'] : 0;
            $obj->Descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : 0;
            $obj->PrecioCosto = isset($_POST['preciocosto']) ? $_POST['preciocosto'] : 0;
            $obj->PrecioVenta = isset($_POST['precioventa']) ? $_POST['precioventa'] : 0;
            $obj->Stock = isset($_POST['stock']) ? $_POST['stock'] : 0;
            $obj->StockMinimo = isset($_POST['stockminimo']) ? $_POST['stockminimo'] : 0;

            if (isset($_POST['estado'])) {
                if ($_POST['estado'] == 'on') {
                    $obj->Estado = true;
                } else {
                    $obj->Estado = false;
                }
            } else {
                $obj->Estado = false;
            }

            if ($obj->IdProducto > 0) {
                $rpta = $this->dao->update($obj);
            } else {
                $rpta = $this->dao->create($obj);
            }
            if ($rpta) {
                $response = [
                    'success' => 1,
                    'message' => 'Producto guardado correctamente',
                    'redirection' => URL . 'producto/index'
                ];
            } else {
                $response = [
                    'success' => 0,
                    'message' => 'Error',
                    'redirection' => ''
                ];
            }
        } else {
            $response = [
                'success' => -1,
                'message' =>  $data,
                'redirection' => ''
            ];
        }

        echo json_encode($response);
    }
    public function delete($param = null)
    {
        $id = isset($param[0]) ? $param[0] : 0;

        if ($id > 0) {
            $this->dao->delete($id);
        }
        header('Location:' . URL . 'producto/index');
    }

    public function valida($datos)
    {
        $gump = new GUMP('es');

        $gump->validation_rules([
            //'nombre' => 'required|max_len,20',
            //'descripcion' => 'min_len,1|max_len,50'
        ]);
        $valid_data = $gump->run($datos);

        if ($gump->errors()) {
            $response = [
                'status' => false,
                'data' => $gump->get_errors_array()
            ];
        } else {
            $response = [
                'status' => true,
                'data' => $valid_data
            ];
        }
        return $response;
    }
}
