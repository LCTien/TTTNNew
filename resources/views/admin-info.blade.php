@extends('layout.layout')
@extends('layout.navbar')
@section('content')
<div class="admin-title"><p>Thông tin cá nhân</p></div>
    <div class="content">
        <div class="profile-1">
            <img src="/assets/img/{{ $user->avatar }}" alt="avatar" id="avatar">
            <a class="profile-1 set-avatar" id="upload"><i class="fas fa-camera"></i></a>
            <h1>{{ $user->fullname }}</h1>
        </div>
        <div class="profile-2">
            <div class=" profile-2-item">
                <h4>Tên người dùng:</h4>
                <p>{{ $user->fullname }}</p>
            </div>
            <div class=" profile-2-item">
                <h4>Tên đăng nhập:</h4>
                <p>{{ $user->username }}</p>
            </div><div class=" profile-2-item">
                <h4>Số điện thoại:</h4>
                <p>{{ $user->phonenumber }}</p>
            </div><div class=" profile-2-item">
                <h4>Mật khẩu:</h4>
                <p>{{ $user->password }}</p>
            </div><div class=" profile-2-item">
                <h4>Email:</h4>
                <p>{{ $user->email }}</p>
            </div><div class=" profile-2-item">
                <h4>Vai trò:</h4>
                <p>{{ $user->name }}</p>
        </div>
    </div>
</div>
<div class="modal-update-image" id="form">
    <form action="{{ route('uploadImage') }}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="file" name="file"><br>
        <button type="submit">Thay đổi</button>
    </form>
</div>
    <script>
       $(document).ready(function(){
           let flag = 1;
        $("#upload").click(function () {
            if(flag == 1)
            {
                $("#form").css("display","block");
                flag++;
            }
            else
            {
                $("#form").css("display","none");
                flag = 1;
            }
            
        });
       })
    </script>
@endsection
