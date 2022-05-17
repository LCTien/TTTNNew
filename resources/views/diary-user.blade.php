@extends('layout.layout')
@extends('layout.navbar')
@section('content')
<div class="main-title">Cài đặt hệ thống >   <span class="orange strong">  Nhật kí người dùng</span></div>
<div class="container">
    <div class="dropdown-container-main">
        <div class="dropdown-container margin-left15" style="width: 500px">
            <p>Chọn thời gian</p>
            <div class="dropdown-box-calendar">
                <i class="far fa-calendar-alt"></i>
                <p>26/04/2022</p>
            </div>
            <div class="box-calendar">
                <div class="bg-white w-100" id="caleandar" style="width:300px;height:260px"></div>
            </div>
            <div class="dropdown-box-calendar-and">
            <i class="material-icons">play_arrow</i>
            </div>
            <div class="dropdown-box-calendar">
                <i class="far fa-calendar-alt"></i>
                <p>26/04/2022</p>
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
                <input type="text" placeholder="Nhập từ khóa" name="search">
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
            <tbody>
               <tr>
                 <td>congtien@abc</td>
                 <td>05/05/2022 14:42</td>
                 <td >192.168.1.1</td>
                 <td>Thêm một template cuối cùng</td>
               </tr>  
            </tbody>
        </table>
    </div>
    <div class="page-control">
        <a href=""><i class="material-icons">keyboard_arrow_left</i></a>
        <a href="" class="page page-active">1</a>
        <a href="" class="page">2</a>
        <a href="" class="page">3</a> ...
        <a href="" class="page">10</a>
        <a href=""><i class="material-icons">keyboard_arrow_right</i></a>
    </div>
</div>
</div>
@endsection
