<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class DoctorController extends Controller
{
    public function index()
    {
        return Doctor::orderBy('id', 'desc')->get();
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'hospital' => 'required|string',
            'location' => 'required|string',
            'cellphone' => 'required|string',
        ]);
        if ($validator->fails()) {    
            return response()->json($validator->messages(), 200);
        }
        return Doctor::create($request->all());
    }

    public function show(Doctor $doctor)
    {
        return $doctor;
    }

    public function update(Request $request, Doctor $doctor)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'hospital' => 'required|string',
            'location' => 'required|string',
            'cellphone' => 'required|string',
        ]);
        if ($validator->fails()) {    
            return response()->json($validator->messages(), 200);
        }
        $doctor->update($request->all());
        return $doctor;
    }

    public function destroy(Doctor $doctor)
    {
        $doctor->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
