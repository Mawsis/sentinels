<?php

namespace App\Http\Controllers;

use App\Models\Dose;
use App\Models\Prescription;
use Carbon\Carbon;
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
            "patient_id"  => "required|exists:patients,id",
            "medicine_id" => "required|exists:medicines,id",
            "quantity"    => "required|integer|min:1",
            "remaining"   => "required|integer|min:0",
            "times"   => "required",
            "often"   => "required",
        ]);
        if ($validator->fails()) {    
            return response()->json($validator->messages(), 200);
        }
        $prescription = Prescription::create([
            "patient_id"  => request("patient_id"), 
            "medicine_id" => request("medicine_id"),
            "quantity"    => request("quantity"),
            "remaining"   => request("remaining"),
        ]);
        $now  = Carbon::now()->addDay();
        for($i = 0; $i < intval(request('quantity'));$i++){
            for($j = 0; $j < count(request('times'));$j++){
                Dose::create([
                    'prescription_id' => $prescription->id,
                    'date' => $now->setTimeFromTimeString(request('times')[$j]),
                ]);
            }
            $now->addDays(intval(request('often')));
        }
        return $prescription;
    }
}
