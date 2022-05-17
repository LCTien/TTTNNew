@extends('layout.layout')
@extends('layout.navbar')
@section('content')
<div class="main-title">Thiết bị > Danh sách thiết bị ><span class="orange strong">Thêm thiết bị</span></div>
<p class="component-title strong">Quản lý thiết bị</p>
<div class="container bg-white h-400">
<div class="form-title">Thông tin thiết bị</div>
<form action="{{ route('add.equipment') }}" class="form-group" method="POST">
    @csrf
    <div class="form-control2">
        <label for="code">Mã thiết bị: <span class="fire">*</span></label>
        <input type="text" name="code" placeholder="Nhập mã thiết bị">
    </div>
    <div class="form-control2 margin-left20">
        <label for="code">Loại thiết bị: <span class="fire">*</span></label>
        <select name="type">
            <option value="1">Kiosk</option>
            <option value="2">Display counter</option>
        </select>
    </div> 
    <div class="form-control2 ">
        <label for="name">Tên thiết bị: <span class="fire">*</span></label>
        <input type="text" name="name" placeholder="Nhập tên thiết bị">
    </div> 
    <div class="form-control2 margin-left20">
        <label for="username">Tên đăng nhập: <span class="fire">*</span></label>
        <input type="text" name="username" placeholder="Nhập tên đăng nhập">
    </div> 
    <div class="form-control2 ">
        <label for="ip_address">Địa chỉ IP: <span class="fire">*</span></label>
        <input type="text" name="ip_address" placeholder="Nhập địa chỉ IP">
    </div>
    <div class="form-control2 margin-left20">
        <label for="password">Mật khẩu: <span class="fire">*</span></label>
        <input type="text" name="password" placeholder="Nhập mật khẩu">
    </div>
        <div class="form-buttons">
            <a class="denie-button" href="{{ route('equipment') }}">Hủy bỏ</a>
            <button type="submit" class="continue-button">Thêm thiết bị</button>
        </div>
        <input type="hidden" name="service" value="" id="service">
    </form>
    <div class="tag-box">
        <p>Dịch vụ sử dụng:<span>*</span></p>
        <ul id="tag-box">
            <input type="text"placeholder="Nhập dịch vụ sử dụng">
        </ul>
        <div class="listService" id="listService">
        </div>
        <div class="form-control2">
            <p><span class="fire relative">*</span>là trường thông tin bắt buộc</p>
        </div>
    </div>
   
 
</div>
