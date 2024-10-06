<?php
namespace App\Http\Controllers\Api\v1\Words;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Word; // Import the Word model
use Illuminate\Support\Facades\Auth; // Import Auth facade

class StoreController extends Controller
{
    public function __invoke(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'word' => 'required|string|max:255',
            'definition' => 'required|string',
        ]);

        // Get the logged-in user
        $user = Auth::user();
        return response()->json([]);
        dd($user);
        // Create a new word associated with the logged-in user
        $word = Word::create([
            'word' => $validatedData['word'],
            'definition' => $validatedData['definition'],
            'user_id' => $user->id, // Associate with the logged-in user
        ]);

        // Return a response
        return response()->json([
            'message' => 'Word created successfully',
            'data' => $word
        ], 201);
    }
}
