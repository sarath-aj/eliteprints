<?php

namespace App\Http\Controllers\Api\DataTable;

use App\Http\Controllers\Api\DataTable\DataTableController;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends DataTableController
{
    protected $allowCreation = false;
    public function builder()
    {
        return Product::query();
    }

    public function getCustomColumnsNames()
    {
        return [
            'id' => 'ID',
            'product_code' => 'Product Code',
            'name' => 'Name',
            'slug' => 'Slug',
            'name' => 'Product name',
            'gender' => 'Gender',
        ];
    }

    // only these columns will be returned in json response
    public function getDisplayableColumns()
    {
        return [
            'id',
            'product_code',
            'name',
            'slug',
            'gender',
        ];
    }
    public function getQueryColumns()
    {
        return [
            'id',
            'product_code',
            'name',
            'slug',
            'gender',
        ];
    }

    public function update($id, Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|unique:users,email,' . $id . '|email',
            'created_at' => 'date'
        ]);

        $this->builder->find($id)->update($request->only($this->getUpdatableColumns()));
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
            return $builder->limit($request->limit)->orderBy('id', 'asc')->get($this->getQueryColumns());
        } catch (QueryException $e) {
            return [];
        }
    }
}
