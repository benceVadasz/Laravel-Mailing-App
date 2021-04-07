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

    public function inboxAction(Request $request): JsonResponse
    {
        try {
            $userId = auth()->user()->id;
            $mail = DB::table('mails')->where('id_user_to', '=', $userId)
                ->join('users', 'mails.id_user_from', '=', 'users.id')
                ->select(array('mails.id as id', 'mails.subject', 'mails.message', 'mails.is_read', 'mails.sent', 'name'))
                ->get();
            return response()->json([
                'mail' => $mail,
                'id' => $userId,
            ], 200);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['something went wrong'], 400);
        }
    }

    public function sentAction(): JsonResponse
    {
        try {
            $userId = auth()->user()->id;
            $mail = DB::table('mails')->where('id_user_from', '=', $userId)
                ->join('users', 'mails.id_user_to', '=', 'users.id')
                ->select(array('mails.id as mailId', 'mails.subject', 'mails.message', 'mails.is_read', 'mails.sent', 'name'))
                ->get();
            return response()->json([
                'mail' => $mail,
                'id' => $userId,
            ], 200);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['something went wrong'], 400);
        }
    }

    public function getOneMailAction(Request $request): JsonResponse
    {
        try {
            $mail = DB::table('mails')->where('mails.id', '=', $request->id)
                ->join('users', 'mails.id_user_from', '=', 'users.id')
                ->select(array('mails.id as id', 'mails.subject',
                    'mails.message', 'mails.is_read', 'mails.sent', 'name'))
                ->get();
            $this->markRead($request->id);
            return response()->json([
                'mail' => $mail
            ], 200);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['something went wrong'], 400);
        }
    }

    public function markRead($id)
    {
        DB::table('mails')
            ->where('id', $id)
            ->update(['is_read' => 1]);
    }

    public function markUnRead(Request $request)
    {
        $id = $_GET["id"];
        DB::table('mails')
            ->where('id', $request->id)
            ->update(['is_read' => 0]);
    }
}
