<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Laravel\Lumen\Routing\Controller as BaseController;

/**
 * @OA\Info(
 *  title="Lumen Blog API",
 *  version="1.0.0",
 *  @OA\Contact(
 *    email="suromoyo@gmail.com",
 *    name="Mustoharin"
 *  )
 * )
 */
/**
 * @OA\Get(
 *     path="/",
 *     summary="Return home page",
 *     @OA\Response(
 *      response=200,
 *      description="version of lumen",
 *     )
 * )
 */
class Controller extends BaseController
{
    protected function respondWithToken($token)
    {
        return response()->json([
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::factory()->getTTL() * 60,
        ], 200);
    }
}
