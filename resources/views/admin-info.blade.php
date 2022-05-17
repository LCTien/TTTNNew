@extends('layout.layout')
@extends('layout.navbar')
@section('content')
<div class="admin-title"><p>Thông tin cá nhân</p></div>
    <div class="content">
        <div class="profile-1">
            <img src="/assets/img/{{ $user->avatar }}" alt="avatar" id="avatar">
            <a class="profile-1 set-avatar" onclick="openFile()"><i class="fas fa-camera"></i></a>
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
    <script>
        async function openFile(){
           let [filehandel] = await window.showOpenFilePicker({
               types: [
                   {
                       description: 'Image',
                       accept:{
                           'images/*' : ['.jpg','.png','.jpeg','.gif']
                       }
                   },
               ],
               excludeAcceptAllOption: true,
               multiple: false
           });
           var fileData = await filehandel.getFile();
           var http = new XMLHttpRequest();
           var data = new FormData();
           data.append('filename', fileData.name);
           data.append('myfile', fileData);
           http.open('get','http://127.0.0.1:8000/uploadImg',true);
           http.send(data);
        }
    </script>
@endsection
