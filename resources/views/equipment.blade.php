@extends('layout.layout')
@extends('layout.navbar')
@section('content')
<div class="main-title">Thiết bị >   <span class="orange strong">  Danh sách thiết bị</span></div>
<p class="component-title strong">Quản lý thiết bị</p>
<div  class="container-control"><a href="{{ route('equipment.add') }}" class="add-button">
    <i class="material-icons">add_box</i>
    <p>Thêm thiết bị</p>
</a>
</div>
    
<div class="container">
    <input type="hidden" value="0" id="actionInput">
    <input type="hidden" value="0" id="connectInput">
    <div class="dropdown-container-main">
        <div class="dropdown-container">
            <p>Trạng thái hoạt động</p>
            <div class="dropdown-box" id="dropAction">
                <p>Tất cả</p>
                <i class="material-icons">arrow_drop_down</i>
            </div>
            <div class="box" id="dropAction-box">
                <ul>
                    <li  class="box-items box-active">Tất cả</li>
                    <li  class="box-items ">Đang hoạt động</li>
                    <li  class="box-items ">Ngưng hoạt động</li>

                </ul>
            </div>
        </div>
        <div class="dropdown-container margin-left15" >
            <p>Trạng thái kết nối</p>
            <div class="dropdown-box" id="dropConnect">
                <p>Tất cả</p>
                <i class="material-icons">arrow_drop_down</i>
            </div>
            <div class="box" id="dropConnect-box">
                <ul>
                    <li class="box-items box-active">Tất cả</li>
                    <li class="box-items ">Kết nối</li>
                    <li class="box-items ">Mất kết nối</li>
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
                   <th class="bd-radius-topleft10">Mã thiết bị</th>
                   <th>Tên thiết bị</th>
                   <th>Địa chỉ IP</th>
                   <th>Trạng thái hoạt động</th>
                   <th>Trạng thái kết nối</th>
                   <th>Dịch vụ sử dụng</th>
                   <th>&emsp;</th>
                   <th class="bd-radius-topright10">&emsp;</th>
               </tr>
            </thead>
            <tbody id="listEquip">
                @foreach ($listEQuip as $items)
               <tr>
                 <td>{{ $items->Code  }}</td>
                 <td>{{ $items->name }}</td>
                 <td>{{ $items->IP }}</td>
                 @if ($items->status_active == 1)
                 <td ><i class="dot dot-jungle"></i><p>Hoạt động</p></td>
                 @else
                 <td ><i class="dot dot-fire"></i><p>Ngưng hoạt động</p></td>
                 @endif
                 @if ($items->status_connect == 1)
                 <td><i class="dot dot-jungle"></i><p>Kết nối</p></td>
                 @else
                 <td><i class="dot dot-fire"></i><p>Mất kết nối</p></td>
                 @endif
                 
                 <td id="see-more"><p class="overflow">{{ $items->service_use }}</p>
                    <div class="see-more"><p>{{ $items->service_use }}</p></div>
                </td>
                 <td><a href="{{ route('equipment.detail',['id' => $items->Code]) }}">Chi tiết</a></td>
                 <td><a href="{{ route('equipment.update',['id' => $items->Code]) }}">Cập nhật</a></td>
               </tr>
               @endforeach
            </tbody>
        </table>
    </div>
    @if ($maxPage > 1)
    <div class="page-control" id="list-page">
        @if($page != 1)
        <a href="{{ route('equipment',['page' => $page - 1]) }}"><i class="material-icons">keyboard_arrow_left</i></a>
        @endif
        @if($page >= 4)
        ...
        @endif
        @for ($i = 1; $i <= $maxPage; $i++)

        @if($i == $page)
         <a href="{{ route('equipment',['page' => $i]) }}" class="page page-active">{{ $i }}</a>
        @elseif ($page - $i <= 2 && $i - $page <= 2)
         <a href="{{ route('equipment',['page' => $i]) }}" class="page">{{ $i }}</a>
        @endif
       
        @endfor
        @if($page < $maxPage - 2)
        ...
        @endif
        @if($page != $maxPage)
        <a href="{{ route('equipment',['page' => $page + 1]) }}"><i class="material-icons">keyboard_arrow_right</i></a>
        @endif
    </div>
    @endif
</div>
</div>
<script>
    $(document).ready(function(){
        $(document).on('keyup','#keyword',function(){
            var keyword = $(this).val();
            let action = document.getElementById('actionInput').value;
            let connect = document.getElementById('connectInput').value;
             $.ajax({
                 type: "get",
                 url: "/admin/equipment/search",
                 data:{
                     keyword: keyword,
                     action: action,
                     connect: connect
                 },
                 dataType: "json",
                 success: function(response){
                    $("#listEquip").html(response);
                 }
             })
        });
    });
</script>
<script> 
    $(document).ready(function(){
        let flag1 =0;
        let flag2 =0;
        $("#dropAction").click(function(){
            $("#dropAction-box").toggleClass("block");
            $('#dropAction i').text('arrow_drop_up');
            flag1++;
            if(flag1 == 2)
            {
                flag1 = 0;
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
            action = document.getElementById('actionInput')
            if($(this).text() == "Tất cả")
            {
                action.value = "0";
                console.log(action.value);
            }
            else if($(this).text() == "Đang hoạt động")
            {
                
                action.value = "1";
                console.log(action.value);
            }else 
            {
                action.value = "-1";
                console.log(action.value);
            }
            let connect = document.getElementById('connectInput').value;
            var keyword = $("#keyword").val();
             $.ajax({
                 type: "get",
                 url: "/admin/equipment/search",
                 data:{
                     keyword: keyword,
                     action: action.value,
                     connect: connect
                 },
                 dataType: "json",
                 success: function(response){
                    $("#listEquip").html(response);
                 }
             })
        });
        $("#dropConnect").click(function(){
            $("#dropConnect-box").toggleClass("block");
            $('#dropConnect i').text('arrow_drop_up');
            flag2++;
            if(flag2 == 2)
            {
                flag2 = 0;
                $('#dropConnect i').text('arrow_drop_down');
            }
        });
        $("#dropConnect-box li").click(function(){
            $("#dropConnect-box .box-active").removeClass("box-active");
            $(this).toggleClass("box-active");
            $("#dropConnect-box").removeClass("block");
            $("#dropConnect p").text($(this).text());
            $('#dropConnect i').text('arrow_drop_down');
            flag2 =0;
            connect = document.getElementById('connectInput');
            if($(this).text() == "Tất cả")
            {
                connect.value = "0";
            }
            else if($(this).text() == "Kết nối")
            {
                
                connect.value = "1";
                console.log(connect.value);
            }else 
            {
                connect.value = "-1";
                console.log(connect.value);
            }
            let actionEQ = document.getElementById('actionInput').value;
            var keyword = $("#keyword").val();
             $.ajax({
                 type: "get",
                 url: "/admin/equipment/search",
                 data:{
                     keyword: keyword,
                     action: actionEQ,
                     connect: connect.value
                 },
                 dataType: "json",
                 success: function(response){
                    $("#listEquip").html(response);
                 }
             })
        });
    });
    </script>
@endsection
