@extends('layout.layout')
@extends('layout.navbar')
@section('content')
<div class="main-title">Cài đặt hệ thống > Danh sách tài khoản ><span class="orange strong">Thêm tài khoản</span></div>
<p class="component-title strong">Quản lý tài khoản</p>
<div class="container bg-white h-400">
<div class="form-title">Thông tin tài khoản</div>
<form action="{{ route('update.account') }}" class="form-group" method="POST">
    @csrf
    <input type="hidden" name="id" value="{{ $account[0]->id }}">
    <div class="form-control2">
        <label for="code">Họ tên: <span class="fire">*</span></label>
        <input type="text" name="fullname" placeholder="Nhập họ tên" value="{{ $account[0]->fullname }} " @if(isset($errFullname)) style="border: 0.5px solid red" @endif>
    </div>
    <div class="form-control2 margin-left20">
        <label for="username">Tên đăng nhập: <span class="fire">*</span></label>
        <input type="text" name="username" placeholder="Nhập tên đăng nhập" value="{{ $account[0]->username }}" @if(isset($errUsername)) style="border: 0.5px solid red" @endif>
    </div> 
    <div class="form-control2 ">
        <label for="name">Số điện thoại: <span class="fire">*</span></label>
        <input type="text" name="phonenumber" placeholder="Nhập số điện thoại" value="{{ $account[0]->phonenumber }}" @if(isset($errPhonenumber)) style="border: 0.5px solid red" @endif>
    </div> 
    <div class="form-control2 margin-left20">
        <label for="password">Mật khẩu: <span class="fire">*</span></label>
        <input type="password" name="password" placeholder="Nhập mật khẩu" value="{{ $account[0]->password }}" @if(isset($errPassword)) style="border: 0.5px solid red" @endif>
    </div>
    <div class="form-control2 ">
        <label for="ip_address">Email: <span class="fire">*</span></label>
        <input type="email" name="email" placeholder="Nhập địa chỉ email" value="{{ $account[0]->email }}"@if(isset($errEmail)) style="border: 0.5px solid red" @endif>
    </div>
    <div class="form-control2  margin-left20">
        <label for="ip_address">Nhập lại mật khẩu: <span class="fire">*</span></label>
        <input type="password" name="confirm_password" placeholder="Nhập lại mật khẩu" value="{{ $account[0]->password }}"@if(isset($errPassword)) style="border: 0.5px solid red" @endif>
    </div>
    <div class="form-control2">
        <label for="code">Vai trò: <span class="fire">*</span></label>
        <select name="rule">
            <option value="{{ $account[0]->role_id }}">{{ $account[0]->role_name }}</option>
            @foreach ($roles as $item)
            <option value="{{ $item->id }}">{{ $item->name }}</option>
            @endforeach
        </select>
    </div> 
    <div class="form-control2  margin-left20">
        <label for="code">Tình trạng: <span class="fire">*</span></label>
        <select name="status">
            <option value="{{ $account[0]->status }}">
            @if ($account[0]->status == 1)
             Đang hoạt động
            @else
             Ngưng hoạt động
            @endif
            </option>
            <option value="1">Đang hoạt động</option>
            <option value="-1">Ngưng hoạt động</option>
        </select>
    </div> 
        <div class="form-buttons">
            <a class="denie-button" href="{{ route('equipment') }}">Hủy bỏ</a>
            <button type="submit" class="continue-button">Cập nhật</button>
        </div>
        <div class="form-control2">
            <p><span class="fire relative">*</span>là trường thông tin bắt buộc</p>
        </div>
    </form>
</div>
