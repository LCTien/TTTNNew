@extends('layout.layout')
@section('content')
       <img src="assets/img/LogoAltaMedia.png" alt="logo" class="logo">
           <p class="forget-password">Đặt lại mật khẩu</p>
           <p class="forget-password-2">Vui lòng nhập email để đặt lại mật khẩu của bạn *</p>
           <form action="{{ route('forgetpassword.confirm') }}" method="POST" class="form">
               @csrf
            <input type="email" class="form-control" placeholder="Nhập email" name="email">
            @if(isset($error))
            <p id="error" style="position: relative; top: 20px;">{{ $error }} </p>
            @endif
            <div class="group-button">
                <a href="{{ route('login') }}" class="denie-button">Hủy bỏ</a>
                <button type="submit" class="continue-button">Tiếp tục</button>
            </div>
            </form>  
    </div>
    <div class="title">
        <img src="assets/img/background2.png" alt="background" class="background2">
   
@endsection
