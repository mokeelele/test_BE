<?php

namespace App\Repositories\Attendance;

use LaravelEasyRepository\Repository;

interface AttendanceRepository extends Repository
{

    // Write something awesome :)
    public function getFunction();
    public function clockInFunction($request);
}
