<?php

namespace App\services\holiday;

use App\Models\Holiday;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HolidayService
{
    public function __construct(protected Holiday $model)
    {
    }

    public function getAll(): JsonResponse
    {
        try {
            return response()->json([
                'data' => $this->model::with('creator', 'updater', 'participants')->get()
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'message' => 'An error has occurred',
                'info' => $exception->getMessage(),
            ],500);
        }
    }

    public function getOne($id): JsonResponse
    {
        try {
            return response()->json([
                'data' => $this->model::with('creator', 'updater', 'participants')->find($id)
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'message' => 'An error has occurred',
                'info' => $exception->getMessage(),
            ],500);
        }
    }

    public function create($data): JsonResponse
    {
        try {
            DB::beginTransaction();

            $user = Auth::guard('api')->user();
            $data = $this->model::create([
                'title' => $data->title,
                'description' => $data->description,
                'date' => $data->date,
                'location' => $data->location,
                'created_by' => $user->id,
            ]);

            DB::commit();
            return response()->json([
                'message' => 'Holiday created successfully',
                'data' => $data
            ]);
        } catch (\Exception $exception) {
            DB::rollBack();
            return response()->json([
                'message' => 'An error has occurred',
                'info' => $exception->getMessage(),
            ],500);
        }
    }

    public function update($id, $data): JsonResponse
    {
        try {
            DB::beginTransaction();
            $holiday = $this->model::where('id', $id)->first();

            if ($holiday == null) {
                return response()->json([
                    'message' => 'Holiday plan not found',
                ], 404);
            }

            $user = Auth::guard('api')->user();
            $data = $holiday->where('id', $id)->update([
                'title' => $data->title,
                'description' => $data->description,
                'date' => $data->date,
                'location' => $data->location,
                'updated_by' => $user->id,
            ]);

            $holiday = $this->model::where('id', $id)->first();
            DB::commit();
            return response()->json([
                'message' => 'Holiday update successfully',
                'data' => $holiday
            ]);
        } catch (\Exception $exception) {
            DB::rollBack();
            return response()->json([
                'message' => 'An error has occurred',
                'info' => $exception->getMessage(),
            ],500);
        }
    }

    public function delete($id): JsonResponse
    {
        try {
            $holiday = $this->model::where('id', $id)->first();

            if ($holiday == null) {
                return response()->json([
                    'message' => 'Holiday plan not found',
                ], 404);
            }
            $holiday->delete();
            return response()->json([
                'message' => 'Holiday deleted successfully',
            ]);
        } catch (\Exception $exception) {
            DB::rollBack();
            return response()->json([
                'message' => 'An error has occurred',
                'info' => $exception->getMessage(),
            ],500);
        }
    }

    public function pdfGenerator($id)
    {
        try {
            $holiday = $this->model::with('creator', 'updater', 'participants')->find($id);
            if ($holiday == null) {
                return response()->json([
                    'message' => 'Holiday plan not found',
                ], 404);
            }
            $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('pdf-holiday', compact('holiday'));
            $pdf->setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);
            $pdf->save(public_path('pdf-holiday'));
            return $pdf->download('pdf-holiday');
        } catch (\Exception $exception) {
            DB::rollBack();
            return response()->json([
                'message' => 'An error has occurred',
                'info' => $exception->getMessage(),
            ],500);
        }
    }
}
