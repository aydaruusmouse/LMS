<?php

namespace App\Http\Controllers\Api\Student;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\MyMeetingResource;
use App\Repositories\LiveClassRepository;
use App\Traits\ApiReturnFormatTrait;

class LiveClassController extends Controller
{
    use ApiReturnFormatTrait;

    protected $liveClassRepository;

    public function __construct(LiveClassRepository $liveClassRepository)
    {
        $this->liveClassRepository = $liveClassRepository;
    }

    public function meetings(): \Illuminate\Http\JsonResponse
    {
        try {

            $meetings = MyMeetingResource::collection($this->liveClassRepository->allLiveClass());

            $data     = [
                'my_meeting' => $meetings,
            ];

            return $this->responseWithSuccess('meeting_retrieved_successfully', $data);

        } catch (\Exception $e) {
            return $this->responseWithError($e->getMessage());
        }
    }
}
