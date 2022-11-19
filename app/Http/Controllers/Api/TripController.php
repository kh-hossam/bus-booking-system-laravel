<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\WrongStationsOrderException;
use App\Http\Controllers\Controller;
use App\Http\Requests\ListAvailableTripSeatsRequest;
use App\Http\Requests\StoreTripRequest;
use App\Http\Requests\UpdateTripRequest;
use App\Http\Resources\TripWithAvailableSeatsResource;
use App\Libraries\ApiResponse;
use App\Models\Seat;
use App\Models\Trip;

class TripController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ListAvailableTripSeatsRequest $request)
    {
        $trips = Trip::withWhereHas('stops', function($query) use($request){
            $query->where('station_id', $request->input('start_station_id'))
                ->orWhere('station_id', $request->input('end_station_id'));
        })
            ->whereRelation('stops', 'station_id', $request->input('end_station_id'))
            ->with('bus')->get();

        if($trips->isEmpty()){
            return ApiResponse::fail([], 'No available trips');
        }

        $trips->each(function(Trip $trip) use ($request){
            if($trip->stops->count() > 1){
                $startStation = $trip->stops->where('station_id', $request->input('start_station_id'))->first();
                $endStation = $trip->stops->where('station_id', $request->input('end_station_id'))->first();
                if($startStation->order > $endStation->order){
                    throw new WrongStationsOrderException();
                }
            }

            $trip->available_seats = $trip->bus->seats()->whereDoesntHave('reservations')
                ->orWhere(function ($query) use ($request){
                    $query->whereRelation('reservations', 'arrival_stop_id', $request->input('start_station_id'))
                        ->whereDoesntHave('reservations', function ($query) use ($request){
                            $query->where('departure_stop_id', $request->input('start_station_id'));
                        });
                })->get();
        });

        return ApiResponse::success(TripWithAvailableSeatsResource::collection($trips));
    }

}
