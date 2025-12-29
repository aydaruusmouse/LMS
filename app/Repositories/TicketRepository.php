<?php

namespace App\Repositories;

use App\Models\Ticket;
use App\Models\TicketReply;
use App\Traits\ImageTrait;

class TicketRepository
{
    use ImageTrait;

    public function all($data = [], $with = [])
    {
        if (! arrayCheck('paginate', $data)) {
            $data['paginate'] = setting('pagination');
        }

        return Ticket::with($with)->when(arrayCheck('user_id', $data), function ($query) use ($data) {
            $query->where('user_id', $data['user_id']);
        })->latest()->paginate($data['paginate']);
    }

    public function store($request)
    {
        $all_files            = [];

        if (arrayCheck('student_file', $request)) {
            $all_files[0]              = $this->saveImage($request['student_file'], 'ticket', true)['images'];
            $all_files[0]['file_type'] = 'image';
        }

        if (arrayCheck('file', $request)) {
            $array_file = explode(',', $request['file']);
            foreach ($array_file as $key => $array) {
                $files = $this->getAllType($array);
                if ($files) {
                    $all_files[] = $files;
                } else {
                    unset($array_file[$key]);
                }
            }
        }

        if (! arrayCheck('status', $request)) {
            $request['status'] = 'pending';
        }
        $request['file']      = $all_files;
        $request['user_id']   = auth()->id();
        $request['ticket_id'] = rand(1000, 50000);

        return Ticket::create($request);
    }

    public function find($id, $with = [])
    {
        return Ticket::find($id);
    }

    public function destroy($id)
    {
        return Ticket::destroy($id);
    }

    public function countByStatus($status)
    {
        return Ticket::where('status', $status)->count();
    }

    public function reply($request)
    {
        $all_files          = [];

        if (arrayCheck('student_file', $request)) {
            $all_files[0]              = $this->saveImage($request['student_file'], 'ticket', true)['images'];
            $all_files[0]['file_type'] = 'image';
        }

        if (arrayCheck('file_media_id', $request)) {
            $array_file = explode(',', $request['file_media_id']);
            foreach ($array_file as $array) {
                $files       = $this->getAllType($array);
                $all_files[] = $files;
            }
        }

        $request['file']    = $all_files;
        $request['user_id'] = auth()->id();

        return TicketReply::create($request);
    }

    public function replyUpdate($request, $id)
    {
        $reply           = TicketReply::find($id);
        $all_files       = [];
        if (arrayCheck('file_media_id', $request)) {
            $array_file = explode(',', $request['file_media_id']);
            foreach ($array_file as $array) {
                $files       = $this->getAllType($array);
                $all_files[] = $files;
            }
        }

        $request['file'] = $all_files;
        $reply->update($request);

        return $reply;
    }

    public function replyFind($id)
    {
        return TicketReply::find($id);
    }

    public function replyDelete($id): int
    {
        return TicketReply::destroy($id);
    }
}
