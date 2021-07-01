<?php

namespace App\Http\Controllers\Api\DataTable;

use App\Models\User;
use App\Http\Controllers\Api\DataTable\DataTableController;
use App\Http\Requests\Auth\UserUpdateRequest;

class UserController extends DataTableController
{
    protected $allowCreation = false;

    public function builder()
    {
        return User::query();
    }

    public function getCustomColumnsNames()
    {
        return [
            'name' => 'Customer name',
            'email' => 'Customer Email',
            'created_at' => 'Customer Since',
        ];
    }

    // only these columns will be returned in json response
    public function getDisplayableColumns()
    {
        return [
            'id',
            'name',
            'email',
            'created_at'
        ];
    }

    public function getUpdatableColumns()
    {
        return [
            'name',
            'email',
        ];
    }

    public function update($id, UserUpdateRequest $request)
    {
        $this->builder->find($id)->update($request->only($this->getUpdatableColumns()));
        return response()->json(
            [
            'data' => [
                'message' => 'success',
            ]
         ]
        );
    }
}