<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class PatientController extends Controller
{
    public function index()
    {
        return Patient::all();
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
        ]);
        if ($validator->fails()) {    
            return response()->json($validator->messages(), 200);
        }
        

        return Patient::create($request->all());
    }

    public function show(Patient $patient)
    {
        return $patient;
    }

    public function update(Request $request, Patient $patient)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
        ]);
        if ($validator->fails()) {    
            return response()->json($validator->messages(), 200);
        }

        $patient->update($request->all());
        return $patient;
    }

    public function destroy(Patient $patient)
    {
        $patient->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
