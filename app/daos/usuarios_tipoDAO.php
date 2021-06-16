<?php

namespace App\Daos;

use App\Models\Usuarios_TipoModel;
use GrahamCampbell\ResultType\Result;

use Libs\Dao;
use stdClass;

class Usuarios_TipoDAO extends Dao
{
    public function __construct()
    {
        $this->loadEloquent();
    }
    public function getAll(bool $Estado)
    {
        $result = Usuarios_TipoModel::where('Estado', $Estado)->orderBy('IdTipo', 'DESC')->get();
        return $result;
    }
    public function get(int $id)
    {

        $model = Usuarios_TipoModel::find($id);

        if (is_null($model)) {
            $model = new stdClass();
            $model->IdTipo = 0;
            $model->Nombre = "";
            $model->Estado = 0;
        }

        return $model;
    }

    public function create($obj)
    {
        $model = new Usuarios_TipoModel();
        $model->Nombre = $obj->Nombre;
        $model->Estado = $obj->Estado;

        return $model->save();
    }
    public function update($obj)
    {
        $model = Usuarios_TipoModel::find($obj->IdTipo);
        $model->Nombre = $obj->Nombre;
        $model->Estado = $obj->Estado;

        return $model->save();
    }
    public function delete(int $id)
    {
        $model = Usuarios_TipoModel::find($id);
        return $model->delete();
    }
}
