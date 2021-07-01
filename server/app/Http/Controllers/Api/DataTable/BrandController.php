<?php

namespace App\Http\Controllers\Api\DataTable;

use App\Http\Controllers\Api\DataTable\DataTableController;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Http\Requests\Brand\BrandCreateRequest;
use App\Http\Requests\Brand\BrandUpdateRequest;

class BrandController extends DataTableController
{
    public function builder()
    {
        return Brand::query();
    }

    public function getCustomColumnsNames()
    {
        return [
            'id'   => 'ID',
            'name' => 'Brand Name',
            'slug' => 'Brand Slug',
        ];
    }

    // only these columns will be returned in json response
    public function getDisplayableColumns()
    {
        return [
            'id',
            'name',
            'slug',
        ];
    }

    // only these columns will be returned in json response
    public function getUpdatableColumns()
    {
        return [
            'name',
            'slug',
        ];
    }

    public function update($id, BrandUpdateRequest $request)
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
     * Show a list of entities.
     *
     * @return Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        return response()->json([
            'data' => [
                'table' => $this->builder->getModel()->getTable(),
                'records' => $this->getRecords($request),
                'updatable' => array_values($this->getUpdatableColumns()),
                'displayable' => array_values($this->getDisplayableColumns()),
                'column_map' => $this->getCustomColumnsNames(),
                'allow' => [
                    'creation' => $this->allowCreation,
                    'deletion' => $this->allowDeletion,
                ]
            ]
        ]);
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
            return $builder->limit($request->limit)->orderBy('id', 'asc')->get($this->getDisplayableColumns());
        } catch (QueryException $e) {
            return [];
        }
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(BrandCreateRequest $request)
    {
        $this->builder->create($request->only($this->getUpdatableColumns()));
        return response()->json(
            [
            'data' => [
                'message' => 'success',
            ]
         ]
        );
    }
}