@extends('layout.layout')
@extends('layout.navbar')
@section('content')
<div class="main-title">Cấp số >   <span class="orange strong">  Danh sách cấp số</span></div>
<p class="component-title strong">Quản lý cấp số</p>
<div  class="container-control"><a href="{{ route('givenumber.add') }}" class="add-button">
    <i class="material-icons">add_box</i>
    <p>Cấp số mới</p>
</a>
</div>

<div class="container">
    <div class="dropdown-container-main">
        <div class="dropdown-container">
            <p>Tên dịch vụ</p>
            <div class="dropdown-box" id="dropServiceName">
                <p id="service_name">Tất cả</p>
                <i class="material-icons">arrow_drop_down</i>
            </div>
            <div class="box" id="dropServiceName-box">
                <ul>
                    <li  class="box-items box-active">Tất cả</li>
                    @foreach ($services as $item)
                    <li  class="box-items ">{{ $item->name }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="dropdown-container margin-left10">
            <p>Tình trạng</p>
            <div class="dropdown-box" id="dropStatus">
                <p id="status">Tất cả</p>
                <i class="material-icons">arrow_drop_down</i>
            </div>
            <div class="box" id="dropStatus-box">
                <ul>
                    <li  class="box-items box-active">Tất cả</li>
                    <li  class="box-items ">Đang chờ</li>
                    <li  class="box-items ">Đã sử dụng</li>
                    <li  class="box-items ">Đã bỏ qua</li>
                </ul>
            </div>
        </div>
        <div class="dropdown-container margin-left10">
            <p>Nguồn cấp</p>
            <div class="dropdown-box" id="dropSource">
                <p id="equipment_name">Tất cả</p>
                <i class="material-icons">arrow_drop_down</i>
            </div>
            <div class="box" id="dropSource-box">
                <ul>
                    <li  class="box-items box-active">Tất cả</li>
                    @foreach ($equip as $item)
                    <li  class="box-items ">{{ $item->name }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="dropdown-container margin-left15" style="width: 500px">
            <p>Chọn thời gian</p>
            <div class="dropdown-box-calendar">
                <i class="far fa-calendar-alt"></i>
                <p id="time1">26/04/2022</p>
            </div>
            <div class="box-calendar">
                <div class="bg-white w-100" id="caleandar" style="width:300px;height:260px"></div>
            </div>
            <div class="dropdown-box-calendar-and">
            <i class="material-icons">play_arrow</i>
            </div>
            <div class="dropdown-box-calendar">
                <i class="far fa-calendar-alt"></i>
                <p id="time2">dd/mm/yy</p>
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
                   <th class="bd-radius-topleft10">STT</th>
                   <th>Tên khách hàng</th>
                   <th>Tên dịch vụ</th>
                   <th>Thời gian cấp</th>
                   <th>Hạn sử dụng</th>
                   <th>Trạng thái</th>
                   <th>Nguồn cấp</th>
                   <th class="bd-radius-topright10">&emsp;</th>
               </tr>
            </thead>
            <tbody id="listNumber">
                @foreach ($serial as $item)
               <tr>
                 <td>{{ $item->serial }}</td>
                 <td>{{ $item->name }}</td>
                 <td>{{ $item->service_name }}</td>
                 <td >{{ $item->created_at }}</td>
                 <td>{{ $item->limit_time }}</td>
                 @if($item->status == -1)
                 <td ><i class="dot dot-fire"></i><p>Đã bỏ qua</p></td>
                 @elseif ($item->status == 0)
                 <td ><i class="dot dot-water"></i><p>Đang chờ</p></td>
                 @elseif ($item->status == 1)
                 <td ><i class="dot dot-jungle"></i><p>Đã sử dụng</p></td>
                 @endif
                 <td>{{ $item->equipment_name }}</td>
                 <td><a href="{{ route('givenumber.detail',['stt' => $item->serial]) }}">Chi tiết</a></td>
               </tr>
               @endforeach
            </tbody>
        </table>
    </div>
    @if ($maxPage > 1)
    <div class="page-control" id="list-page">
        @if($page != 1)
        <a href="{{ route('givenumber',['page' => $page - 1]) }}"><i class="material-icons">keyboard_arrow_left</i></a>
        @endif
        @if($page >= 4)
        ...
        @endif
        @for ($i = 1; $i <= $maxPage; $i++)

        @if($i == $page)
         <a href="{{ route('givenumber',['page' => $i]) }}" class="page page-active">{{ $i }}</a>
        @elseif ($page - $i <= 2 && $i - $page <= 2)
         <a href="{{ route('givenumber',['page' => $i]) }}" class="page">{{ $i }}</a>
        @endif
       
        @endfor
        @if($page < $maxPage - 2)
        ...
        @endif
        @if($page != $maxPage)
        <a href="{{ route('givenumber',['page' => $page + 1]) }}"><i class="material-icons">keyboard_arrow_right</i></a>
        @endif
    </div>
    @endif
</div>
</div>
<script> 
    $(document).ready(function(){
        let flag1 = 0;
        let flag2 = 0;
        let flag3 = 0;
        $("#dropServiceName").click(function(){
            $("#dropServiceName-box").toggleClass("block");
            $('#dropServiceName i').text('arrow_drop_up');
            flag1++;
            if(flag1 == 2)
            {
                flag1 = 0;
                $('#dropServiceName i').text('arrow_drop_down');
            }
            
        });
        $("#dropServiceName-box li").click(function(){
            $("#dropServiceName-box .box-active").removeClass("box-active");
            $(this).toggleClass("box-active");
            $("#dropServiceName-box").removeClass("block");
            $('#dropServiceName i').text('arrow_drop_down');
            $("#dropServiceName p").text($(this).text());
            flag1 = 0;
            let keyword = document.getElementById('keyword').value;
            let status = $("#dropStatus p").text();
            let service_name = $("#dropServiceName p").text();
            let equipment_name = $("#dropSource p").text();
            console.log(service_name);
             $.ajax({
                 type: "get",
                 url: "/givenumber/search",
                 data:{
                     search: keyword,
                     service_name: service_name,
                     equipment_name: equipment_name,
                     status: status
                 },
                 dataType: "json",
                 success: function(response){
                    $("#listNumber").html(response);
                 }
             })
        });
        $("#dropStatus").click(function(){
            $("#dropStatus-box").toggleClass("block");
            $('#dropStatus i').text('arrow_drop_up');
            flag2++;
            if(flag2 == 2)
            {
                flag2 = 0;
                $('#dropStatus i').text('arrow_drop_down');
            }
        });
        $("#dropStatus-box li").click(function(){
            $("#dropStatus-box .box-active").removeClass("box-active");
            $(this).toggleClass("box-active");
            $("#dropStatus-box").removeClass("block");
            $('#dropStatus i').text('arrow_drop_down');
            $("#dropStatus p").text($(this).text());
            flag2 = 0;
            let keyword = document.getElementById('keyword').value;
            let status = $("#dropStatus p").text();
            let service_name = $("#dropServiceName p").text();
            let equipment_name = $("#dropSource p").text();
            console.log(service_name);
             $.ajax({
                 type: "get",
                 url: "/givenumber/search",
                 data:{
                     search: keyword,
                     service_name: service_name,
                     equipment_name: equipment_name,
                     status: status
                 },
                 dataType: "json",
                 success: function(response){
                    $("#listNumber").html(response);
                 }
             })
        });
        $("#dropSource").click(function(){
            $('#dropSource i').text('arrow_drop_up');
            $("#dropSource-box").toggleClass("block");
            flag3++;
            if(flag3 == 2)
            {
                flag3 = 0;
                $('#dropSource i').text('arrow_drop_down');
            }
        });
        $("#dropSource-box li").click(function(){
            $("#dropSource-box .box-active").removeClass("box-active");
            $(this).toggleClass("box-active");
            $("#dropSource-box").removeClass("block");
            $('#dropSource i').text('arrow_drop_down');
            $("#dropSource p").text($(this).text());
            flag3 = 0;
            let keyword = document.getElementById('keyword').value;
            let status = $("#dropStatus p").text();
            let service_name = $("#dropServiceName p").text();
            let equipment_name = $("#dropSource p").text();
            console.log(service_name);
             $.ajax({
                 type: "get",
                 url: "/givenumber/search",
                 data:{
                     search: keyword,
                     service_name: service_name,
                     equipment_name: equipment_name,
                     status: status
                 },
                 dataType: "json",
                 success: function(response){
                    $("#listNumber").html(response);
                    $("#listNumber").css("overflow-y","scroll");
                 }
             })
        });
        $(".dropdown-box-calendar").click(function(){
            $(".box-calendar").toggleClass("block");
        });
        $(document).on('keyup','#keyword',function(){
            var keyword = $(this).val();
            let status = $("#dropStatus p").text();
            let service_name = $("#dropServiceName p").text();
            let equipment_name = $("#dropSource p").text();
             $.ajax({
                 type: "get",
                 url: "/givenumber/search",
                 data:{
                     search: keyword,
                     service_name: service_name,
                     equipment_name: equipment_name,
                     status: status
                 },
                 dataType: "json",
                 success: function(response){
                    $("#listNumber").html(response);
                 }
             })
        });
        let flag = 1;
  $("#time1").text($(".cld-days .today").text() + "/" + $(".cld-datetime .today").text());
  $(".cld-number").click(function(){
    console.log($(this).text());
  let date = $(this).text() + "/" + $(".cld-datetime .today").text();
  $(".cld-days li").removeClass("today");
  $(this).addClass("today");
  if(flag == 0)
  {
      $("#time1").text(date);
      flag = 1;
  }
  else {
      $("#time2").text(date);
      flag = 0;
  }
let time1 = $("#time1").text();
let time2 = $("#time2").text();

$.ajax({
  type: "get",
  url: "/givenumber/searchTime",
  data:{
     start: time1,
     end: time2,
  },
  dataType: "json",
  success: function(response){
     $("#listNumber").html(response);
  }
})
})
    });
    </script>
@endsection
