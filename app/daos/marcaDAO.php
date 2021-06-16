<?php

namespace App\Daos;

use App\Models\MarcaModel;
use GrahamCampbell\ResultType\Result;

use Libs\Dao;
use stdClass;

class MarcaDAO extends Dao
{
    public function __construct()
    {
        $this->loadEloquent();
    }
    public function getAll(bool $Estado)
    {
        $result = MarcaModel::where('Estado', $Estado)->orderBy('IdMarca', 'DESC')->get();
        return $result;
    }
    public function get(int $id)
    {

        $model = MarcaModel::find($id);

        if (is_null($model)) {
            $model = new stdClass();
            $model->IdMarca = 0;
            $model->Nombre = "";
            $model->Descripcion = "";
            $model->Estado = 0;
        }

        return $model;
    }

    public function create($obj)
    {
        $model = new MarcaModel();

        $model->IdMarca = $obj->IdMarca;
        $model->Nombre = $obj->Nombre;
        $model->Descripcion = $obj->Descripcion;
        $model->Estado = $obj->Estado;

        return $model->save();
    }
    public function update($obj)
    {
        $model = MarcaModel::find($obj->IdMarca);
        $model->Nombre = $obj->Nombre;
        $model->Descripcion = $obj->Descripcion;
        $model->Estado = $obj->Estado;

        return $model->save();
    }
    public function delete(int $id)
    {
        $model = MarcaModel::find($id);
        return $model->delete();
    }
}
