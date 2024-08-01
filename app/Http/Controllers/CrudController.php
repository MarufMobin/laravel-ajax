<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CrudController extends Controller
{
    public function showAllCars()
    {
        $all_cars = Car::all();
        return view('all-cars', compact('all_cars'));
    }

    public function addCar(Request $request)
    {
        // perform form validation here
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'manufacture_year' => 'required',
            'engine_capacity' => 'required',
            'fuel_type' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['msg' => $validator->errors()->toArray()]);
        } else {
            try {
                $addCar = new Car;
                $addCar->name = $request->name;
                $addCar->manufacture_year = $request->manufacture_year;
                $addCar->engine_capacity = $request->engine_capacity;
                $addCar->fuel_type = $request->fuel_type;
                $addCar->save();
                return response()->json(['success' => true, 'msg' => 'car added successfully']);
            } catch (\Exception $e) {
                return response()->json(['success' => false, 'msg' => $e->getMessage()]);
            }
        }
    }

    public function  deleteCar($id)
    {
        try {
            $delete_car = Car::where('id', $id)->delete();
            return response()->json(['success' => true, 'msg' => 'Car Deleted Successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'msg' => $e->getMessage()]);
        }
    }
}
