<?php


namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class UserController
{

    public function getUserIdByName($email)
    {
        try {
            $userId = User::where('email', $email)->first()->id;
            return $userId;
        } catch(\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['email not found'], Response::HTTP_BAD_REQUEST);
        }
    }
}
