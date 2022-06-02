@extends('layout.layout')
@extends('layout.navbar')
@section('content')
<div class="main-title">Cài đặt hệ thống >   <span class="orange strong">  Danh sách vai trò</span></div>
<p class="component-title strong">Quản lý vai trò</p>
<div  class="container-control"><a href="{{ route('rule.add') }}" class="add-button">
    <i class="material-icons">add_box</i>
    <p>Thêm vai trò</p>
</a>
</div>

<div class="container">
    <div class="dropdown-container-main">
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
                   <th class="bd-radius-topleft10">Tên vai trò</th>
                   <th>Số người dùng</th>
                   <th>Mô tả</th>
                   <th class="bd-radius-topright10">&emsp;</th>
               </tr>
            </thead>
            <tbody>
              @foreach ($listRoles as $items)
               <tr>
                 <td>{{ $items->name }}</td>
                 <td>{{ $items->tong }}</td>
                 <td>{{ $items->description }}</td>
                 <td><a href="{{ route('rule.update',['id' => $items->id]) }}">Cập nhật</a></td>
               </tr>
               @endforeach
            </tbody>
        </table>
    </div>
    @if ($maxPage > 1)
    <div class="page-control" id="list-page">
        @if($page != 1)
        <a href="{{ route('rule.management',['page' => $page - 1]) }}"><i class="material-icons">keyboard_arrow_left</i></a>
        @endif
        @if($page >= 4)
        ...
        @endif
        @for ($i = 1; $i <= $maxPage; $i++)

        @if($i == $page)
         <a href="{{ route('rule.management',['page' => $i]) }}" class="page page-active">{{ $i }}</a>
        @elseif ($page - $i <= 2 && $i - $page <= 2)
         <a href="{{ route('rule.management',['page' => $i]) }}" class="page">{{ $i }}</a>
        @endif
       
        @endfor
        @if($page < $maxPage - 2)
        ...
        @endif
        @if($page != $maxPage)
        <a href="{{ route('rule.management',['page' => $page + 1]) }}"><i class="material-icons">keyboard_arrow_right</i></a>
        @endif
    </div>
    @endif
</div>
</div>
<script>
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
</script>
@endsection
