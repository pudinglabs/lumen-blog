<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use Illuminate\Http\Response;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserController extends Controller
{
    protected $repo;

    public function __construct(UserRepository $repo)
    {
        $this->middleware('auth');
        $this->repo = $repo;
    }

    public function profile()
    {
        return response()->json([JWTAuth::user()], Response::HTTP_OK);
    }

    public function allUsers()
    {
        return response()->json($this->repo->all(), Response::HTTP_OK);
    }

    public function singleUser($id)
    {
        try {
            $user = $this->repo->find($id);

            return response()->json($user, Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], Response::HTTP_NOT_FOUND);
        }
    }
}
