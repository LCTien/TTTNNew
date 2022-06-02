<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Http\Requests\StoreAccountRequest;
use App\Http\Requests\UpdateAccountRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
       $user = DB::table('accounts')
       ->join('roles','roles.id','=','accounts.role_id')
       ->where('accounts.id','=',$id)
       ->select('accounts.*','roles.name')
       ->get();
       return view('admin-info',['user' => $user[0]]);
    }
    public function login(Request $request)
    {
        $user = DB::table('accounts')
        ->where('username','=',$request->post('account'))

        ->get();
        if(count($user) == 0 || $request->post('password') != $user[0]->password )
    {
         return redirect()->route('login',['error' => "Sai tài khoản hoặc mật khẩu"]);
    }
    Session::put('UserId',$user[0]->id);
    Session::put('Avatar',$user[0]->avatar);
    return redirect()->route('admin.info',['id' => $user[0]->id]);  
    }
    public function uploadImg()
    {
        if (!isset($_FILES['myfile']))
        {
            dd($_FILES['myfile']);
        }
      
    }
    public function logout(Request $request)
    {

    Session::forget('UserId');
    Session::forget('Avatar');
    return redirect()->route('login');
    }
    public function forgetpassword(Request $request)
    {
        $email = $request->email;
        $account = DB::table('accounts')->where('email','=',$email)->get();
        if(count($account)>0){
            return view('forgetpassword-confirm',['email'=>$email]);
        }
        else
            return view('forgetpassword',['error'=>"Không tồn tại email này!"]);
    }
    public function changePassword(Request $request){
        $email = $request->email;
        $password = $request->password;
        $confirmpassword = $request->confirmpassword;
        if($password != $confirmpassword)
        {
            return view('forgetpassword-confirm',['email'=>$email,'error'=>"Mật khẩu nhập lại không đúng!"]);
        }
        else
        {
            DB::update('update accounts set password = ? where email = ?', [$password,$email]);
            return view('login',['OK'=>"true"]);
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function management()
    {
        $page = 1;
        $itemSet = 0;
        if(isset($_GET['page']))
        {
            $page = $_GET['page'];
            $itemSet = 6 * ($page - 1); 
        }
        $allAccount = DB::table('accounts')
        ->select('accounts.*','roles.name as role_name')
        ->join('roles','roles.id','=','role_id')
        ->get();
        $accounts = DB::table('accounts')
        ->select('accounts.*','roles.name as role_name')
        ->join('roles','roles.id','=','role_id')
        ->limit(6)
        ->offset($itemSet)
        ->get();
        $roles = DB::table('roles')->get();
        $quantity_page = ceil(count($allAccount) / 6);
        return view('account',['page' => $page,'maxPage' => $quantity_page,'isInstall'=> true,'isAccount' => true,'accounts'=>$accounts,'roles' => $roles]);
    }
    public function creating()
    {
        $roles = DB::table('roles')->get();
        return view('add-account',['isInstall'=> true,'isAccount' => true,'roles'=>$roles]);
    }
    public function create(Request $request)
    {
        $roles = DB::table('roles')->get();
        if($request->fullname == "")
        {
            $errFullname = true;
            return view('add-account',['isInstall'=> true,'isAccount' => true,'roles'=>$roles,'errFullname' => $errFullname]);
        }
        if($request->username == "")
        {
            $errUsername = true;
            return view('add-account',['isInstall'=> true,'isAccount' => true,'roles'=>$roles,'errUsername' => $errUsername]);
        }
        if($request->password == "" || $request->password != $request->confirm_password)
        {
            $errPassword = true;
            return view('add-account',['isInstall'=> true,'isAccount' => true,'roles'=>$roles,'errPassword' => $errPassword]);
        }
        if($request->email == "")
        {
            $errEmail = true;
            return view('add-account',['isInstall'=> true,'isAccount' => true,'roles'=>$roles,'errEmail' => $errEmail]);
        }
        if($request->phonenumber == "")
        {
            $errPhonenumber = true;
            return view('add-account',['isInstall'=> true,'isAccount' => true,'roles'=>$roles,'errPhonenumber' => $errPhonenumber]);
        }
        DB::insert('insert into accounts (fullname, username, phonenumber, email, role_id, password, status, created_at) values (?, ?, ?, ?, ?, ?, ?, ?)', [$request->fullname,$request->username,$request->phonenumber,$request->email,$request->rule,$request->password,$request->status,Carbon::now('Asia/Ho_Chi_Minh')]);
        $user = DB::table('accounts')->where('id','=',Session::get('UserId'))->get();
        DB::insert('insert into diaries (username, time,  des) values (?, ?, ?)',
        [$user[0]->username, Carbon::now("Asia/Ho_Chi_Minh"),"Thêm tài khoản ".$request->username]);
        return redirect()->route('account');
    }
    public function updating($id)
    { 
        $roles = DB::table('roles')->get();
        $account = DB::table('accounts')
        ->select('accounts.*','roles.name as role_name')
        ->join('roles','roles.id','=','role_id')
        ->where('accounts.id','=',$id)
        ->get();
        return view('update-account',['isInstall'=> true,'isAccount' => true,'roles'=>$roles,'account' => $account]);
    }
    public function edit(Request $request)
    { 
        $roles = DB::table('roles')->get();
        if($request->fullname == "")
        {
            $errFullname = true;
            return redirect()->route('account.update',['id' => $request->id,'errFullname' => $errFullname]);
        }
        if($request->username == "")
        {
            $errUsername = true;
            return redirect()->route('account.update',['id' => $request->id,'errUsername' => $errUsername]);
        }
        if($request->password == "" || $request->password != $request->confirm_password)
        {
            $errPassword = true;
            return redirect()->route('account.update',['id' => $request->id,'errPassword' => $errPassword]);
        }
        if($request->email == "")
        {
            $errEmail = true;
            return redirect()->route('account.update',['id' => $request->id,'errEmail' => $errEmail]);
        }
        if($request->phonenumber == "")
        {
            $errPhonenumber = true;
            return redirect()->route('account.update',['id' => $request->id,'errPhonenumber' => $errPhonenumber]);
        }
        DB::update('update accounts set fullname = ?, username = ?, phonenumber = ?, email = ?, role_id = ?, password = ?, status = ?, updated_at = ? where id = ?', 
        [$request->fullname,$request->username,$request->phonenumber,$request->email,$request->rule,$request->password,$request->status,Carbon::now('Asia/Ho_Chi_Minh'),$request->id]);
        $user = DB::table('accounts')->where('id','=',Session::get('UserId'))->get();
        DB::insert('insert into diaries (username, time,  des) values (?, ?, ?)',
        [$user[0]->username, Carbon::now("Asia/Ho_Chi_Minh"),"Cập nhật thông tin tài khoản ".$request->username]);
        return redirect()->route('account');
    }
    public function search(Request $request)
    {
        $output = '';
        if($request->role != "Tất cả")
        {
            $account = DB::table('accounts')
            ->select('accounts.*','roles.name as role_name')
            ->join('roles','roles.id','=','role_id')
            ->where('accounts.fullname','like','%'.$request->keyword.'%')
            ->where('roles.name','=',$request->role)
            ->limit(6)
            ->get();
        }
        else
        {
            $account = DB::table('accounts')
            ->select('accounts.*','roles.name as role_name')
            ->join('roles','roles.id','=','role_id')
            ->where('accounts.fullname','like','%'.$request->keyword.'%')
            ->limit(6)
            ->get();
        }

        if(count($account) > 0)
        {
            foreach($account as $item)
            {
                $output .= '<tr>
                <td>'.$item->username.'</td>
                <td>'.$item->fullname.'</td>
                <td>'.$item->phonenumber.'</td>
                <td>'.$item->email.'</td>
                <td>'.$item->role_name.'</td>';
                if($item->status == 1)
                {
                    $output .= '<td ><i class="dot dot-jungle"></i><p>Đang hoạt động</p></td>';
                }
                if($item->status == -1)
                {
                    $output .= '<td ><i class="dot dot-fire"></i><p>Ngưng hoạt động</p></td>';
                }
                $output .= '<td><a href="'.route('account.update',['id' => $item->id ]).'">Cập nhật</a></td>
                </tr>';
            }
        }
        else{
            $output .= '<p>Không tồn tại tài khoản này</p>';
        }
        return response()->json($output);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAccountRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function uploadImage(Request $request)
    {
            if(!$request->hasFile('file'))
            {
                return 'Hãy chọn file để upload';
            }
            else
            {
                $img = $request->file('file');
                $imgPath = $img->move('assets/img', $img->getClientOriginalName());
                DB::update('update accounts set avatar = ? where id = ?', [$img->getClientOriginalName(),Session::get('UserId')]);
                Session::put('Avatar',$img->getClientOriginalName());
                $user = DB::table('accounts')->where('id','=',Session::get('UserId'))->get();
                DB::insert('insert into diaries (username, time,  des) values (?, ?, ?)',
                [$user[0]->username, Carbon::now("Asia/Ho_Chi_Minh"),"Cập nhật hình ảnh đại diện"]);
                return redirect()->route('admin.info',['id' => Session::get('UserId')]);
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function show(Account $account)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAccountRequest  $request
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function destroy(Account $account)
    {
        //
    }
}
