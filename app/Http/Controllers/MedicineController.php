<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use Illuminate\Http\Request;

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
            echo $value['id'] . "\n";
        }
        return Medicine::all();
    }
}
