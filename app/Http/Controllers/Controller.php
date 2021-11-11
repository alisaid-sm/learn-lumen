<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
  protected function responseRequestSuccess($ret, $statusCode = 200)
  {
      return response()->json(['status' => 'success', 'data' => $ret], $statusCode)
          ->header('Access-Control-Allow-Origin', '*')
          ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
  }

  protected function responseRequestError($message = 'Bad request', $statusCode = 200)
  {
      return response()->json(['status' => 'error', 'error' => $message], $statusCode)
          ->header('Access-Control-Allow-Origin', '*')
          ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
  }
}
