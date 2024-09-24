<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
	/**
	 * Return the authenticated user.
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function me()
	{
		$user = Auth::user();
		return response()->json($user);
	}
}
