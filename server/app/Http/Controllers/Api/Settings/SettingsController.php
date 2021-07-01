<?php

namespace App\Http\Controllers\Api\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\SettingsRequest;
use App\Http\Resources\Settings\SettingsResource;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $settings = Setting::get()->first();

        return new SettingsResource($settings);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SettingsRequest $request)
    {
        $settings = Setting::get()->first();

        $input = $request->all();

        $settings->fill($input)->save();

        return response([
            'data' => new SettingsResource($settings)
        ], 200);
    }
}