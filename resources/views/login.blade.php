@extends('layout.layout')
@section('content')
<div class="login">
       <img src="assets/img/LogoAltaMedia.png" alt="logo" class="logo">
        <form action="{{ route('welcome') }}" method="post" class="form">
            @csrf
            <label for="account" class="input">Tên đăng nhập *</label><br>
            <input type="text" name="account" id="account" class="form-control @if (isset( $_GET['error']))
                danger
            @endif"><br>
            <label for="password" class="input">Mật Khẩu *</label><br>
            <input type="password" name="password"  class="form-control @if (isset( $_GET['error']))
         danger
        @endif"><br>
        
            @if (!isset( $_GET['error']))
            <div id="forgetpassword">
                <a href="{{ route('forgetpassword') }}" id="forgetpassword" >  Quên mật khẩu?</a></div>
            
             @else
            <p id="error">! {{ $_GET['error'] }}</p>
            
            @endif
            <button type="submit" class="submit" id="button-login"> <span> Đăng Nhập</span></button>
            @if (isset( $_GET['error']))
            <a href="{{ route('forgetpassword') }}" id="forgetpassword-error" >  Quên mật khẩu?</a></div>
            @endif
        </form>
    </div>
    <div class="title">
        <img src="assets/img/background1.png" alt="background" class="background">
        <p class="system-title">Hệ Thống</div>
        <span class="system-name">Quản Lý Xếp Hàng</span>
    </div>
   @if (isset($OK)))
    <script>
        alert('Congratulations on a successful password change');
       </script>
   @endif
@endsection
