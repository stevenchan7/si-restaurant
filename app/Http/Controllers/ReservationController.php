<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Table;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index()
    {
        $tables = Table::with('reservation')->get();
        // dd($tables);
        $reservations = Reservation::all();

        // dd($tables);
        return view('reservation.reservation', compact('tables'));
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
        // dd($request);
        $validated = $request->validate([
            // 'table_id'=> 'required',
            'customer_email'=> 'required',
            'date'=> 'required',
            'start_time'=> 'required',
            'end_time'=> 'required',
            // 'reservation_status '=> 'required',
        ]);
        $validated['table_id'] = $request->table_id;
        $validated['reservation_status'] = $request->status;

        // dd($validated);
        
        Reservation::create($validated);
        return redirect('/');
    }

    public function show()
    {
    }
    
}
