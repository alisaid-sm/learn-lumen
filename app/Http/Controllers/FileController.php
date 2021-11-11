<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class FileController extends Controller
{
  public function upload(Request $request)
  {
    $response = null;
    $user = (object) ['image' => ""];

    if ($request->hasFile('image')) {
        $original_filename = $request->file('image')->getClientOriginalName();
        $original_filename_arr = explode('.', $original_filename);
        $file_ext = end($original_filename_arr);
        $destination_path = './upload/';
        $image = 'U-' . time() . '.' . $file_ext;

        if ($request->file('image')->move($destination_path, $image)) {
            $user->image = './upload/' . $image;
            return $this->responseRequestSuccess($user);
        } else {
            return $this->responseRequestError('Cannot upload file');
        }
    } else {
        return $this->responseRequestError('File not found');
    }
  }
} 