<?php

namespace App\Http\Controllers\Api\Addresses;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\Addresses\AddressesResource;
use App\Http\Resources\Addresses\AddressesCollection;
use App\Models\Address;
use App\Http\Requests\Addresses\AddressesRequest;

class AddressesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return AddressesResource::collection(
            $request->user()->addresses
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(AddressesRequest $request)
    {
        if ($request->is_default) {
            $this->setOtherAddressesAsNotDefault();
        }

        $address = Address::make($request->all());

        $request->user()->addresses()->save($address);

        return new AddressesResource($address);
    }

    public function setOtherAddressesAsNotDefault()
    {
        $request = request();
        foreach ($request->user()->addresses as $address) {
            $address->is_default = 0;
            $address->save();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($addressid)
    {
        $address = Address::findOrFail($addressid);

        return new AddressesResource($address);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, AddressesRequest $request)
    {
        $address = Address::findOrFail($id);

        if ($request->is_default) {
            $this->setOtherAddressesAsNotDefault();
        }

        $input = $request->all();

        $address->fill($input)->save();

        return response([
                 'data' => new AddressesResource($address)
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Address $address)
    {
        $address->delete();

        return response()->json([
            'message' => 'deleted',
        ], 200);
    }
}