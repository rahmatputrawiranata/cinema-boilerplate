<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Validator;
use App\Models\Movie;
use Carbon\Carbon;
use App\Models\Schedule;
class ScheduleController extends Controller
{

    public function userFilter(Request $request)
    {

        $branch_id = $request->branch_id;
        $date = $request->date;
        if($request->has('date')){
            if($request->has('branch_id'))
            {
                $data = Schedule::wherehas('studio', function($query) use ($request) {
                    return $query->where('branch_id', $request->branch_id);
                })->whereDate('start_date_time', $date)->get();
            }
            $data = Schedule::whereDate('start_date_time', $date)->get();
        }else{
            $data = Schedule::whereDate('start_date_time', '>=', date('Y-m-h'))->get();
        }
        $res =[];
        foreach($data as $r)
        {
            $date = Carbon::parse($r->start_date_time)->format('l');
            $date = strtolower($date);
            if($date == 'friday')
            {
                $price = $r->studio->basic_price + $r->studio->additional_friday_price;
            }else if($date == 'saturday')
            {
                $price = $r->studio->basic_price + $r->studio->additional_saturday_price;
            }else if($date == 'sunday'){
                $price = $r->studio->basic_price + $r->studio->additional_sunday_price;
            }else{
                $price = $r->studio->basic_price;
            }
            $res[] = array(
                'id' => $r->id,
                'movie_name' => $r->movie->name,
                'studio_name' => $r->studio->name,
                'date' => $date,
                'branch_name' => $r->studio->branch->name,
                'start_time' => $r->start_date_time,
                'end_time' => $r->end_date_time,
                'price' => $price
            );
        }
        return response()->json([
            'data' => $res
        ], 200);
    }
    public function index()
    {
        $data = Schedule::get();
        $res =[];
        foreach($data as $r)
        {
            $date = Carbon::parse($r->start_date_time)->format('l');
            $date = strtolower($date);
            if($date == 'friday')
            {
                $price = $r->studio->basic_price + $r->studio->additional_friday_price;
            }else if($date == 'saturday')
            {
                $price = $r->studio->basic_price + $r->studio->additional_saturday_price;
            }else if($date == 'sunday'){
                $price = $r->studio->basic_price + $r->studio->additional_sunday_price;
            }else{
                $price = $r->studio->basic_price;
            }
            $res[] = array(
                'id' => $r->id,
                'movie_name' => $r->movie->name,
                'studio_name' => $r->studio->name,
                'date' => $date,
                'branch_name' => $r->studio->branch->name,
                'start_time' => $r->start_date_time,
                'end_time' => $r->end_date_time,
                'price' => $price
            );
        }
        return response()->json([
            'data' => $res
        ], 200);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'studio_id' => 'required|exists:studios,id',
            'movie_id' => 'required|exists:movies,id',
            'start' => 'required|date',
        ]);

        if($validator->fails())
        {
            return response()->json([
                'message' => 'invalid field'
            ], 422);
        }

        $movies = Movie::get();
        $moviesf = Movie::find($request->movie_id);
        $endtime = date('Y-m-d H:i:s', strtotime('+'.$moviesf->minute_length .'minutes' ,strtotime($request->input('start'))));
        //$endtime = date('Y-m-d H:i:s', strtotime('-'.$moviesf->minute_length .'minutes' ,strtotime($endtime)));

        //dd($movies->count());
        $check_schedule = Schedule::whereBetween('start_date_time',[$request->input('start'), $endtime])
                                    ->orWhereBetween('end_date_time',[$request->input('start') ,$endtime])->first();

        if($check_schedule)
        {
            return response()->json([
                'message' => 'schedule overlapped'
            ], 422);
        }

        $data = new Schedule;
        $data->studio_id = $request->input('studio_id');
        $data->movie_id = $request->input('movie_id');
        $data->start_date_time = $request->input('start');
        $data->end_date_time = $endtime;
        $data->save();

        return response()->json([
            'message' => 'create schedule success'
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'studio_id' => 'required|exists:studios,id',
            'movie_id' => 'required|exists:movies,id',
            'start' => 'required|date',
        ]);

        if($validator->fails())
        {
            return response()->json([
                'message' => 'invalid field'
            ], 422);
        }

        $movies = Movie::get();
        $moviesf = Movie::find($request->movie_id);
        $endtime = date('Y-m-d H:i:s', strtotime('+'.$moviesf->minute_length .'minutes' ,strtotime($request->input('start'))));
        $check_schedule = Schedule::whereBetween('start_date_time',[$request->input('start'), $endtime])
                                    ->orWhereBetween('end_date_time',[$request->input('start') ,$endtime])->first();

        if($check_schedule)
        {
            return response()->json([
                'message' => 'invalid field'
            ], 422);
        }

        $data = Schedule::find($id);
        $data->studio_id = $request->input('studio_id');
        $data->movie_id = $request->input('movie_id');
        $data->start = $request->input('start');
        $data->end_date_time = $endtime;
        $data->save();

        return response()->json([
            'message' => 'create schedule success'
        ], 200);
    }

    public function destroy($id)
    {
        Schedule::find($id)->delete();

        return response()->json([
            'message' => 'delete schedule success' 
        ], 200);
    }
}
