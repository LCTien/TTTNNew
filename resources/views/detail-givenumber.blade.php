@extends('layout.layout')
@extends('layout.navbar')
@section('content')
<div class="main-title">Cấp số > Danh sách cấp số ><span class="orange strong">Chi tiết cấp số</span></div>
<p class="component-title strong">Quản lý cấp số</p>

</div>

<div class="container bg-white">
    <div class="form-title">Thông tin cấp số</div>
    <div class="form-group">
        <div class="form-control2 ">
            <h3>Họ tên</h3>
            <p style="padding-left: 50px">{{ $serial[0]->name }}</p>
        </div>
        <div class="form-control2">
            <h3>Nguồn cấp</h3>
            <p style="padding-left: 50px">{{ $serial[0]->equipment_name }}</p>
        </div>
        <div class="form-control2 padding-top15">
            <h3>Tên dịch vụ</h3>
            <p style="padding-left: 50px">{{ $serial[0]->service_name }}</p>
        </div>
        <div class="form-control2 padding-top15">
            <h3>Trạng thái</h3>
            @if($serial[0]->status == -1)
            <p style="padding-left: 50px"><i class="dot dot-fire" style="left: 42px"></i>Đã bỏ qua</p>
                 @elseif ($serial[0]->status == 0)
                 <p style="padding-left: 50px"><i class="dot dot-water" style="left: 42px"></i>Đang chờ</p>
                 @elseif ($serial[0]->status == 1)
                 <p style="padding-left: 50px"><i class="dot dot-jungle" style="left: 42px"></i>Đã sử dụng</p>
                 @endif
        </div>
        <div class="form-control2 padding-top15">
            <h3>Số thứ tự</h3>
            <p style="padding-left: 50px;">{{ $serial[0]->serial }}</p>
        </div>
        <div class="form-control2 padding-top15">
            <h3>Số điện thoại</h3>
            <p style="padding-left: 50px">{{ $serial[0]->phonenumber }}</p>
        </div>
        <div class="form-control2 padding-top15">
            <h3>Thời gian cấp</h3>
            <p style="padding-left: 50px">{{ $serial[0]->created_at }}</p>
        </div>
        <div class="form-control2 padding-top15">
            <h3>Email</h3>
            <p style="padding-left: 50px">{{ $serial[0]->email }}</p>
        </div>
        <div class="form-control2 padding-top15">
            <h3>Hạn sử dụng</h3>
            <p style="padding-left: 50px">{{ $serial[0]->limit_time }}</p>
        </div>
    </div>
   
</div>
@endsection
