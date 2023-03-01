<?php

namespace App\Repositories\Auth;

use LaravelEasyRepository\Implementations\Eloquent;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\BaseController;
use App\Models\User;
use App\Models\detail_user;



class AuthRepositoryImplement extends Eloquent implements AuthRepository
{

    /**
     * Model class to be used in this repository for the common methods inside Eloquent
     * Don't remove or change $this->model variable name
     * @property Model|mixed $model;
     */
    protected $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }
    public function getFunction()
    {
        $data = $this->model->where('id', '!=', '2')->get();

        return BaseController::success($data, 'Success');
    }
    public function loginFunction($request)
    {
        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            return response()
                ->json(['message' => 'Unauthorized'], 401);
        }
        try {
            $user = $this->model::where('email', $request->email)
                ->first();
            if ($user == NULL) {
                return BaseController::error(NULL, 'User need to verification', 400);
            }

            $token = $user->createToken('auth_token')->plainTextToken;

            $accessToken = [
                "accessToken" => $token
            ];

            $result = [
                "sanctum" => $accessToken,
                "user" => $user,
            ];
        } catch (\Throwable $th) {
            throw $th;
        }

        return BaseController::success($result, 'Authorized');
    }

    public function logOutFunction()
    {
        try {
            $logout = auth()->user()->tokens()->delete();
        } catch (\Throwable $th) {
            throw $th;
        }
        return BaseController::success("", 'Berhasil logged out');
    }

    public function profileFunction()
    {
        $user = auth('sanctum')->user();

        return BaseController::success($user, "Berhasil mengambil data user");
    }

    public function updateUser($request, $id)
    {
        $query = $this->model->where("id", $id)->first();
        if (empty($query)) {
            return BaseController::error(NULL, "Data tidak ditemukan", 400);
        }
        $query->name = $request->name;
        $query->jenis_kelamin = $request->jenis_kelamin;
        $query->no_hp = $request->no_hp;
        $query->save();

        return BaseController::success($query, "Sukses mengubah data", 200);
    }

    public function createUser($request)
    {

        try {

            $user = $this->model::create([
                'name' => $request->name,
                'email' => $request->email,
                'jenis_kelamin' => $request->jenis_kelamin,
                'no_hp' => $request->no_hp,
                'password' => bcrypt($request->password)
            ]);


            $success['token'] =  $user->createToken('auth_token')->plainTextToken;
            $success['name'] =  $user->name;
        } catch (\Throwable $th) {
            throw $th;
        }

        return BaseController::success(NULL, "Berhasil menambahkan user", 200);
    }
    public function getUsersFunction($id)
    {
        $query = $this->model->where('id', $id)->first();

        return BaseController::success($query, "Berhasil ", 200);
    }
    // Write something awesome :)
}
