<?php

namespace App\Http\Controllers\Api\DataTable;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\DataTable\DataTableController;
use App\Http\Requests\Auth\UserUpdateRequest;

class AdminUserController extends DataTableController
{
    protected $allowCreation = true;

    public function builder()
    {
        return User::query();
    }

    public function getCustomColumnsNames()
    {
        return [
            'name' => 'Admin name',
            'email' => 'Admin Email',
            'created_at' => 'Admin Since',
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

    /**
     * Get records to be used for output.
     *
     * @param  Request $request
     * @return Illuminate\Support\Collection
     */
    public function getRecords(Request $request)
    {
        $builder = $this->builder;

        if ($this->hasSearchQuery($request)) {
            $builder = $this->buildSearch($builder, $request);
        }

        try {
            return $builder->where('is_admin', '=', '1')->limit($request->limit)->orderBy('id', 'asc')->get($this->getDisplayableColumns());
        } catch (QueryException $e) {
            return [];
        }
    }
}