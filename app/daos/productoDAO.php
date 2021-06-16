<?php

namespace App\Daos;

use App\Models\ProductoModel;
use GrahamCampbell\ResultType\Result;

use Libs\Dao;
use stdClass;

class ProductoDAO extends Dao
{
    public function __construct()
    {
        $this->loadEloquent();
    }
    public function getAll(bool $Estado)
    {
        $result = ProductoModel::where('Estado', $Estado)->orderBy('IdProducto', 'DESC')->get();
        return $result;
    }
    public function get(int $id)
    {

        $model = ProductoModel::find($id);

        if (is_null($model)) {
            $model = new stdClass();
            $model->IdProducto = 0;
            $model->IdMarca = 0;
            $model->IdCategoria = 0;
            $model->IdUnidad = 0;
            $model->Nombre = "";
            $model->Descripcion = "";
            $model->PrecioCosto = 0;
            $model->PrecioVenta = 0;
            $model->Stock = 0;
            $model->StockMinimo = 0;
            $model->Estado = 0;
        }

        return $model;
    }

    public function create($obj)
    {
        $model = new ProductoModel();
        $model->IdProducto = $obj->IdProducto;
        $model->IdMarca = $obj->IdMarca;
        $model->IdCategoria = $obj->IdCategoria;
        $model->IdUnidad = $obj->IdUnidad;
        $model->Nombre = $obj->Nombre;
        $model->Descripcion = $obj->Descripcion;
        $model->PrecioCosto = $obj->PrecioCosto;
        $model->PrecioVenta = $obj->PrecioVenta;
        $model->Stock = $obj->Stock;
        $model->StockMinimo = $obj->StockMinimo;
        $model->Estado = $obj->Estado;

        return $model->save();
    }
    public function update($obj)
    {
        $model = ProductoModel::find($obj->IdProducto);
        $model->IdMarca = $obj->IdMarca;
        $model->IdCategoria = $obj->IdCategoria;
        $model->IdUnidad = $obj->IdUnidad;
        $model->Nombre = $obj->Nombre;
        $model->Descripcion = $obj->Descripcion;
        $model->PrecioCosto = $obj->PrecioCosto;
        $model->PrecioVenta = $obj->PrecioVenta;
        $model->Stock = $obj->Stock;
        $model->StockMinimo = $obj->StockMinimo;
        $model->Estado = $obj->Estado;

        return $model->save();
    }
    public function delete(int $id)
    {
        $model = ProductoModel::find($id);
        return $model->delete();
    }
    //public function baja(int $id)
    //{
    //    $sql = "UPDATE categorias set estado='false' WHERE idcategoria=?";
    //    $stmt = $this->pdo->prepare($sql);
    //   $stmt->bindParam(1, $id, \PDO::PARAM_INT);
    //    return $stmt->execute();
    //}
}
