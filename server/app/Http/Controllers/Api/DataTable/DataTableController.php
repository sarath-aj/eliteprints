<?php

namespace App\Http\Controllers\Api\DataTable;

use Illuminate\Support\Arr;


use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

abstract class DataTableController extends Controller
{
    /**
     * If an entity is allowed to be created.
     *
     * @var boolean
     */
    protected $allowCreation = true;

    /**
     * Allow deletion.
     *
     * @var boolean
     */
    protected $allowDeletion = true;

    /**
     * The entity builder.
     *
     * @var Illuminate\Database\Eloquent\Builder
     */
    protected $builder;

    /**
     * Get the columns that are allowed to be displayed.
     *
     * @return array
     */
    public function getDisplayableColumns()
    {
        // $this->builder->getModel()->getHidden() -- will get the protected $hidden property array from the model. like user model. this is to remove sensitive field like password, remember token
        return array_diff(
            $this->getDatabaseColumnNames(),
            $this->builder->getModel()->getHidden()
        );
    }

    /**
     * Get the columns that are allowed to be updated.
     *
     * @return array
     */
    public function getUpdatableColumns()
    {
        return array_intersect($this->getDatabaseColumnNames(), $this->getDisplayableColumns());
    }

    public function getCustomColumnsNames()
    {
        return [];
    }

    /**
     * Create the controller, check builder method and assign
     * to the builder property.
     *
     * @return void
     */
    public function __construct()
    {
        if (!method_exists($this, 'builder')) {
            throw new Exception('No entity builder method defined.');
        }

        if (!($this->builder = $this->builder()) instanceof Builder) {
            throw new Exception("Entity builder not instance of Builder.");
        }
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
     * Create an entity.
     *
     * @param  Request $request
     * @return Illuminate\Http\Response
     */
    // public function store(Request $request)
    // {
    //     if (!$this->allowCreation) {
    //         return;
    //     }

    //     $this->builder->create($request->only($this->getUpdatableColumns()));
    // }

    // /**
    //  * Update an entity.
    //  *
    //  * @param  integer  $id
    //  * @param  Request $request
    //  *
    //  * @return Illuminate\Http\Response
    //  */
    // public function update($id, Request $request)
    // {
    //     $this->builder->find($id)->update($request->only($this->getUpdatableColumns()));
    // }

    /**
     * Delete an entity.
     *
     * @param  integer  $id
     * @param  Request $request
     *
     * @return Illuminate\Http\Response
     */
    public function destroy($ids, Request $request)
    {
        if (!$this->allowDeletion) {
            return;
        }

        $this->builder->whereIn('id', explode(',', $ids))->delete();

        return response()->json(
            [
            'data' => [
                'message' => 'success',
            ]
         ]
        );
    }

    /**
     * Get the database column names for the database table. for exmaple all column names in users table.
     *
     * @return array
     */
    protected function getDatabaseColumnNames()
    {
        // $this->builder->getModel()->getTable() -- this will return the users table -- assuming the model is user. Builder is query builder.
        // Schema::getColumnListing will reutrn the column names
        return Schema::getColumnListing($this->builder->getModel()->getTable());
    }

    /**
     * If the request has the columns required to search.
     *
     * @param  Request $request
     * @return boolean
     */
    protected function hasSearchQuery(Request $request)
    {
        return count(array_filter($request->only(['column', 'operator', 'value']))) === 3;
    }

    /**
     * Resolve the given operator to perform a query.
     *
     * @param  string $operator
     * @return string
     */
    protected function resolveQueryParts($operator, $value)
    {
        return Arr::get([
            'equals' => [
                'operator' => '=',
                'value' => $value
            ],
            'contains' => [
                'operator' => 'LIKE',
                'value' => "%{$value}%"
            ],
            'starts_with' => [
                'operator' => 'LIKE',
                'value' => "{$value}%"
            ],
            'ends_with' => [
                'operator' => 'LIKE',
                'value' => "%{$value}"
            ],
            'greater_than' => [
                'operator' => '>',
                'value' => $value
            ],
            'less_than' => [
                'operator' => '<',
                'value' => $value
            ],
            'greater_than_or_equal_to' => [
                'operator' => '>=',
                'value' => $value
            ],
            'less_than_or_equal_to' => [
                'operator' => '<=',
                'value' => $value
            ],
        ], $operator);
    }

    /**
     * Build the search.
     *
     * @param  Builder $builder
     * @param  Request $request
     *
     * @return Builder
     */
    protected function buildSearch(Builder $builder, Request $request)
    {
        $queryParts = $this->resolveQueryParts($request->operator, $request->value);

        return $builder->where(
            $request->column,
            $queryParts['operator'],
            $queryParts['value']
        );
    }
}