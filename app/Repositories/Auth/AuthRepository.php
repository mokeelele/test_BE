<?php

namespace App\Repositories\Auth;

use LaravelEasyRepository\Repository;

interface AuthRepository extends Repository
{

    // Write something awesome :)
    public function getUsersFunction($id);
    public function getFunction();
    public function loginFunction($request);
    public function logOutFunction();
    public function profileFunction();
    public function createUser($request);
    public function updateUser($request, $id);
}
