<?php

namespace App\Http\Controllers;

use App\Models\Givenumber;
use App\Http\Requests\StoreGivenumberRequest;
use App\Http\Requests\UpdateGivenumberRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use PDF;

class GivenumberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $today = Carbon::now('Asia/Ho_Chi_Minh');
        DB::update('update givenumbers set status = -1 where limit_time < ? and status != 1 ', [$today]);
        $fullserial = DB::table('givenumbers')
        ->join('services','services.Code','=','service_id')
        ->join('equipments','equipments.Code','=','equipment_id')
        ->select('givenumbers.*','services.name as service_name','equipments.name as equipment_name')
        ->get();
        $service = DB::table('services')->get();
        $equip = DB:: table('equipments')->get();
        $page = 1;
        $itemSet = 0;
        if(isset($_GET['page']))
        {
            $page = $_GET['page'];
            $itemSet = 6 * ($page - 1); 
        }
        $serial = DB::table('givenumbers')
        ->join('services','services.Code','=','service_id')
        ->join('equipments','equipments.Code','=','equipment_id')
        ->select('givenumbers.*','services.name as service_name','equipments.name as equipment_name')
        ->limit(6)
        ->offset($itemSet)
        ->get();
        $quantity_page = ceil(count($fullserial) / 6);
        return view('givenumber',['page' => $page,'maxPage' => $quantity_page,'isGivenumber'=> true,'serial'=> $serial,'services'=> $service,'equip'=>$equip]);
        
    }
    public function search(Request $request)
    {
        $output ='';
        $service_name = '';
        $equipments_name = '';
        if($request->service_name != "Tất cả")
            $service_name = $request->service_name;
        if($request->equipment_name != "Tất cả")
            $equipments_name = $request->equipment_name;
        $serial = [];
        if($request->status == "Đang chờ")
        {
            if($request->service_name != "Tất cả")
            {
                $serial = DB::table('givenumbers')
                ->join('services','services.Code','=','service_id')
                ->join('equipments','equipments.Code','=','equipment_id')
                ->select('givenumbers.*','services.name as service_name','equipments.name as equipment_name')
                ->where('services.name','=',$service_name)
                ->where('givenumbers.serial','like','%'.$request->search.'%')
                ->where('givenumbers.status','=',0)
                ->limit(6)
                ->get();
            }
            else if($request->equipment_name != "Tất cả")
            {
                $serial = DB::table('givenumbers')
                ->join('services','services.Code','=','service_id')
                ->join('equipments','equipments.Code','=','equipment_id')
                ->select('givenumbers.*','services.name as service_name','equipments.name as equipment_name')
                ->where('equipments.name','=',$equipments_name)
                ->where('givenumbers.serial','like','%'.$request->search.'%')
                ->where('givenumbers.status','=',0)
                ->limit(6)
                ->get();
            }
            else
            {
                $serial = DB::table('givenumbers')
                ->join('services','services.Code','=','service_id')
                ->join('equipments','equipments.Code','=','equipment_id')
                ->select('givenumbers.*','services.name as service_name','equipments.name as equipment_name')
                ->where('givenumbers.serial','like','%'.$request->search.'%')
                ->where('givenumbers.status','=',0)
                ->limit(6)
                ->get();
            }
        }
        else if($request->status == "Đã sử dụng")
        {
            if($request->service_name != "Tất cả")
            {
                $serial = DB::table('givenumbers')
                ->join('services','services.Code','=','service_id')
                ->join('equipments','equipments.Code','=','equipment_id')
                ->select('givenumbers.*','services.name as service_name','equipments.name as equipment_name')
                ->where('services.name','=',$service_name)
                ->where('givenumbers.serial','like','%'.$request->search.'%')
                ->where('givenumbers.status','=',1)
                ->limit(6)
                ->get();
            }
            else if($request->equipment_name != "Tất cả")
            {
                $serial = DB::table('givenumbers')
                ->join('services','services.Code','=','service_id')
                ->join('equipments','equipments.Code','=','equipment_id')
                ->select('givenumbers.*','services.name as service_name','equipments.name as equipment_name')
                ->where('equipments.name','=',$equipments_name)
                ->where('givenumbers.serial','like','%'.$request->search.'%')
                ->where('givenumbers.status','=',1)
                ->limit(6)
                ->get();
            }
            else
            {
                $serial = DB::table('givenumbers')
                ->join('services','services.Code','=','service_id')
                ->join('equipments','equipments.Code','=','equipment_id')
                ->select('givenumbers.*','services.name as service_name','equipments.name as equipment_name')
                ->where('givenumbers.serial','like','%'.$request->search.'%')
                ->where('givenumbers.status','=',1)
                ->limit(6)
                ->get();
            }
        }
        else if($request->status == "Đã bỏ qua")
        {
            if($request->service_name != "Tất cả")
            {
                $serial = DB::table('givenumbers')
                ->join('services','services.Code','=','service_id')
                ->join('equipments','equipments.Code','=','equipment_id')
                ->select('givenumbers.*','services.name as service_name','equipments.name as equipment_name')
                ->where('services.name','=',$service_name)
                ->where('givenumbers.serial','like','%'.$request->search.'%')
                ->where('givenumbers.status','=',-1)
                ->limit(6)
                ->get();
            }
            else if($request->equipment_name != "Tất cả")
            {
                $serial = DB::table('givenumbers')
                ->join('services','services.Code','=','service_id')
                ->join('equipments','equipments.Code','=','equipment_id')
                ->select('givenumbers.*','services.name as service_name','equipments.name as equipment_name')
                ->where('equipments.name','=',$equipments_name)
                ->where('givenumbers.serial','like','%'.$request->search.'%')
                ->where('givenumbers.status','=',-1)
                ->limit(6)
                ->get();
            }
            else
            {
                $serial = DB::table('givenumbers')
                ->join('services','services.Code','=','service_id')
                ->join('equipments','equipments.Code','=','equipment_id')
                ->select('givenumbers.*','services.name as service_name','equipments.name as equipment_name')
                ->where('givenumbers.serial','like','%'.$request->search.'%')
                ->where('givenumbers.status','=',-1)
                ->limit(6)
                ->get();
            }
            
        }
        else
        {
            if($request->service_name != "Tất cả")
            {
                $serial = DB::table('givenumbers')
                ->join('services','services.Code','=','service_id')
                ->join('equipments','equipments.Code','=','equipment_id')
                ->select('givenumbers.*','services.name as service_name','equipments.name as equipment_name')
                ->where('services.name','=',$service_name)
                ->where('givenumbers.serial','like','%'.$request->search.'%')
                ->limit(6)
                ->get();
            }
            else if($request->equipment_name != "Tất cả")
            {
                $serial = DB::table('givenumbers')
                ->join('services','services.Code','=','service_id')
                ->join('equipments','equipments.Code','=','equipment_id')
                ->select('givenumbers.*','services.name as service_name','equipments.name as equipment_name')
                ->where('equipments.name','=',$equipments_name)
                ->where('givenumbers.serial','like','%'.$request->search.'%')
                ->limit(6)
                ->get();
            }
            else
            {
                $serial = DB::table('givenumbers')
                ->join('services','services.Code','=','service_id')
                ->join('equipments','equipments.Code','=','equipment_id')
                ->select('givenumbers.*','services.name as service_name','equipments.name as equipment_name')
                ->where('givenumbers.serial','like','%'.$request->search.'%')
                ->limit(6)
                ->get();
            }
        }
        if(count($serial) > 0)
        {
            foreach ($serial as $item)
        {
            $output .= '
            <tr>
              <td>'.$item->serial.'</td>
              <td>'.$item->name.'</td>
              <td>'.$item->service_name.'</td>
              <td >'.$item->created_at.'</td>
              <td>'.$item->limit_time.'</td>
              ';if($item->status == -1)
              $output .= '
              <td ><i class="dot dot-fire"></i><p>Đã bỏ qua</p></td>
              ';elseif ($item->status == 0) $output .='
              <td ><i class="dot dot-water"></i><p>Đang chờ</p></td>
              ';elseif ($item->status == 1) 
              $output .= '
              <td ><i class="dot dot-jungle"></i><p>Đã sử dụng</p></td>';
              $output .= '
              <td>'.$item->equipment_name.'</td>
              <td><a href="'.route('givenumber.detail',['stt' => $item->serial]).'">Chi tiết</a></td>
            </tr>';
        }
        }
        else
        {
            $output .= '<p>Không tìm thấy số thứ tự này</p>';
        }
        return response()->json($output);
    }
    public function searchTime(Request $request)
    {
        $output = '';
        $start = '';
        $end = '';
        $search = [];
        if($request->end == "dd/mm/yy")
        {
            $search = DB::table('givenumbers')
            ->join('services','services.Code','=','service_id')
            ->join('equipments','equipments.Code','=','equipment_id')
            ->select('givenumbers.*','services.name as service_name','equipments.name as equipment_name')
            ->where('givenumbers.created_at','>=',$start)
            ->limit(6)
            ->get();
        }
        else if ($request->end >= $request->start){
            $tach = explode('/',$request->end);
            $end .= $tach[2] ."-". $tach[1]."-".$tach[0];
            $tach = explode('/',$request->start);
            $start .= $tach[2] ."-".$tach[1] ."-". $tach[0];
            $search = DB::table('givenumbers')
            ->join('services','services.Code','=','service_id')
            ->join('equipments','equipments.Code','=','equipment_id')
            ->select('givenumbers.*','services.name as service_name','equipments.name as equipment_name')
            ->where('givenumbers.created_at','>=',$start)
            ->where('givenumbers.created_at','<=',$end)
            ->limit(6)
            ->get();
        }
        if(count($search)>0)
        {
            foreach($search as $item)
            {
                $output .= '
            <tr>
              <td>'.$item->serial.'</td>
              <td>'.$item->name.'</td>
              <td>'.$item->service_name.'</td>
              <td >'.$item->created_at.'</td>
              <td>'.$item->limit_time.'</td>
              ';if($item->status == -1)
              $output .= '
              <td ><i class="dot dot-fire"></i><p>Đã bỏ qua</p></td>
              ';elseif ($item->status == 0) $output .='
              <td ><i class="dot dot-water"></i><p>Đang chờ</p></td>
              ';elseif ($item->status == 1) 
              $output .= '
              <td ><i class="dot dot-jungle"></i><p>Đã sử dụng</p></td>';
              $output .= '
              <td>'.$item->equipment_name.'</td>
              <td><a href="'.route('givenumber.detail',['stt' => $item->serial]).'">Chi tiết</a></td>
            </tr>';
        }
        }
        else
        {
            $output .= '<p>Không tìm thấy số thứ tự trong khoảng thời gian này này</p>';
        }
        return response()->json($output);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function creating()
    {
        $service = DB::table('services')->get();
        return view('add-givenumber',['service' => $service,'isGivenumber'=> true]);
        
    }
    public function create(Request $request)
    {
        $equipment = DB::select('select equipments.Code as code from equipments where equipments.service_use like "%'.$request->service.'%" and not EXISTS (select equipment_id from givenumbers WHERE equipments.Code = givenumbers.equipment_id )');
        if(count($equipment)==0)
        {
            $equipment = DB::table('equipments')
            ->select([
                DB::raw('Count(*) as tong'),
                DB::raw('Code as code')
            ])
            ->join('givenumbers','givenumbers.equipment_id','=','equipments.Code')
            ->where('equipments.service_use','like','%'.$request->service.'%')
            ->groupBy('Code','equipments.name')
            ->orderBy('tong')
            ->get();
        }
        $service = DB::table('services')->where('name','=',$request->service)->get();
        $STT = $service[0]->Code;
        $quant = DB::table('givenumbers')
        ->join('services','services.Code','=','service_id')
        ->where('services.name','=',$request->service)
        ->count('service_id');
        if($service[0]->auto_incre != "")
        {
            $STT .= explode('-',$service[0]->auto_incre)[0] + $quant;
        }
        if($service[0]->prefix != "")
        {
            $STT = $service[0]->prefix . $STT;
        }
        if($service[0]->surfix != "")
        {
            $STT .= $service[0]->surfix;
        }
        $time = Carbon::now('Asia/Ho_Chi_Minh');
        $limit_time =Carbon::now('Asia/Ho_Chi_Minh')->addHours(5);
        $insert =  DB::insert('insert into givenumbers (serial,name,phonenumber,email,service_id,equipment_id,limit_time,created_at,status) values (?, ?, ?, ?, ?, ?, ?, ?, ?)', [$STT,$request->name,$request->phonenumber,$request->email,$service[0]->Code,$equipment[0]->code,$limit_time,$time,1]);
        $output = ' <div class="modal-give-content">
                    <span class="close">x</span>
                    <div class="modal-give-content-child1">
                        <div class="modal-give-content-child1-title">Số thứ tự được cấp</div>
                        <div class="modal-give-content-child1-STT"> '.$STT.'</div>
                        <div class="modal-give-content-child1-service">DV:'.$request->service.'</div>
                    </div>
                    <div class="times">
                        <p>Thời gian cấp: '.$time.'</p>
                        <p>Hạn sử dụng: '.$limit_time.'</p>
                    </div>
                    </div>';

        return response()->json($output);
    }
    public function detail($stt)
    {
        $serial = DB::table('givenumbers')
        ->join('services','services.Code','=','service_id')
        ->join('equipments','equipments.Code','=','equipment_id')
        ->select('givenumbers.*','services.name as service_name','equipments.name as equipment_name')
        ->where('serial','=',$stt)
        ->get();
        PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);
        return view('detail-givenumber',['serial'=>$serial]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreGivenumberRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function userGetNumber()
    {
        $service = DB::table('services')->get();
        return view('getnumber',['service' => $service,'isGivenumber'=> true]);
        
    }
    public function report()
    {
        $page = 1;
        $itemSet = 0;
        if(isset($_GET['page']))
        {
            $page = $_GET['page'];
            $itemSet = 6 * ($page - 1); 
        }
        $allSTT = DB::table('givenumbers')
        ->join('services','services.Code','=','service_id')
        ->join('equipments','equipments.Code','=','equipment_id')
        ->select('givenumbers.*','services.name as service_name','equipments.name as equipment_name')
        ->get();
        $stt = DB::table('givenumbers')
        ->join('services','services.Code','=','service_id')
        ->join('equipments','equipments.Code','=','equipment_id')
        ->select('givenumbers.*','services.name as service_name','equipments.name as equipment_name')
        ->limit(6)
        ->offset($itemSet)
        ->get();
        $quantity_page = ceil(count($allSTT) / 6);
        return view('report',['page' => $page,'maxPage' => $quantity_page,'isReport'=> true,'stt' => $stt]);
    }
    public function download()
    {
        $stt = DB::table('givenumbers')
        ->join('services','services.Code','=','service_id')
        ->join('equipments','equipments.Code','=','equipment_id')
        ->select('givenumbers.*','services.name as service_name','equipments.name as equipment_name')
        ->get();
        $pdf = PDF::loadView('report2',['stt' => $stt]);
        return $pdf->download('download.pdf');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Givenumber  $givenumber
     * @return \Illuminate\Http\Response
     */
    public function show(Givenumber $givenumber)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Givenumber  $givenumber
     * @return \Illuminate\Http\Response
     */
    public function edit(Givenumber $givenumber)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateGivenumberRequest  $request
     * @param  \App\Models\Givenumber  $givenumber
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGivenumberRequest $request, Givenumber $givenumber)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Givenumber  $givenumber
     * @return \Illuminate\Http\Response
     */
    public function destroy(Givenumber $givenumber)
    {
        //
    }
}
