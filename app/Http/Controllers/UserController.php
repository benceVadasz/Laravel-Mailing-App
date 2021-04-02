<?php


namespace App\Http\Controllers;


use App\Models\Mail;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserController
{

    public function getUserIdByName($email)
    {
        try {
            $userId = User::where('email', $email)->first()->id;
            return $userId;
        } catch(\Exception $e) {
            Log::error($e->getMessage());
            return response();
        }
    }
}
