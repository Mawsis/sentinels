<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MedicineController extends Controller
{
    public function fill()
    {
        Medicine::truncate();
        $string = file_get_contents('medicament.json');
        $json = json_decode($string, true);
        foreach ($json as $value){
            if(preg_match("/^B\/(\d+)$/",$value['cond'],$matches)){
                $number = $matches[1];
                Medicine::create([
                    'dci' => $value['dci'],
                    'brand' => $value['brand'],
                    'dosage' => $value['dosage'],
                    'cond' => $number
                ]);
            }
        }
        return Medicine::all();
    }
    public function index()
    {
        $medicines = Medicine::all();
        return response()->json($medicines);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'dci' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'dosage' => 'required|string|max:255',
            'cond' => 'required|integer',
        ]);
        if ($validator->fails()) {    
            return response()->json($validator->messages(), 200);
        }
        $medicine = Medicine::create($request->all());
        return response()->json($medicine, 201);
    }

    public function show(Medicine $medicine)
    {
        return response()->json($medicine);
    }

    public function update(Request $request, Medicine $medicine)
    {
        $validator = Validator::make($request->all(), [
            'dci' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'dosage' => 'required|string|max:255',
            'cond' => 'required|integer',
        ]);
        if ($validator->fails()) {    
            return response()->json($validator->messages(), 200);
        }

        $medicine->update($request->all());
        return response()->json($medicine);
    }

    public function destroy(Medicine $medicine)
    {
        $medicine->delete();
        return response()->json(null, 204);
    }
    public function filter(string $string){

        return Medicine::where('dci', 'like', '%' . $string . '%')
        ->orWhere('brand', 'like', '%' . $string . '%')->get();
    }
    public function patient(Patient $patient)
    {
        // Assuming you have a prescriptions relationship defined in your Patient model
        $prescriptions = $patient->prescriptions;

        // Initialize an empty array to collect medicines
        $medicines = [];

        // Loop through each prescription and retrieve associated medicines
        foreach ($prescriptions as $prescription) {
            $medicines = array_merge($medicines, [$prescription->medicine]);
        }

        return $medicines;    
    }
}
