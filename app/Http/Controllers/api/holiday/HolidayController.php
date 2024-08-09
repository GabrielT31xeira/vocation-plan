<?php

namespace App\Http\Controllers\api\holiday;

use App\Http\Controllers\Controller;
use App\Http\Requests\holiday\HolidayRequest;
use App\services\holiday\HolidayService;
use Illuminate\Http\Request;

class HolidayController extends Controller
{
    public function __construct(protected HolidayService $holidayService)
    {
    }

    public function getAll() {
        $response = $this->holidayService->getAll();
        return $response;
    }

    public function getOne($id)
    {
        $response = $this->holidayService->getOne($id);
        return $response;
    }

    public function create(HolidayRequest $request)
    {
        $response = $this->holidayService->create($request);
        return $response;
    }

    public function update($id, HolidayRequest $request)
    {
        $response = $this->holidayService->update($id, $request);
        return $response;
    }

    public function delete($id)
    {
        $response = $this->holidayService->delete($id);
        return $response;
    }

    public function pdfGenerator($id)
    {
        $response = $this->holidayService->pdfGenerator($id);
        return $response;
    }
}
