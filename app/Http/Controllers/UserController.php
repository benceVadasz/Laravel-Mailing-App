<?php


namespace App\Http\Controllers;


use Illuminate\Support\Facades\DB;

class UserController
{

    public function getUserIdByName($email)
    {
        try {
            return DB::table('users')->where('email', '=', $email)->pluck('id')->toArray()[0];
        } catch(\Exception $e) {
            Log::error($e->getMessage());
            return response();
        }
    }
}
