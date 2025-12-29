<?php

namespace App\Http\Controllers\Api\Student;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\ChatInstructorResource;
use App\Http\Resources\Api\UserMessageResource;
use App\Repositories\ChatSystemRepository;
use App\Traits\ApiReturnFormatTrait;
use App\Traits\ImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChatSystemController extends Controller
{
    use ApiReturnFormatTrait, ImageTrait;

    protected $chatSystemRepository;

    public function __construct(ChatSystemRepository $chatSystemRepository)
    {
        $this->chatSystemRepository = $chatSystemRepository;
    }

    public function instructors(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            $data             = $request->all();
            $data['paginate'] = setting('api_paginate');
            $data['user_id']  = jwtUser()->id;

            $users            = $this->chatSystemRepository->chatInstructors($data);
            $data             = ChatInstructorResource::collection($users);

            return $this->responseWithSuccess(__('instructor_retrieved_successfully'), $data);

        } catch (\Exception $e) {
            return $this->responseWithError($e->getMessage());
        }
    }

    public function messages(Request $request): \Illuminate\Http\JsonResponse
    {
        DB::beginTransaction();
        try {
            $chat_room = $this->chatSystemRepository->find($request->chat_room_id);

            if (! $chat_room) {
                return $this->responseWithError(__('no_conversation_found'));
            }

            $messages  = $this->chatSystemRepository->userMessages($chat_room);

            $data      = [
                'messages' => new UserMessageResource($messages),
            ];

            DB::commit();

            return $this->responseWithSuccess(__('conversation_retrieved'), $data);
        } catch (\Exception $e) {
            DB::rollBack();

            return $this->responseWithError($e->getMessage());
        }
    }

    public function sendMessage(Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = validator($request->all(), [
            'msg'  => 'required_without:file',
            'file' => 'required_without:msg',
        ]);

        if ($validator->fails()) {
            return $this->responseWithError(__('required_field_missing'), $validator->errors(), 422);
        }

        try {
            $user            = jwtUser();
            $data            = $request->all();
            $data['user_id'] = $user->id;

            $chatroom        = $this->chatSystemRepository->findChatRoom($data);

            if (! $chatroom && $user->role_id != 3) {
                return response()->json(['error' => __('you_cannot_start_conversation')], 401);
            }

            if (! $chatroom) {
                $chatroom = $this->chatSystemRepository->createChatroom([
                    'user_id'     => $user->id,
                    'receiver_id' => $request->receiver_id,
                ]);
            }

            $msg             = $request->msg;

            if ($request->hasFile('file')) {
                $msg = $request->file('file')->getClientOriginalName();
            }

            $file_type       = $request->hasFile('file') ? $request->file('file')->getMimeType() : '';

            $this->chatSystemRepository->sendMessage([
                'chat_room_id' => $chatroom->id,
                'message'      => $msg,
                'type'         => 1,
                'is_file'      => $request->hasFile('file'),
                'file_type'    => $file_type,
                'file'         => arrayCheck('file', $data) && $request->hasFile('file') ? $this->saveFile($data['file'], $file_type, false) : '',
            ]);

            return $this->responseWithSuccess(__('message_sent_successfully'));
        } catch (\Exception $e) {
            return $this->responseWithError($e->getMessage());
        }
    }
}
