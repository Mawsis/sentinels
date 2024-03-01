<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
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
            'date_id' => 'exists:dates,id',
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
}
