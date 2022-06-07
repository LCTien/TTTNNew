@extends('layout.layout')
@extends('layout.navbar')
@section('content')
<div class="main-title">Cài đặt hệ thống > <span class="orange strong">  Quản lý tài khoản</span></div>
<p class="component-title strong">Danh sách tài khoản</p>
<div  class="container-control"><a href="{{ route('account.add') }}" class="add-button">
    <i class="material-icons">add_box</i>
    <p>Thêm tài khoản</p>
</a>
</div>
<div class="container">
    <div class="dropdown-container-main">
        <div class="dropdown-container">
            <p>Tên vai trò</p>
            <div class="dropdown-box" id="dropAction">
                <p>Tất cả</p>
                <i class="material-icons">arrow_drop_down</i>
            </div>
            <div class="box" id="dropAction-box">
                <ul>
                    <li  class="box-items box-active">Tất cả</li>
                    @foreach ($roles as  $item)
                    <li  class="box-items ">{{ $item->name }}</li>
                    @endforeach
                   
                    
                </ul>
            </div>
        </div>
    </div>
    <div class="dropdown-container-search">
        <div class="dropdown-container">
            <p>Từ khóa</p>
            <div class="dropdown-box">
                <input type="text" placeholder="Nhập từ khóa" name="search" id="keyword">
                <i class="fas fa-search"></i>
            </div>
        </div>
    </div>
    <div class="table">
        <table>
            <thead>
               <tr>
                   <th class="bd-radius-topleft10">Tên đăng nhập</th>
                   <th>Họ tên</th>
                   <th>Số điện thoại</th>
                   <th>Email</th>
                   <th>Vai trò</th>
                   <th>Trạng thái hoạt động</th>
                   <th class="bd-radius-topright10">&emsp;</th>
               </tr>
            </thead>
            <tbody id="listAccounts">
                @foreach ($accounts as $item)
                <tr>
                    <td>{{ $item->username }}</td>
                    <td>{{ $item->fullname }}</td>
                    <td>{{ $item->phonenumber }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->role_name }}</td>
                    @if ($item->status == 1)
                    <td ><i class="dot dot-jungle"></i><p>Đang hoạt động</p></td>
                    @elseif ($item->status == -1)
                    <td ><i class="dot dot-fire"></i><p>Ngưng hoạt động</p></td>
                    @endif
                    <td><a href="{{ route('account.update',['id' => $item->id ]) }}">Cập nhật</a></td>
                  </tr> 
                @endforeach
            </tbody>
        </table>
    </div>
    @if ($maxPage > 1)
    <div class="page-control" id="list-page">
        @if($page != 1)
        <a href="{{ route('account',['page' => $page - 1]) }}"><i class="material-icons">keyboard_arrow_left</i></a>
        @endif
        @if($page >= 4)
        ...
        @endif
        @for ($i = 1; $i <= $maxPage; $i++)

        @if($i == $page)
         <a href="{{ route('account',['page' => $i]) }}" class="page page-active">{{ $i }}</a>
        @elseif ($page - $i <= 2 && $i - $page <= 2)
         <a href="{{ route('account',['page' => $i]) }}" class="page">{{ $i }}</a>
        @endif
       
        @endfor
        @if($page < $maxPage - 2)
        ...
        @endif
        @if($page != $maxPage)
        <a href="{{ route('account',['page' => $page + 1]) }}"><i class="material-icons">keyboard_arrow_right</i></a>
        @endif
    </div>
    @endif
</div>
</div>
<script>
    $(document).ready(function(){
     let flag =0;
     $("#dropAction").click(function(){
         $("#dropAction-box").toggleClass("block");
         $('#dropAction i').text('arrow_drop_up');
         flag++;
         if(flag == 2)
         {
             flag = 0;
             $('#dropAction i').text('arrow_drop_down');
         }
     });
     $("#dropAction-box li").click(function(){
            $("#dropAction-box .box-active").removeClass("box-active");
            $(this).toggleClass("box-active");
            $("#dropAction-box").removeClass("block");
            $("#dropAction p").text($(this).text());
            $('#dropAction i').text('arrow_drop_down');
            flag1 =0;
            let role =  $("#dropAction p").text();
            var keyword = $("#keyword").val();
             $.ajax({
                 type: "get",
                 url: "/account/search",
                 data:{
                     keyword: keyword,
                     role: role
                 },
                 dataType: "json",
                 success: function(response){
                    $("#listAccounts").html(response);
                 }
             })
        });
        $(document).on('keyup','#keyword',function(){
            var keyword = $(this).val();
            let role =  $("#dropAction p").text();
             $.ajax({
                 type: "get",
                 url: "/admin/account/search",
                 data:{
                    keyword: keyword,
                     role: role
                 },
                 dataType: "json",
                 success: function(response){
                    $("#listAccounts").html(response);
                 }
             })
        });
 });
 </script>
@endsection
