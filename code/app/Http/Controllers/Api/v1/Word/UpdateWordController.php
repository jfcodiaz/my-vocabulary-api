<?php

namespace App\Http\Controllers\Api\v1\Word;

use App\Models\Word;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

class UpdateWordController extends Controller
{
    /**
     * Update the specified word in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, Word $word): JsonResponse
    {
        $request->validate([
            'word' => 'required|string|max:255'
        ]);

        $word->word = $request->input('word');
        $word->save();

        return response()->json([
            'message' => 'Word updated successfully',
            'data' => [
                'word' => $word
            ]
        ], 200);
    }
}
