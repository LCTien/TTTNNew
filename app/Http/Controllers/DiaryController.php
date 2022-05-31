<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DiaryController extends Controller
{
    public function index()
    {
        $page = 1;
        $itemSet = 0;
        $all = DB::table('diaries')->get();
        if(isset($_GET['page']))
        {
            $page = $_GET['page'];
            $itemSet = 6 * ($page - 1); 
        }
            $diary = DB::table('diaries')
            ->limit(6)
            ->get();
        $quantity_page = ceil(count($all) / 6);
        return view('diary-user',['items' => $diary,'page' => $page,'maxPage' => $quantity_page,'isInstall'=> true,'isDiary' => true]);
    }
    public function diarySearchTime(Request $request)
    {
        $output = '';
        $start = '';
        $end = '';
        $search = [];
        if($request->end == "dd/mm/yy")
        {
            $search = DB::table('diaries')
            ->where('time','>=',$request->start)
            ->limit(6)
            ->get();
        }
        else if ($request->end >= $request->start){
            $tach = explode('/',$request->end);
            $end .= $tach[2] ."-". $tach[1]."-".$tach[0];
            $tach = explode('/',$request->start);
            $start .= $tach[2] ."-".$tach[1] ."-". $tach[0];
            $search = DB::table('diaries')
            ->where('time','>=',$start)
            ->where('time','<=',$end)
            ->limit(6)
            ->get();
        }
        if(count($search)>0)
        {
            foreach($search as $item)
            {
                $output .= ' <tr>
                <td>'. $item->username.'</td>
                <td>'. $item->time.'</td>
                <td >'. $item->ip.'</td>
                <td>'. $item->des.'</td>
              </tr>  ';
        }
        }
        else
        {
            $output .= '<p>Không tìm thấy nhật ký trong khoảng thời gian này này</p>';
        }
        return response()->json($output);
    }
    public function search(Request $request)
    {
        $output = '';
        $search = DB::table('diaries')
            ->where('username','like','%'.$request->keyword.'%')
            ->limit(6)
            ->get();
        if(count($search)>0)
        {
            foreach($search as $item)
            {
                $output .= ' <tr>
                <td>'. $item->username.'</td>
                <td>'. $item->time.'</td>
                <td >'. $item->ip.'</td>
                <td>'. $item->des.'</td>
              </tr> ';
        }
        }
        else
        {
            $output .= '<p>Không tìm người này viết nhật ký</p>';
        }
        return response()->json($output);
    }
}
