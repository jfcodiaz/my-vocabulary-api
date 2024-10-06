<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     *
     * @OA\Get(
     *     path="/api/v1/me",
     *     summary="Get a list of conjugation types",
     *     tags={"User"},
     *     security={{ "sanctum": {} }},
     *     @OA\Response(
     *         response=200,
     *         description="A list of conjugation types with examples",
     *          @OA\MediaType(
     *             mediaType="application/json"
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal server error"
     *     ),
     * )
     */
    public function me()
    {
        $user = Auth::user();
        return response()->json($user);
    }
}
