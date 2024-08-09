<?php

namespace App\services\holiday;

use App\Models\Holiday;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class ParticipantsService
{
    public function __construct(protected Holiday $model)
    {
    }

    public function relatedParticipants(array $ids, $id): JsonResponse
    {
        try {
            DB::beginTransaction();

            $holiday = $this->model::where('id', $id)->first();

            if ($holiday == null) {
                return response()->json([
                    'message' => 'Holiday plan not found',
                ], 404);
            }

            $holiday->participants()->attach($ids);
            DB::commit();

            return response()->json([
                'message' => 'Participants related successfully',
            ]);
        } catch (\Exception $exception) {
            DB::rollBack();
            return response()->json([
                'message' => 'An error has occurred',
                'info' => $exception->getMessage(),
            ],500);
        }
    }

    public function unrelatedParticipants(array $ids, $id): JsonResponse
    {
        try {
            DB::beginTransaction();

            $holiday = $this->model::where('id', $id)->first();

            if ($holiday == null) {
                return response()->json([
                    'message' => 'Holiday plan not found',
                ], 404);
            }

            $holiday->participants()->detach($ids);
            DB::commit();

            return response()->json([
                'message' => 'Participants removed successfully',
            ]);
        } catch (\Exception $exception) {
            DB::rollBack();
            return response()->json([
                'message' => 'An error has occurred',
                'info' => $exception->getMessage(),
            ],500);
        }
    }
}
