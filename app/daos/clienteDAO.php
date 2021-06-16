<?php

namespace App\Daos;

use App\Models\ClienteModel;
use GrahamCampbell\ResultType\Result;

use Libs\Dao;
use stdClass;

class ClienteDAO extends Dao
{
    public function __construct()
    {
        $this->loadEloquent();
    }
    public function getAll(bool $Estado)
    {
        $result = ClienteModel::where('Estado', $Estado)->orderBy('IdCliente', 'DESC')->get();
        return $result;
    }
    public function get(int $id)
    {

        $model = ClienteModel::find($id);

        if (is_null($model)) {
            $model = new stdClass();
            $model->IdCliente = 0;
            $model->Nombres = "";
            $model->Apellidos = "";
            $model->Direccion = "";
            $model->Telf = "";
            $model->CreditoLimite = 0;
            $model->Ruc = "";
            $model->Estado = 0;
        }

        return $model;
        
    }

    public function create($obj)
    {
        $model = new ClienteModel();
        $model->IdCliente = $obj->IdCliente;
        $model->Nombres = $obj->Nombres;
        $model->Apellidos = $obj->Apellidos;
        $model->Direccion = $obj->Direccion;
        $model->Telf = $obj->Telf;
        $model->CreditoLimite = $obj->CreditoLimite;
        $model->Ruc = $obj->Ruc;
        $model->Estado = $obj->Estado;

        return $model->save();
    }
    public function update($obj)
    {
        $model = ClienteModel::find($obj->IdCliente);
        $model->Nombres = $obj->Nombres;
        $model->Apellidos = $obj->Apellidos;
        $model->Direccion = $obj->Direccion;
        $model->Telf = $obj->Telf;
        $model->CreditoLimite = $obj->CreditoLimite;
        $model->Ruc = $obj->Ruc;
        $model->Estado = $obj->Estado;
        return $model->save();
    }
    public function delete(int $id)
    {
        $model = ClienteModel::find($id);
        return $model->delete();
    }
}
