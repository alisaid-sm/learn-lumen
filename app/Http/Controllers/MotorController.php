<?php

namespace App\Http\Controllers;

use App\Models\Motor;
use Illuminate\Http\Request;

class MotorController extends Controller
{
    //menampilkan semua data
    public function showAllMotor() {
        return response()->json(Motor::all());
    }

    //menampilkan data per id
    public function showOneMotor($id){
        return response()->json(Motor::find($id));
    }

    //insert data
    public function create(Request $request){
        //validasi
        $this->validate($request, [
            'merek' => 'required',
            'cc' => 'required',
            'pabrikan' => 'required'
        ]);
        $author = Motor::create($request->all());
        return response()->json($author, 201);
    }

    //update data
    public function update($id, Request $request){
        $author = Motor::findOrFail($id);
        $author->update($request->all());
        return response()->json($author, 200);
    }

    //hapus data per id
    public function delete($id){
        Motor::findOrFail($id)->delete();
        return response('Deleted Successfully', 200);
    }
}