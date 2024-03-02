<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\DoseController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\PrescriptionController;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// This route is to fill the database with all medicines
Route::get('/fill',[MedicineController::class,'fill']);
//This route is to check taken doses
Route::put('/doses/{dose}/check',[DoseController::class,'check']);
//This route is to filter by name medicines
Route::get('/medicines/filter/{string}',[MedicineController::class,'filter']);
//This route is to get daily doses
Route::get('/doses/today',[DoseController::class,'today']);
//This route is to get the closest appointment
Route::get('/appointments/closest',[AppointmentController::class,'closest']);
//this route is to get the missed Doses
Route::get('/doses/missed',[DoseController::class,'missed']);
//this route is to get all appointment of this month
Route::get('appointments/month',[AppointmentController::class,'month']);
//this route is to get all doses this month
Route::get('doses/month',[AppointmentController::class,'month']);
//this route is to get all the medicines of a patient
Route::get('/medicines/patient/{patient}',[MedicineController::class,'patient']);


Route::post('/register',[UserAuthController::class,'register']);
Route::post('/login',[UserAuthController::class,'login']);
Route::post('/logout',[UserAuthController::class,'logout'])
        ->middleware('auth:sanctum');
//All the routes below are CRUD routes for each Model
Route::resource('users', UserController::class);
Route::resource('patients', PatientController::class);
Route::resource('prescriptions', PrescriptionController::class);
Route::resource('doctors', DoctorController::class);
Route::resource('appointments', AppointmentController::class);