@extends('layout.layout')
@extends('layout.navbar')
@section('content')
<div class="main-title">Dịch vụ > Danh sách dịch vụ  ><span class="orange strong"> Thêm dịch vụ </span></div>
<p class="component-title strong">Quản lý dịch vụ</p>
<div class="container bg-white h-400">
    <div class="form-title">Thông tin thiết bị</div>
    <form action="{{ route('add.service') }}" class="form-group" method="POST">
        @csrf
        <div class="form-control2">
            <label for="code">Mã dịch vụ: <span class="fire">*</span></label>
            <input type="text" name="code" placeholder="Nhập mã dịch vụ">
        </div>
        <div class="form-control2 margin-left20">
            <label for="code">Mô tả:</label>
           <input type="text" style="height: 132px" placeholder="Mô tả dịch vụ" name ="description">
        </div>
        <div class="form-control2 " style="top: -78px">
            <label for="name">Tên dịch vụ: <span class="fire">*</span></label>
            <input type="text" name="name" placeholder="Nhập tên dịch vụ" >
        </div> 
        <div class="get-number-rule">
            <div class="rule-title">Quy tắc cấp số</div>
            <div class="rule">
                <input type="checkbox" name="auto_incre" id="auto-increm">
                <p>Tự động tăng từ</p>
                <input type="text" value="0001" name="start_value">
                <span>đến</span>
                <input type="text" value="9999" name="end_value">
            </div>
            <div class="rule">
                <input type="checkbox" name="prefix" id="Prefix">
                <p>Prefix</p>
                <input type="text" value="0001" name="prefix_value">
            
            </div>
            <div class="rule">
                <input type="checkbox" name="surfix" id="Surfix">
                <p>Surfix</p>
                <input type="text" value="0001" name="surfix_value">
            </div>
            <div class="rule">
                <input type="checkbox" name="reset" id="reset">
                <p>Reset mỗi ngày</p>
            </div>
            <div class="form-control2">
                <p><span class="fire relative">*</span>là trường thông tin bắt buộc</p>
            </div>
        </div>
            <div class="form-buttons">
                <a class="denie-button" href="{{ route('equipment') }}">Hủy bỏ</a>
                <button type="submit" class="continue-button">Thêm dịch vụ</button>
            </div>
        </form>
</div>
@endsection
