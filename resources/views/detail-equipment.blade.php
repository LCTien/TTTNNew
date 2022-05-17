@extends('layout.layout')
@extends('layout.navbar')
@section('content')
<div class="main-title">Thiết bị > Danh sách thiết bị ><span class="orange strong">Chi tiết thiết bị</span></div>
<p class="component-title strong">Quản lý thiết bị</p>
<div  class="container-control"><a href="{{ route('equipment.update',['id' => $detail[0]->Code]) }}" class="add-button">
    <i class="fas fa-pen-square"></i>
    <p>Cập nhật thiết bị</p>
</a>
</div>

<div class="container bg-white">
    <div class="form-title">Thông tin thiết bị</div>
    <div class="form-group">
        <div class="form-control2 ">
            <h3>Mã thiết bị</h3>
            <p style="padding-left: 50px">{{ $detail[0]->Code }}</p>
        </div>
        <div class="form-control2">
            <h3>Loại thiết bị</h3>
            <p style="padding-left: 50px">{{ $detail[0]->type_name }}</p>
        </div>
        <div class="form-control2 padding-top15">
            <h3>Tên thiết bị</h3>
            <p style="padding-left: 50px">{{ $detail[0]->name }}</p>
        </div>
        <div class="form-control2 padding-top15">
            <h3>Tên đăng nhập</h3>
            <p style="padding-left: 50px">{{ $detail[0]->login_name }}</p>
        </div>
        <div class="form-control2 padding-top15">
            <h3>Địa chỉ IP</h3>
            <p style="padding-left: 50px">{{ $detail[0]->IP }}</p>
        </div>
        <div class="form-control2 padding-top15">
            <h3>Mật khẩu</h3>
            <p style="padding-left: 50px">{{ $detail[0]->password }}</p>
        </div>
        <div class="form-control2 padding-top15 w-100">
            <h3>Dịch vụ sử dụng</h3>
            <p style="padding-left: 50px">{{ $detail[0]->service_use }}</p>
        </div>
    </div>
   
</div>
@endsection
