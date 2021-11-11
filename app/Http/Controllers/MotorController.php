<?php

namespace App\Http\Controllers;

use App\Models\Motor;
use Illuminate\Http\Request;

class MotorController extends Controller
{
    //menampilkan semua data
    public function showAllMotor() {
        return $this->responseRequestSuccess(Motor::all());
    }

    //menampilkan data per id
    public function showOneMotor($id){
        $motor = Motor::find($id);
        if ($motor) {
            return $this->responseRequestSuccess($motor);
        } else {
            return $this->responseRequestError('Data not found', 404);
        }
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
        return $this->responseRequestSuccess($author, 201);
    }

    //update data
    public function update($id, Request $request){
        $author = Motor::findOrFail($id);
        $author->update($request->all());
        return $this->responseRequestSuccess($author);
    }

    //hapus data per id
    public function delete($id){
        Motor::findOrFail($id)->delete();
        return $this->responseRequestSuccess([]);
    }
}