<?php

namespace App\Controllers;

use GUMP;
use Libs\Controller;
use stdClass;

class clienteController extends Controller
{
    public function __construct()
    {
        $this->loadDirectoryTemplate('cliente');
        $this->loadDao('cliente');
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

        $obj->IdCategoria = isset($_POST['idcliente']) ? intval($_POST['idcliente']) : 0;
        $obj->Nombres = isset($_POST['nombres']) ? $_POST['nombres'] : 0;
        $obj->Apellidos = isset($_POST['apellidos']) ? $_POST['apellidos'] : 0;
        $obj->Direccion = isset($_POST['direccion']) ? intval($_POST['direccion']) : 0;
        $obj->Telf = isset($_POST['telf']) ? $_POST['telf'] : 0;
        $obj->CreditoLimite = isset($_POST['creditolimite']) ? $_POST['creditolimite'] : 0;
        $obj->Ruc = isset($_POST['ruc']) ? $_POST['ruc'] : 0;

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
            $rpta = $this->dao->update($obj);
        } else {
            $rpta = $this->dao->create($obj);
        }
            if ($rpta) {
                $response = [
                    'success' => 1,
                    'message' => 'Cliente guardado correctamente',
                    'redirection' => URL . 'cliente/index'
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
        header('Location:' . URL . 'cliente/index');
    }

    public function valida($datos)
    {
        $gump = new GUMP('es');

        $gump->validation_rules([
            'ruc' => 'required|max_len,25'
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

