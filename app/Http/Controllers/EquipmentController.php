<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use App\Http\Requests\StoreEquipmentRequest;
use App\Http\Requests\UpdateEquipmentRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;
class EquipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page = 1;
        $itemSet = 0;
        if(isset($_GET['page']))
        {
            $page = $_GET['page'];
            $itemSet = 6 * ($page - 1); 
        }
            $eq = DB::table('equipments')->limit(6)->offset($itemSet)->get();
        
        $quantity_page = ceil(count($eq) / 6);
        return view('equipment',['page' => $page,'maxPage' => $quantity_page,'isEquipment' => true,'listEQuip' => $eq]);
    }
    public function search(Request $request){
        $output ='';
        if($request->action == "0" && $request->connect == "0"){
            $eq = DB::table('equipments')->where('name','LIKE','%'.$request->keyword.'%')->get();
        }
        else if($request->action == "0")
            $eq = DB::table('equipments')->where('name','LIKE','%'.$request->keyword.'%')->where('status_connect','=',$request->connect)->get();
        else if($request->connect == "0")
            $eq = DB::table('equipments')->where('name','LIKE','%'.$request->keyword.'%')->where('status_active','=',$request->action)->get();
        else 
            $eq = DB::table('equipments')
            ->where('name','LIKE','%'.$request->keyword.'%')
            ->where('status_active','=',$request->action)
            ->where('status_connect','=',$request->connect)->get(); 
        if(count($eq)>0){foreach($eq as $items)
            {
                
                $output .= '<tr>
                <td>'.$items->Code .'</td>
                <td>'.$items->name .'</td>
                <td>'.$items->IP .'</td>';
                if ($items->status_active == 1)
                {
                    $output .='<td ><i class="dot dot-jungle"></i><p>Hoạt động</p></td>';
                }
                
                else
                $output .='<td ><i class="dot dot-fire"></i><p>Ngưng hoạt động</p></td>';
                if ($items->status_connect == 1){
                    $output .=   '<td><i class="dot dot-jungle"></i><p>Kết nối</p></td>';
                }
                else
                $output .='<td><i class="dot dot-fire"></i><p>Mất kết nối</p></td>';
                $output .='<td id="see-more"><p class="overflow">'.$items->service_use .'</p>
                            <div class="see-more"><p>'.$items->service_use .'</p></div>
                        </td>
                            <td><a href="'. route('equipment.detail',['id' => $items->Code]) .'">Chi tiết</a></td>
                            <td><a href="'. route('equipment.update',['id' => $items->Code]) .'">Cập nhật</a></td>
                        </tr>';
                
            }}
            else
        {
            $output .= '<p>Không có thiết bị này</p>';
        }
        return response()->json($output);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $create = DB::insert('insert into equipments (Code, name,IP, service_use, login_name, password, equipment_type_id, created_at) values (?, ?, ?, ?, ?, ?, ?, ?)', [$request->code,$request->name,$request->ip_address,$request->service,$request->username,$request->password,$request->type,Carbon::now('Asia/Ho_Chi_Minh')]);
        return redirect()->route('equipment',['isEquipment' => true]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreEquipmentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEquipmentRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Equipment  $equipment
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $equipment = DB::table('equipments')
        ->join('equipment_types','equipment_types.id','=','equipments.equipment_type_id')
        ->select('equipments.*','equipment_types.name as type_name')
        ->where('Code','=',$id)
        ->get();
        return view('detail-equipment',['isEquipment' => true,'detail'=>$equipment]);
    }
    public function updating($id)
    {
        $equipment = DB::table('equipments')
        ->join('equipment_types','equipment_types.id','=','equipments.equipment_type_id')
        ->select('equipments.*','equipment_types.name as type_name','equipment_types.id as type_id')
        ->where('Code','=',$id)
        ->get();
        $listTypes = DB::table('equipment_types')->get();
        return view('update-equipment',['isEquipment' => true,'detail'=>$equipment,'listType'=>$listTypes]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Equipment  $equipment
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $equipment = DB::update('update equipments set Code = ?, name = ?, IP = ?, service_use = ?, login_name = ?, password = ?, equipment_type_id = ?, updated_at = ?  where Code = ?', [$request->code,$request->name,$request->ip_address,$request->service,$request->username,$request->password,$request->type,Carbon::now('Asia/Ho_Chi_Minh'),$request->oldCode]);
        return redirect()->route('equipment');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEquipmentRequest  $request
     * @param  \App\Models\Equipment  $equipment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEquipmentRequest $request, Equipment $equipment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Equipment  $equipment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Equipment $equipment)
    {
        //
    }
}
