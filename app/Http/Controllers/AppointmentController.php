<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AppointmentController extends Controller
{
    public function index()
    {
        return Appointment::all();
    }
    public function show(Appointment $appointment)
    {
        return $appointment;
    }

    public function store(Request $request)
    {
        return Appointment::create($request->all());
    }
    public function update(Request $request, Appointment $appointment)
    {
        $validator = Validator::make($request->all(), [
            'appointment_time' => 'date',
            'title' => 'string',
            'doctor_id' => 'exists:doctors,id',
            'user_id' => 'nullable|exists:users,id',
        ]);
        if ($validator->fails()) {    
            return response()->json($validator->messages(), 200);
        }

        $appointment->update($request->all());

        return $appointment;
    }

    public function destroy(Appointment $appointment)
    {
        $appointment->delete();

        return response()->json(null, 204);
    }
    public function closest()
    {
        return Appointment::where('appointment_time', '>=', now())
        ->orderBy('appointment_time')
        ->first();
    }
    public function month()
    {
        $startOfMonth = Carbon::now()->startOfMonth(); // Get the start of the current month
        $endOfMonth = Carbon::now()->endOfMonth(); // Get the end of the current month

        // Retrieve appointments between the start and end of the month
        return Appointment::whereBetween('appointment_time', [$startOfMonth, $endOfMonth])
                        ->get();
    }
}
