<?php

namespace App\Http\Controllers\Api\DataTable;

use App\Models\Order;
use App\Http\Controllers\Api\DataTable\DataTableController;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use App\Models\User;
use App\Http\Resources\Order\OrderDatatableResource;
use App\Http\Requests\Order\OrderStoreRequest;

class OrderController extends DataTableController
{
    protected $allowCreation = false;
    protected $allowDeletion = false;

    public function builder()
    {
        return Order::query();
    }

    // only these columns will be returned in json response
    public function getDisplayableColumns()
    {
        return [
            'ID',
            'Order Date',
            'Customer Name',
            'Order Status',
            'No.of Products',
        ];
    }

    public function update($id, Request $request)
    {
        $this->validate($request, [
            'status' => 'required',
        ]);

        $this->builder->find($id)->update($request->only('status'));
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
            return OrderDatatableResource::collection($builder->limit($request->limit)->orderBy('id', 'asc')->get());
        } catch (QueryException $e) {
            return [];
        }
    }
}