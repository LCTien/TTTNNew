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
        $rule = DB::table('roles')
        ->where('name','like','%'.$request->keyword.'%')
        ->limit(6)
        ->get();
        dd($rule,$request->keyword);
        if(count($rule)>0)
        {
            foreach($rule as $items)
            {
                
                $output .= ' <tr>
                <td>'.$items->name.'</td>
                <td>'. $items->tong .'</td>
                <td>'. $items->description .'</td>
                <td><a href="'.route('rule.update',['id' => $items->id]).'">Cập nhật</a></td>
              </tr>';
            }
            return response()->json($output);
        }
        else
        {
            $output = '<p>Không có vai trò này</p>';
        }
       
    }
}
