<?php

namespace App\Http\Controllers\Api\v1\Word;

use App\Models\Word;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Api\v1\Word\DeleteWordRequest;

class DeleteWordController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(DeleteWordRequest $request, Word $word)
    {
        $word->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
