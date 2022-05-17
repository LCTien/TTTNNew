@extends('layout.layout')
@section('content')
    
       <img src="/assets/img/LogoAltaMedia.png" alt="logo" class="logo">
           <p class="forget-password">Đặt lại mật khẩu mới</p>
           <form action="{{ route('confirm.forgetpassword') }}" class="form" method="post">
            @csrf
            <input type="hidden" name="email" value="{{ $email }}">
            <label for="password" class="input">Mật khẩu *</label><br>
            <input type="password" name="password" id="account" class="form-control"><br>
            <label for="confirmpassword" class="input">Nhập lại mật khẩu *</label><br>
            <input type="password" name="confirmpassword"  class="form-control"><br>
            @if (isset($error))
            <p id="error">{{ $error }}</p>
            @endif
            <button type="submit" class="submit" id="button-login"> <span> Xác Nhận</span></button>
           </form>
    
    <div class="title">
        <img src="/assets/img/background2.png" alt="background" class="background2">
    </div>

@endsection
