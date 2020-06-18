<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

use App\Models\Movie;

class MovieController extends Controller
{
    public function index()
    {
        $data = Movie::get();

        return response()->json([
            'data' => $data
        ], 200);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'minute_length' => 'required|integer|between:1,999',
            'picture' => 'required|file',
        ]);

        if($validator->fails())
        {
            return response()->json([
                'message' => 'invalid field'
            ], 422);
        }

        $file = $request->file('picture')->store('movies');

        $data = new Movie;
        $data->name = $request->input('name');
        $data->minute_length = $request->input('minute_length');
        $data->picture = $file;
        $data->save();

        return response()->json([
            'message' => 'create movie success'
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'minute_length' => 'required|integer|between:1,999',
            'picture' => 'required|file',
        ]);

        if($validator->fails())
        {
            return response()->json([
                'message' => 'invalid field'
            ], 422);
        }

        $file = $request->file('picture')->store('movies');

        $data = Movie::find($id);
        $data->name = $request->input('name');
        $data->minute_length = $request->input('minute_length');
        $data->picture = $file;
        $data->save();

        return response()->json([
            'message' => 'update movie success'
        ], 200);
    }

    public function destroy($id)
    {
        Movie::find($id)->delete();

        return response()->json([
            'message' => 'delete movie success' 
        ], 200);
    }
}
