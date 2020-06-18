<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\Branch;
class BranchController extends Controller
{
    public function index()
    {
        $data = Branch::get();

        return response()->json([
            'data' => $data
        ], 200);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);

        if($validator->fails())
        {
            return response()->json([
                'message' => 'invalid field'
            ], 422);
        }

        $data = new Branch;
        $data->name = $request->input('name');
        $data->save();

        return response()->json([
            'message' => 'create branch success'
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);

        if($validator->fails())
        {
            return response()->json([
                'message' => 'invalid field'
            ], 422);
        }

        $data = Branch::find($id);
        $data->name = $request->input('name');
        $data->save();

        return response()->json([
            'message' => 'update branch success'
        ], 200);
    }
    
    public function destroy($id)
    {
        Branch::find($id)->delete();

        return response()->json([
            'message' => 'delete branch success' 
        ], 200);
    }
}
