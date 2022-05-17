@extends('layout.layout')
@extends('layout.navbar')
@section('content')
<div class="main-title">Thiết bị > Danh sách thiết bị ><span class="orange strong">Cập nhật thiết bị</span></div>
<p class="component-title strong">Quản lý thiết bị</p>
<div class="container bg-white h-400">
<div class="form-title">Thông tin thiết bị</div>
    <form action="{{ route('update.equipment') }}" class="form-group" method="POST">
        @csrf
        <input type="hidden" name="oldCode" value="{{ $detail[0]->Code }}">
        <div class="form-control2">
            <label for="code">Mã thiết bị: <span class="fire">*</span></label>
            <input type="text" name="code" placeholder="Nhập mã thiết bị" value="{{ $detail[0]->Code }}">
        </div>
        <div class="form-control2 margin-left20">
            <label for="type">Loại thiết bị: <span class="fire">*</span></label>
            <select name="type">
                <option value="{{ $detail[0]->type_id }}">{{ $detail[0]->type_name }}</option>
                @foreach ($listType as $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
        </div> 
        <div class="form-control2 ">
            <label for="name">Tên thiết bị: <span class="fire">*</span></label>
            <input type="text" name="name" placeholder="Nhập tên thiết bị" value="{{ $detail[0]->name }}">
        </div> 
        <div class="form-control2 margin-left20">
            <label for="username">Tên đăng nhập: <span class="fire">*</span></label>
            <input type="text" name="username" placeholder="Nhập tên đăng nhập"value="{{ $detail[0]->login_name }}">
        </div> 
        <div class="form-control2 ">
            <label for="ip_address">Địa chỉ IP: <span class="fire">*</span></label>
            <input type="text" name="ip_address" placeholder="Nhập địa chỉ IP"value="{{ $detail[0]->IP }}">
        </div>
        <div class="form-control2 margin-left20">
            <label for="password">Mật khẩu: <span class="fire">*</span></label>
            <input type="text" name="password" placeholder="Nhập mật khẩu"value="{{ $detail[0]->password }}">
        </div>
        <input type="hidden" name="service" value="{{ $detail[0]->service_use }}" id="service">
        <div class="form-buttons">
            <a class="denie-button" href="{{ route('equipment') }}">Hủy bỏ</a>
            <button type="submit" class="continue-button">Cập nhật</button>
        </div>
    </form>
    <div class="tag-box">
        <p>Dịch vụ sử dụng:<span>*</span></p>
        <ul id="tag-box">
            <input type="text" placeholder="Nhập dịch vụ sử dụng">
        </ul>
        <div class="listService" id="listService">
        </div>
        <div class="form-control2">
            <p><span class="fire relative">*</span>là trường thông tin bắt buộc</p>
        </div>
    </div>

</div>
