<?php

namespace App\Arketops\Base;

use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository
{

    /**
     * @return mixed
     */
    abstract protected function model();

    public function search()
    {
        return 0;
    }

    /**
     * @param $id int id model to find
     * @return mixed
     */
    public function find($id)
    {
        return $this->model()::find($id);
    }

    /**
     * @param $column string Column by which the query will be filtered
     * @param $value string Value by which the query will be filtered
     * @param array|null $columns Columns to be returned by the query
     * @return mixed
     */
    public function findBy($column, $value, array $columns = ['*'])
    {
        return $this->model()::where($column, $value)->get($columns);
    }

    public function getAll()
    {
        return $this->model()->all();
    }

    public function create($data)
    {
        return $this->model()->create($data);
    }

    /**
     * @param $model Model|int Entity or ID to delete
     * @return mixed
     */
    public function delete($model)
    {
        if (is_numeric($model)) {
            $model = $this->find($model);
        }

        return $model->delete();
    }

}
