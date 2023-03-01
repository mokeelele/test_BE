<?php

namespace App\Http\Controllers;

use App\Repositories\Attendance\AttendanceRepository;

use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    private $AttendanceRepository;
    public function __construct(AttendanceRepository $AttendanceRepository)
    {
        $this->AttendanceRepository = $AttendanceRepository;
    }
    public function index()
    {
        return $this->AttendanceRepository->getFunction();
    }
    public function clockIn(Request $request)
    {
        return $this->AttendanceRepository->clockInFunction($request);
    }
}
