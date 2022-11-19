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
        $trip = Trip::findOrFail($request->input('trip_id'));

        if($trip->stops->count() > 1){
            if($trip->stops->first()->order > $trip->stops->last()->order){
                throw new WrongStationsOrderException();
            }
        }

        $trip->available_seats = $trip->bus->seats()
            ->where('id', $request->input('seat_id'))
            ->where(function (Builder $query) use ($request){
                $query->whereDoesntHave('reservations')
                    ->orWhereHas('reservations', function($query) use ($request) {
                        $query->where('arrival_stop_id', $request->input('start_station_id'));
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
