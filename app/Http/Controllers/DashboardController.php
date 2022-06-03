<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Http\Requests\StoreAccountRequest;
use App\Http\Requests\UpdateAccountRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
class DashboardController extends Controller
{
    public function index()
    {
        $today = explode(' ',Carbon::today('Asia/Ho_Chi_Minh'))[0];
        $yesterday = explode(' ',Carbon::yesterday('Asia/Ho_Chi_Minh'))[0];
        $tomorow = explode(' ', Carbon::tomorrow('Asia/Ho_Chi_Minh'))[0];
        $all = DB::table('givenumbers')->get();
        $all_today = DB::table('givenumbers')->where('created_at','>=',$today)->where('created_at','<=',$tomorow)->count('id');
        $today_percent = 0;
        if(count($all) == 0)
        {
            $today_percent =  $all_today * 100;
        }
        else
        {
            $today_percent = ( $all_today / count($all)) * 100;
        }
        $today_status = 0;
        $used = DB::table('givenumbers')->where('status','=',1)->get();
        $used_today = DB::table('givenumbers')->where('status','=',1)->where('created_at','>=',$today)->where('created_at','<=',$tomorow)->count('id');
        $used_yesterday = DB::table('givenumbers')->where('status','=',1)->where('created_at','<=',$today)->where('created_at','>=',$yesterday)->count('id');
        $used_percent = 0;
        if($used_yesterday == 0)
        {
            $used_percent =  $used_today * 100;
        }
        else
        {
            $used_percent = ( $used_today / $used_yesterday) * 100;
        }
        $used_status = 0;
        if($used_today >= $used_yesterday)
            $used_status = 1;
        $waiting = DB::table('givenumbers')->where('status','=',0)->get();
        $waiting_today = DB::table('givenumbers')->where('status','=',0)->where('created_at','>=',$today)->where('created_at','<=',$tomorow)->count('id');
        $waiting_yesterday = DB::table('givenumbers')->where('status','=',0)->where('created_at','<=',$today)->where('created_at','>=',$yesterday)->count('id');
        $waiting_percent = 0;
        if($used_yesterday == 0)
        {
            $waiting_percent =  $waiting_today * 100;
        }
        else
        {
            $waiting_percent = ( $waiting_today / $waiting_yesterday) * 100;
        }
        $waiting_status = 0;
        if($waiting_today >= $waiting_yesterday)
            $waiting_status = 1;
        $passed = DB::table('givenumbers')->where('status','=',-1)->get();
        $passed_today = DB::table('givenumbers')->where('status','=',-1)->where('created_at','>=',$today)->where('created_at','<=',$tomorow)->count('id');
        $passed_yesterday = DB::table('givenumbers')->where('status','=',-1)->where('created_at','<=',$today)->where('created_at','>=','2022-06-02')->count('id');
        $passed_percent = 0;
        if($passed_yesterday == 0)
        {
            $passed_percent =  $passed_today * 100;
        }
        else
        {
            $passed_percent = ( $passed_today / $passed_yesterday) * 100;
        }
        $passed_status = 0;
        if($passed_today >= $passed_yesterday)
            $passed_status = 1;
        $equipment = DB::table('equipments')->get();
        $equipment_active = DB::table('equipments')->where('status_active','=',1)->get();
        $equipment_notactive = DB::table('equipments')->where('status_active','=',-1)->get();
        $service = DB::table('services')->get();
        $service_active = DB::table('services')->where('status_active','=',1)->get();
        $service_notactive = DB::table('services')->where('status_active','=',-1)->get();
        $data = [
            "serial" => count($all),
            "serial_today" => number_format($today_percent,2),
            "serial_used" => count($used),
            "serial_used_percent" =>  number_format($used_percent,2),
            "serial_used_percent_status" => $used_status,
            "serial_waiting" => count($waiting),
            "serial_waiting_percent" =>  number_format($waiting_percent,2),
            "serial_waiting_percent_status" => $waiting_status,
            "serial_passed" => count($passed),
            "serial_passed_percent" => number_format($passed_percent,2),
            "serial_passed_percent_status" => $passed_status,
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