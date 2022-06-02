@extends('layout.layout')
@extends('layout.navbar')
@section('content')
<div class="main-title">Cài đặt hệ thống >   <span class="orange strong">  Nhật kí người dùng</span></div>
<div class="container">
    <div class="dropdown-container-main">
        <div class="dropdown-container" style="width: 500px">
            <p>Chọn thời gian</p>
            <div class="dropdown-box-calendar">
                <i class="far fa-calendar-alt"></i>
                <p id="time1"></p>
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
    <script> 
    $(document).ready(function(){
        $(".dropdown-box-calendar").click(function(){
            $(".box-calendar").toggleClass("block");
        });
    });
    </script>
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
                   <th>Thời gian tác động</th>
                   <th>IP thực hiện</th>
                   <th class="bd-radius-topright10">Thao tác thực hiện</th>
               </tr>
            </thead>
            <tbody id ="listDiary">
                @foreach ($items as $item)
                <tr>
                    <td>{{ $item->username }}</td>
                    <td>{{ $item->time }}</td>
                    <td >{{ $item->ip }}</td>
                    <td>{{ $item->des }}</td>
                  </tr>  
                @endforeach
            </tbody>
        </table>
    </div>
    @if ($maxPage > 1)
    <div class="page-control" id="list-page">
        @if($page != 1)
        <a href="{{ route('diary',['page' => $page - 1]) }}"><i class="material-icons">keyboard_arrow_left</i></a>
        @endif
        @if($page >= 4)
        ...
        @endif
        @for ($i = 1; $i <= $maxPage; $i++)

        @if($i == $page)
         <a href="{{ route('diary',['page' => $i]) }}" class="page page-active">{{ $i }}</a>
        @elseif ($page - $i <= 2 && $i - $page <= 2)
         <a href="{{ route('diary',['page' => $i]) }}" class="page">{{ $i }}</a>
        @endif
       
        @endfor
        @if($page < $maxPage - 2)
        ...
        @endif
        @if($page != $maxPage)
        <a href="{{ route('diary',['page' => $page + 1]) }}"><i class="material-icons">keyboard_arrow_right</i></a>
        @endif
    </div>
    @endif
</div>
</div>
<script>
    $(document).ready(function(){
        $(document).on('keyup','#keyword',function(){
            var keyword = $(this).val();
             $.ajax({
                 type: "get",
                 url: "/diary/search",
                 data:{
                     keyword: keyword,
                 },
                 dataType: "json",
                 success: function(response){
                    $("#listDiary").html(response);
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
  url: "/diarySearchTime",
  data:{
     start: time1,
     end: time2,
  },
  dataType: "json",
  success: function(response){
     $("#listDiary").html(response);
  }
})
})
    });
</script>
@endsection
