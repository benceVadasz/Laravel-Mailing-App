<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function registerAction(Request $request): JsonResponse
    {
        try{
            $validation = $request->validate([
                'name' => 'required',
                'email' => 'required|email',
                'password' => 'required']);
        }
        catch (\Exception $exception){
            return response()->json("error", Response::HTTP_BAD_REQUEST);
        }
        $user = User::firstOrCreate([ "name" => $request->get('name'),
            "email" => $request->get('email'),
            "password" => Hash::make( $request->get('password'))]);
        return response()->json([
            "token" => $user->createToken($user->name)->plainTextToken,
            'status_code' => 200,
            'message' => 'User created successfully'
        ]);
    }
}
