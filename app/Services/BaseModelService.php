<?php

namespace App\Services;

abstract class BaseModelService
{
    /**
     * @var \Illuminate\Database\Eloquent\Model An instance of the Eloquent Model
     */
    protected $model;

    /**
     * @param Model $model
     */
    public function __construct($model)
    {
        $this->model = $model;
    }

    public function create($data)
    {
        try {
            return $this->model->create($data);
        } catch (\Exception $e) {
            return false;
        }
    }

    public function update($model, $data)
    {
        try {
            $model->update($data);
            return $model;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function toggleStatus($model)
    {
        return $model->update(['status' => !$model->status]);
    }

    public function delete($model): bool
    {
        try {
            $model->delete();
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}