<?php

namespace App\Http\Controllers;

use App\Repositories\Auth\AuthRepository;
use Illuminate\Http\Request;


class AuthController extends Controller
{
    private $AuthRepository;
    public function __construct(AuthRepository $AuthRepository)
    {
        $this->AuthRepository = $AuthRepository;
    }
    public function index()
    {
        return $this->AuthRepository->getFunction();
    }
    public function login(Request $request)
    {
        return $this->AuthRepository->loginFunction($request);
    }
    public function logout()
    {
        return $this->AuthRepository->logOutFunction();
    }
    public function profile()
    {
        return $this->AuthRepository->profileFunction();
    }
    public function users($id)
    {
        return $this->AuthRepository->getUsersFunction($id);
    }

    public function create(Request $request)
    {
        return $this->AuthRepository->createUser($request);
    }
    public function update(Request $request, $id)
    {
        return $this->AuthRepository->updateUser($request, $id);
    }
}
