<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

use App\Models\Studio;
class StudioController extends Controller
{
    public function index()
    {
        $data = Studio::get();

        return response()->json([
            'data' => $data
        ], 200);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'branch_id' => 'required|integer',
            'basic_price' => 'required|integer|between:1,1000000',
            'additional_friday_price' => 'required|integer|between:0,1000000',
            'additional_saturday_price' => 'required|integer|between:0,1000000',
            'additional_sunday_price' => 'required|integer|between:0,1000000'
        ]);

        if($validator->fails())
        {
            return response()->json([
                'message' => 'invalid field'
            ], 422);
        }

        $data = new Studio;
        $data->name = $request->input('name');
        $data->branch_id = $request->input('branch_id');
        $data->basic_price = $request->input('basic_price');
        $data->additional_friday_price = $request->input('additional_friday_price');
        $data->additional_saturday_price = $request->input('additional_saturday_price');
        $data->additional_sunday_price = $request->input('additional_sunday_price');
        $data->save();

        return response()->json([
            'message' => 'create studio success'
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'branch_id' => 'required|integer',
            'basic_price' => 'required|integer|between:1,1000000',
            'additional_friday_price' => 'required|integer|between:0,1000000',
            'additional_saturday_price' => 'required|integer|between:0,1000000',
            'additional_sunday_price' => 'required|integer|between:0,1000000'
        ]);

        if($validator->fails())
        {
            return response()->json([
                'message' => 'invalid field'
            ], 422);
        }

        $data = Studio::find($id);
        $data->name = $request->input('name');
        $data->branch_id = $request->input('branch_id');
        $data->basic_price = $request->input('basic_price');
        $data->additional_friday_price = $request->input('additional_friday_price');
        $data->additional_saturday_price = $request->input('additional_saturday_price');
        $data->additional_sunday_price = $request->input('additional_sunday_price');
        $data->save();

        return response()->json([
            'message' => 'update studio success'
        ], 200);
    }

    public function destroy($id)
    {
        Studio::find($id)->delete();

        return response()->json([
            'message' => 'delete studio success' 
        ], 200);
    }
}
