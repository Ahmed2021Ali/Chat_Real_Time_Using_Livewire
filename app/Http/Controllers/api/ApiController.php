<?php

namespace App\Http\Controllers\api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class ApiController extends Controller
{
    public function login(Request $request)
    {
         $request->validate([
             'email'=> 'required|email',
             'password'=>'required'
         ]);

         $user =User::where('email',$request->email)->first();

         if(!$user || !Hash::check($request->password,$user->password))
         {
             return response()->json(['massage'=>'invalid credential',422]);
         }
         else
         {
             $token =$user->createToken('Name Token');
            return response()->json(['user'=>$user,'token'=>$token->plainTextToken]);
         }
    }
}
