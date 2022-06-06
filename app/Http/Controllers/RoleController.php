<?php

namespace App\Http\Controllers;

use App\Models\role;
use App\Http\Requests\StoreroleRequest;
use App\Http\Requests\UpdateroleRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
class RoleController extends Controller
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
        $allRole = DB::select('select roles.id, roles.name,roles.description,COUNT(roles.id) as tong
        from roles ,accounts
        where accounts.role_id = roles.id 
        and  EXISTS (select role_id from accounts) 
        group by roles.id,roles.name,roles.description
        ');
        $roles = DB::select('select roles.id, roles.name,roles.description,COUNT(roles.id) as tong
        from roles ,accounts
        where accounts.role_id = roles.id 
        and  EXISTS (select role_id from accounts) 
        group by roles.id,roles.name,roles.description
        limit 6
        offset ?
        ',[$itemSet]);
        $quantity_page = ceil(count($allRole) / 6);
        return view('rule',['page' => $page,'maxPage' => $quantity_page,'listRoles' => $roles,'isInstall'=> true,'isRule' => true]);
    }
    public function updating($id)
    {
        $role = DB::table('roles')->where('id','=',$id)->get();
        return view('update-rule',['role'=> $role,'isInstall'=> true,'isRule' => true]);
    }
    public function update(Request $request)
    {
       if($request->name == "")
       {
        return redirect()->route('role.update',['id' => $request->id,'errName' => true]);
       }
       else
       {
           DB::update('update roles set name = ?, description = ?,powers = ?, updated_at = ? where id = ?', [$request->name,$request->description,$request->powers,Carbon::now("Asia/Ho_Chi_Minh"),$request->id]);
           $user = DB::table('accounts')->where('id','=',Session::get('UserId'))->get();
           DB::insert('insert into diaries (username, time,  des) values (?, ?, ?)',
         [$user[0]->username, Carbon::now("Asia/Ho_Chi_Minh"),"Cập nhật thông tin vai trò ".$request->name]);
           return redirect()->route('rule.management');
       }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function creating()
    {
        return view('add-rule',['isInstall'=> true,'isRule' => true]);
    }
    public function create(Request $request)
    {
        if($request->name == "")
        {
         return redirect()->route('role.add',['errName' => true]);
        }
        else
        {
            DB::insert('insert into roles (name, description, powers,created_at) values (?, ?, ?, ?)',
             [$request->name,$request->description,$request->powers,Carbon::now("Asia/Ho_Chi_Minh")]);
            $user = DB::table('accounts')->where('id','=',Session::get('UserId'))->get();
            DB::insert('insert into diaries (username, time,  des) values (?, ?, ?)',
            [$user[0]->username, Carbon::now("Asia/Ho_Chi_Minh"),"Thêm vai trò ".$request->name]);
            return redirect()->route('rule.management');
        }
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
}
