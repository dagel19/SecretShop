<?php

namespace App\Daos;

use App\Models\CategoriaModel;
use GrahamCampbell\ResultType\Result;

use Libs\Dao;
use stdClass;

class CategoriaDAO extends Dao
{
    public function __construct()
    {
        $this->loadEloquent();
    }
    public function getAll(bool $Estado)
    {
        $result = CategoriaModel::where('Estado', $Estado)->orderBy('IdCategoria', 'DESC')->get();
        return $result;
    }
    public function get(int $id)
    {

        $model = CategoriaModel::find($id);

        if (is_null($model)) {
            $model = new stdClass();
            $model->IdCategoria = 0;
            $model->Nombre = "";
            $model->Descripcion = "";
            $model->Estado = 0;
        }

        return $model;
    }

    public function create($obj)
    {
        $model = new CategoriaModel();
        $model->IdCategoria = $obj->IdCategoria;
        $model->Nombre = $obj->Nombre;
        $model->Descripcion = $obj->Descripcion;
        $model->Estado = $obj->Estado;

        return $model->save();
    }
    public function update($obj)
    {
        $model = CategoriaModel::find($obj->IdCategoria);
        $model->Nombre = $obj->Nombre;
        $model->Descripcion = $obj->Descripcion;
        $model->Estado = $obj->Estado;

        return $model->save();
    }
    public function delete(int $id)
    {
        $model = CategoriaModel::find($id);
        return $model->delete();
    }
    public function baja(int $id)
    {
        $sql = "UPDATE categorias set estado='false' WHERE idcategoria=?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(1, $id, \PDO::PARAM_INT);
        return $stmt->execute();
    }
}
