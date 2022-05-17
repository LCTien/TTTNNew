@extends('layout.layout')
@extends('layout.navbar')
@section('content')
<div class="main-title action">Dashboard</div>
<p class="component-title">Biểu đồ cấp số</p>
<div class="chart-box">
   <div class="tiny-chart">
       <div class="icon-fluid water bg-water"><i class="far fa-calendar"></i></div>
       <p class="tiny-chart-title">Số thứ tự đã cấp</p>
       <p class="tiny-chart-content">0</p>
       <div class="tiny-chart-growth">
        <i class="fas fa-arrow-up"></i>
        <p> 32,45%</p>
       </div>
   </div>
   <div class="tiny-chart">
    <div class="icon-fluid jungle bg-jungle"><i class="far fa-calendar-check"></i></div>
    <p class="tiny-chart-title">Số thứ tự đã sử dụng</p>
    <p class="tiny-chart-content">0</p>
    <div class="tiny-chart-growth fire bg-fire">
        <i class="fas fa-arrow-down"></i>
        <p> 32,45%</p>
    </div>
</div>
<div class="tiny-chart">
    <div class="icon-fluid orange bg-orange"><i class="material-icons">&#xe637;</i></div>
    <p class="tiny-chart-title">Số thứ tự đang chờ</p>
    <p class="tiny-chart-content">0</p>
    <div class="tiny-chart-growth">
        <i class="fas fa-arrow-up"></i> <p> 32,45%</p>
    </div>
</div>
<div class="tiny-chart">
    <div class="icon-fluid fire bg-fire"><i class="far fa-bookmark"></i></div>
    <p class="tiny-chart-title">Số thứ tự đã bỏ qua</p>
    <p class="tiny-chart-content">0</p>
    <div class="tiny-chart-growth fire bg-fire">
        <i class="fas fa-arrow-down"></i> <p> 32,45%</p>
    </div>
</div>
   <div class="big-chart">
       <p class="big-chart-title">Bảng thống kê theo ngày</p>
       <p class="big-chart-date">Tháng 4/2022</p>
       <div class="big-chart-box">
        <p class="big-chart-content">Xem theo</p>
        <select class="report-chart-with" name="reportwith" id="" onchange="">
            <option value="Ngày">Ngày</option>
            <option value="Tháng">Tháng</option>
            <option value="Năm">Năm</option>
        </select>
       </div>
     <div class="chart" id="chart">
     </div>
 @push('chart')
    <script>    
        var options = {
        chart: {
            height:'300px',
            type: 'area'
        },
        series: [{
            data: [30,40,35,50,49,60,70,91,125]
        }],
        xaxis: {
            categories: [1991,1992,1993,1994,1995,1996,1997, 1998,1999]
        },
        }
        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();
    </script>
@endpush
   </div>
 </div>
<div class="nav-right">
    <p class="nav-right-title">Tổng quan</p>
    <div class="nav-right-card">
        <div class="nav-right-card-chart bd-orange" id="chart-equipment">
            <div class="nav-right-card-chart-percent ">
                90%
            </div>
            <p class="nav-right-card-items">24000</p>
            <div class="nav-right-card-content">
                <i class="material-icons">desktop_windows</i> 
                <p class="padding-left25">Thiết bị</p>
            </div>  
            
    </div>
        <div class="nav-right-card-items-2">
            <div class="nav-right-card-items-2-item">
            <div class="padding-top5">
                <i class="dot dot-yellow"></i>
            </div>
            <p class="padding-left10">Đang hoạt động</p>
            <span class="orange">455</span>
            </div>
            <div class="nav-right-card-items-2-item">
                <div class="padding-top5">
                    <i class="dot"></i>
                </div>
                <p class="padding-left10">Ngưng hoạt động</p>
                <span class="orange">50</span>
                </div>
        </div>
        </div><br>
        <div class="nav-right-card">
            <div class="nav-right-card-chart bd-water">
                <p class="nav-right-card-chart-percent">90%</p>
                <p class="nav-right-card-items">24000</p>
                <div class="nav-right-card-content water">
                    <i class="material-icons">question_answer</i>
                    <p class="padding-left25">Dịch vụ</p>
                </div>    
            </div>
            <div class="nav-right-card-items-2">
                <div class="nav-right-card-items-2-item">
                <div class="padding-top5">
                    <i class="dot dot-water"></i>
                </div>
                <p class="padding-left10">Đang hoạt động</p>
                <span class="water">455</span>
                </div>
                <div class="nav-right-card-items-2-item">
                    <div class="padding-top5">
                        <i class="dot"></i>
                    </div>
                    <p class="padding-left10">Ngưng hoạt động</p>
                    <span class="water">50</span>
                    </div>
            </div>
            </div><br>
            <div class="nav-right-card">
                <div class="nav-right-card-chart bd-jungle">
                    <p class="nav-right-card-chart-percent">90%</p>
                    <p class="nav-right-card-items">24000</p>
                    <div class="nav-right-card-content jungle">
                        <i class="fas fa-layer-group"></i>
                        <p class="padding-left25">Cấp số</p>
                    </div>    
                </div>
                <div class="nav-right-card-items-2">
                    <div class="nav-right-card-items-2-item">
                        <div class="padding-top5">
                        <i class="dot dot-jungle"></i>
                        </div>
                        <p class="padding-left10">Đang chờ</p>
                        <span class="jungle">455</span>
                    </div>
                    <div class="nav-right-card-items-2-item">
                        <div class="padding-top5">
                        <i class="dot"></i>
                        </div>
                        <p class="padding-left10">Đã sử dụng</p>
                        <span class="jungle">50</span>
                    </div>
                    <div class="nav-right-card-items-2-item">
                        <div class="padding-top5 ">
                        <i class="dot dot-fire"></i>
                        </div>
                        <p class="padding-left10">Đã bỏ qua</p>
                        <span class="jungle">50</span>
                    </div>
                </div>
                </div><br>
    <div class="nav-right-calendar" id="caleandar"></div><br>
</div>
@endsection
