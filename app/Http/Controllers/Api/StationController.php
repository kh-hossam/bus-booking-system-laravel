<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\StationsLookupResource;
use App\Libraries\ApiResponse;
use App\Models\Station;

class StationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ApiResponse::success(StationsLookupResource::collection(Station::all()));
    }
}
