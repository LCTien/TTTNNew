@extends('layout.layout')
@extends('layout.navbar')
@section('content')
<div class="main-title">Cấp số >  Danh sách cấp số > <span class="orange strong"> Cấp số mới</span></div>
<p class="component-title strong">Quản lý cấp số</p>

<div class="container bg-white">
    <div class="givenumber-form">
        <h1>CẤP SỐ MỚI</h1>
        <p>Dịch vụ khách hàng lựa chọn</p>
        <div class="dropdown">
            <p id="service_name">{{ $service[0]->name }}</p>
            <i class="material-icons">arrow_drop_down</i>
            <div class="givenumber-dropbox">
                <ul id="drop">
                    <?php $flag = 0 ?>
                    @foreach ($service as $items)
                    <li  class="box-items @if ($flag == 0) box-active @endif">{{ $items->name; }}</li>
                    <?php $flag++ ?>
                    @endforeach
                </ul>
            </div>
           
        </div>
        <div class="give-add-button">
            <a href="{{ route('givenumber') }}" class="denie-button"> Hủy bỏ</a>
            <button type="submit" class="continue-button" id="givenumber">Cấp số</button>
        </div>
        <script>
        
        $(document).ready(function(){
            input = document.getElementById('service');
            input.value = $(".dropdown p").text();
        let flag = 0;
        $(".dropdown").click(function(){
            $(".givenumber-dropbox").toggleClass("block");
            $('.dropdown i').text('arrow_drop_up');
            flag++;
           if(flag == 2)
           {
               flag = 0;
            $('.dropdown i').text('arrow_drop_down');
           }
        });
        $(".givenumber-dropbox li").click(function(){
            $(".givenumber-dropbox .box-active").removeClass("box-active");
            $(".givenumber-dropbox ul").removeClass("block");
            $(this).toggleClass("box-active");
            $(".dropdown p").text($(this).text());
            input.value = $(".dropdown p").text();   
            $('.dropdown i').text('arrow_drop_down');
            flag1 =0;
        });
        $(".dropdown-box-calendar").click(function(){
            $(".box-calendar").toggleClass("block");
        });
        $("#dropConnect-box li").click(function(){
            $("#dropConnect-box .box-active").removeClass("box-active");
            $(this).toggleClass("box-active");
            $("#dropConnect-box").removeClass("block");
            $("#dropConnect p").text($(this).text());
        });
    });
        </script>
    </div>
</div>
<div class="modal-form">
    <div class="modal-form-content">
      <div class="modal-title">Điền thông tin của bạn</div>
      <input type="hidden" name="service" value="" id="service">
      <div class="form-modal">
          <div class="form-items">
            <label for="fullname">Họ và tên <span>*</span></label>
            <input type="text" name="fullname" placeholder="Nhập họ và tên" id="name">
          </div>
          <div class="form-items">
            <label for="phonenumber">Số điện thoại <span>*</span></label>
            <input type="text" name="phonenumber" placeholder="Nhập số điện thoại"id="phonenumber">
          </div>
          <div class="form-items">
            <label for="fullname">Email <span>*</span></label>
            <input type="email" name="email" placeholder="Nhập email"id="email">
          </div>
         <p><span>*</span> là trường thông tin bắt buộc</p>
          <div class="group-button-modal">
              <a href="" class="denie-button" id="denie">Hủy bỏ</a>
            <button type="submit" class="continue-button" id="accept">Xác nhận</button>
          </div>
    </div> 
</div>
</div>
<div class="modal-give">
</div>
<script>
    $('#denie').click(function(){
        $('.modal-form').css("display","none");
    });
    $('#givenumber').click(function(){
        $('.modal-form').css("display","flex");
    });
    $('#accept').click(function(){
        let service = document.getElementById('service').value;
        let name = document.getElementById('name').value;
        let phonenumber = document.getElementById('phonenumber').value;
        let email = document.getElementById('email').value;
        console.log(service);
        console.log(name);
        console.log(phonenumber);
        console.log(email);
        $.ajax({
                 type: "get",
                 url: "/admin/giveNumber",
                 data:{
                     service: service,
                     name: name,
                     phonenumber: phonenumber,
                     email: email
                 },
                 dataType: "json",
                 success: function(response){
                    $('.modal-give').css("display","flex");
                    $(".modal-give").html(response);
                    $('.close').click(function(){
                    $('.modal-give').css("display","none");
                });
                            }
             })
    });
</script>
@endsection
