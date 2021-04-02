<?php

namespace App\Http\Controllers;

use App\Models\Mail;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class MailController extends Controller
{
    public function composeAction(Request $request): ?JsonResponse
    {
        $user = new UserController;
        try {
            $receiverEmail = $request->get('email');
            $senderId = auth()->user()->id;
            $receiverId = $user->getUserIdByName($receiverEmail);
            $subject = $request->get('subject');
            $message = $request->get('message');
            Mail::create(
                ['id_user_from' => $senderId, 'id_user_to' => $receiverId,
                    'subject' => $subject, 'message' => $message]
            );
            return response()->json(['inserted'], Response::HTTP_CREATED);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['something went wrong'], Response::HTTP_BAD_REQUEST);
        }
    }
}
