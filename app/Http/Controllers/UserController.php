<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
  public function register(Request $request)
  {
      $this->validate($request, [
          'email' => 'required|unique:users|email',
          'password' => 'required|min:6'
      ]);

      $email = $request->input('email');
      $password = Hash::make($request->input('password'));

      $user = User::create([
          'email' => $email,
          'password' => $password
      ]);

      return $this->responseRequestSuccess($user, 201);
  }
  
  public function login(Request $request)
  {
      $this->validate($request, [
          'email' => 'required|email',
          'password' => 'required|min:6'
      ]);

      $email = $request->input('email');
      $password = $request->input('password');

      $user = User::where('email', $email)->first();
      if (!$user) {
          return $this->responseRequestError('Login failed', 401);
      }

      $isValidPassword = Hash::check($password, $user->password);
      if (!$isValidPassword) {
        return $this->responseRequestError('Login failed', 401);
      }

      $generateToken = bin2hex(random_bytes(40));
      $user->update([
          'token' => $generateToken
      ]);

      return $this->responseRequestSuccess($user);
  }
} 