<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;

class RoomSearchController extends Controller
{
    public function index(Request $request)
    {
        dump($request->all());
        // $rooms = Room::where('type', $request->booking_roomtype)
        // ->where('occupancy', '>=', $request->booking_adults)
        // ->where('status', 'available')
        // ->get();

        $rooms = new Room;
        if ($request->booking_roomtype) {
            $rooms = $rooms->where('type', $request->booking_roomtype);
        }
        if ($request->booking_adults) {
            $rooms = $rooms->where('occupancy', '>=', $request->booking_adults);
        }
        $rooms = $rooms->get();
        dd($rooms);
    }
}
