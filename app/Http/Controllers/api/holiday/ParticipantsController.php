<?php

namespace App\Http\Controllers\api\holiday;

use App\Http\Controllers\Controller;
use App\Http\Requests\holiday\ParticipantRequest;
use App\services\holiday\ParticipantsService;
use Illuminate\Http\Request;

class ParticipantsController extends Controller
{
    public function __construct(protected ParticipantsService $participantsService)
    {
    }

    public function relatedParticipants(ParticipantRequest $request, $id)
    {
        return $this->participantsService->relatedParticipants($request->validated('ids'), $id);
    }

    public function unrelatedParticipants(ParticipantRequest $request, $id)
    {
        return $this->participantsService->unrelatedParticipants($request->validated('ids'), $id);
    }
}
