<?php

namespace App\Http\Controllers;

use App\Models\Dose;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DoseController extends Controller
{
    public function check(Dose $dose, Request $request)
    {
        $dose->update([
            'validated' => !$dose->validated
        ]);
        return $dose;
    }
    public function today()
    {
        return Dose::whereDate('date',Carbon::today())->get();
    }
    public function missed(){
        return Dose::where('validated',false)
                ->where('date','>',Carbon::today()) 
                ->get();
    }
    public function month()
    {
        $startOfMonth = Carbon::now()->startOfMonth(); // Get the start of the current month
        $endOfMonth = Carbon::now()->endOfMonth(); // Get the end of the current month

        // Retrieve appointments between the start and end of the month
        return Dose::whereBetween('date', [$startOfMonth, $endOfMonth])
                        ->get();
    }
}
