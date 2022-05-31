@extends('layout.layout')
@extends('layout.navbar')
@section('content')
<div class="main-title">Báo cáo >   <span class="orange strong">  Lập báo cáo</span></div>
<div  class="container-control"><a href="{{ route('download') }}" class="add-button">
    <i class="fa fa-download"></i>
    <p>Tải về</p>
</a>
</div>
<div class="container">
    <div class="dropdown-container-main">
        <div class="dropdown-container" style="width: 500px">
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
    <script> 
    $(document).ready(function(){
        $(".dropdown-box-calendar").click(function(){
            $(".box-calendar").toggleClass("block");
        });
    });
    </script>
    <div class="table">
        <table>
            <thead>
               <tr>
                   <th class="bd-radius-topleft10">Số thứ tự</th>
                   <th>Tên dịch vụ</th>
                   <th>Thời gian cấp</th>
                   <th>Tình trạng</th>
                   <th class="bd-radius-topright10">Nguồn cấp</th>
               </tr>
            </thead>
            <tbody id="listNumber2">
                @foreach ($stt as $item)
                <tr>
                    <td>{{ $item->serial }}</td>
                    <td>{{ $item->service_name }}</td>
                    <td >{{ $item->created_at }}</td>
                    @if($item->status == -1)
                    <td ><i class="dot dot-fire"></i><p>Đã bỏ qua</p></td>
                    @elseif ($item->status == 0)
                    <td ><i class="dot dot-water"></i><p>Đang chờ</p></td>
                    @elseif ($item->status == 1)
                    <td ><i class="dot dot-jungle"></i><p>Đã sử dụng</p></td>
                    @endif
                    <td>{{ $item->equipment_name }}</td>
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
@endsection
