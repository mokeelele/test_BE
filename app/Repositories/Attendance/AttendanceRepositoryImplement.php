<?php

namespace App\Repositories\Attendance;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Attendance;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use DB;
use App\Http\Controllers\BaseController;

class AttendanceRepositoryImplement extends Eloquent implements AttendanceRepository
{

    /**
     * Model class to be used in this repository for the common methods inside Eloquent
     * Don't remove or change $this->model variable name
     * @property Model|mixed $model;
     */
    protected $model;

    public function __construct(Attendance $model)
    {
        $this->model = $model;
    }

    public function getFunction()
    {

        $query = $this->model->join('users', 'attendance.id_user', '=', 'users.id')->get();

        $result = [];
        foreach ($query as $key => $value) {
            $result[$key]['id'] = $value->id;
            $result[$key]['name'] = $value->name;
            $result[$key]['clock_in'] = $value->clock_in;
            $result[$key]['photo'] = $value->photo;
        }
        return BaseController::success($result, 'Success');
    }
    public function clockInFunction($request)
    {
        $today = Carbon::now();
        $user = auth('sanctum')->user();
        try {
            $url = "https://images.peopleimages.com/picture/202212/2567227-happy-portrait-or-doctor-taking-a-selfie-for-a-social-media-profile-picture-in-a-healthcare-hospital-on-a-break.-relaxing-man-or-face-of-medical-worker-taking-pictures-with-pride-or-smile-in-office-fit_400_400.jpg";

            DB::beginTransaction();

            $input = new $this->model();
            $input->id_user = $user->id;
            $input->clock_in = $today;
            $input->photo = $url;
            $input->save();
            $input->id;

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return BaseController::error(NULL, $e->getMessage(), 400);
        }
        return BaseController::success($input, "Sukses menambah data", 200);
    }


    // Write something awesome :)
}
