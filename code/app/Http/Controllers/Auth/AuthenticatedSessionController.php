<?php
namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;

class AuthenticatedSessionController extends Controller
{
    /**
     * @OA\Post(
     *     path="/login",
     *     summary="login",
     *     security={},
     *     tags={"Auth"},
     *     @OA\RequestBody(
     *       required=true,
     *       @OA\JsonContent(
     *          required={"email","password"},
     *          @OA\Property(property="email", type="string", format="email", example="user@example.com"),
     *          @OA\Property(property="password", type="string", format="password", example="password"),
     *      ),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="A list of conjugation types with examples",
     *         @OA\MediaType(
     *             mediaType="application/json"
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal server error"
     *     )
     * )
     */
    public function store(LoginRequest $request): Response|array
    {
        $request->authenticate();

        $request->session()->regenerate();

        $user = Auth::user();


        $token = $user->createToken($user->name)->plainTextToken;

        return [
            'user' => $user,
            'token' => $token
        ];
    }

    /**
     * @OA\Post(
     *     path="/logout",
     *     operationId="logoutUser",
     *     tags={"Auth"},
     *     summary="Logout user",
     *     description="Invalidate user session and logout",
     *     @OA\Response(
     *         response=204,
     *         description="Successful logout",
     *         @OA\MediaType(
     *             mediaType="application/json"
     *         )
     *     )
     * )
     */
    public function destroy(Request $request): Response
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return response()->noContent();
    }
}
