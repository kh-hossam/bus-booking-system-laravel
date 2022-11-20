<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\WrongStationsOrderException;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReservationRequest;
use App\Libraries\ApiResponse;
use App\Models\Reservation;
use App\Models\Station;
use App\Models\Stop;
use App\Models\Trip;
use App\Services\ReservationService;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreReservationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreReservationRequest $request)
    {
        // first validate that there is actually a valid seat with this trip_id and seat_id
        $trip = Trip::withWhereHas('stops', function($query) use($request){
            $query->where('station_id', $request->input('start_station_id'))
                ->orWhere('station_id', $request->input('end_station_id'));
        })
            ->whereRelation('stops', 'station_id', $request->input('end_station_id'))
            ->find($request->input('trip_id'));

        if(!$trip){
            return ApiResponse::fail([], 'No trip with such data');
        }

        if($trip->stops->count() > 1){
            $startStation = $trip->stops->where('station_id', $request->input('start_station_id'))->first();
            $endStation = $trip->stops->where('station_id', $request->input('end_station_id'))->first();
            if($startStation->order > $endStation->order){
                throw new WrongStationsOrderException();
            }
        }

        $trip->available_seats = $trip->bus->seats()
            ->where('id', $request->input('seat_id'))
            ->where(function (Builder $query) use ($request){
                $query->whereDoesntHave('reservations')
                    ->orWhere(function (Builder $query) use ($request){
                        $query->whereRelation('reservations', 'arrival_stop_id', '<=', $request->input('start_station_id'))
                            ->whereDoesntHave('reservations', function (Builder $query) use ($request){
                                $query->where('departure_stop_id', $request->input('start_station_id'));
                            });
                    });
            })
            ->get();

        if($trip->available_seats->isEmpty()){
            return ApiResponse::fail([], 'This Seat not available');
        }

        // create reservation
        auth()->user()->reservations()->create([
            'seat_id' => $request->input('seat_id'),
            'departure_stop_id' => Stop::where('trip_id', $request->input('trip_id'))->where('station_id', $request->input('start_station_id'))->first()->id,
            'arrival_stop_id' => Stop::where('trip_id', $request->input('trip_id'))->where('station_id', $request->input('end_station_id'))->first()->id,
        ]);

        return ApiResponse::success([], 'Your seat is booked successfully', 204);
    }
}
