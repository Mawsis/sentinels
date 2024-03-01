<?php

namespace App\Http\Controllers;

use App\Models\Prescription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PrescriptionController extends Controller
{

    public function index()
    {
        return Prescription::all();
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'patient_id' => 'required|exists:patients,id',
            'medicine_id' => 'required|exists:medicines,id',
            'quantity' => 'required|integer|min:1',
            'remaining' => 'required|integer|min:0',
        ]);
        if ($validator->fails()) {    
            return response()->json($validator->messages(), 200);
        }
        return Prescription::create($request->all());
    }
}
