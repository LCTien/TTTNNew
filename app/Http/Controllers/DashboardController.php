<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Http\Requests\StoreAccountRequest;
use App\Http\Requests\UpdateAccountRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
class DashboardController extends Controller
{
    public function index()
    {
        $all = DB::table('givenumbers')->get();
        $used = DB::table('givenumbers')->where('status','=',1)->get();
        $waiting = DB::table('givenumbers')->where('status','=',0)->get();
        $passed = DB::table('givenumbers')->where('status','=',-1)->get();
        $equipment = DB::table('equipments')->get();
        $equipment_active = DB::table('equipments')->where('status_active','=',1)->get();
        $equipment_notactive = DB::table('equipments')->where('status_active','=',-1)->get();
        $service = DB::table('services')->get();
        $service_active = DB::table('services')->where('status_active','=',1)->get();
        $service_notactive = DB::table('services')->where('status_active','=',-1)->get();
        $data = [
            "serial" => count($all),
            "serial_used" => count($used),
            "serial_waiting" => count($waiting),
            "serial_passed" => count($passed),
            "equipment" => count($equipment),
            "equipment_active" => count($equipment_active),
            "equipment_notactive" => count($equipment_notactive),
            "service" => count($service),
            "service_active" => count($service_active),
            "service_notactive" => count($service_notactive),
        ];
        return view('dashboard',['isDashboard' => true,'data' => $data]);
    }
    public function select(Request $request){
        $give = [];
        if($request->time == "Ngày")
        {
            $give = DB::table('givenumbers')
            ->select([
                DB::raw('count(id) tong'),
                DB::raw('day(created_at) day')
            ])
            ->groupBy('day')
            ->get();
        }
        else if($request->time == "Tháng")
        {
            $give = DB::table('givenumbers')
            ->select([
                DB::raw('count(id) tong'),
                DB::raw('Month(created_at) day')
            ])
            ->groupBy('day')
            ->get();
        }
        else if($request->time == "Năm")
        {
            $give = DB::table('givenumbers')
            ->select([
                DB::raw('count(id) tong'),
                DB::raw('Year(created_at) day')
            ])
            ->groupBy('day')
            ->get();
        }
        return response()->json($give);
    }
}