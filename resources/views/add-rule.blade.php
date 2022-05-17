@extends('layout.layout')
@extends('layout.navbar')
@section('content')
<div class="main-title">Cài đặt hệ thống > Danh sách vai trò >  <span class="orange strong"> Thêm vai trò</span></div>
<p class="component-title strong">Thêm vai trò</p>
</div>
<div class="container bg-white h-400">
    <form action="{{ route('add.equipment') }}" class="form-group" method="POST">
        @csrf
        <div class="form-control2">
            <label for="code">Tên vai trò: <span class="fire">*</span></label>
            <input type="text" name="code" placeholder="Nhập tên vai trò">
        </div>
        <div class="list-function">
            <label for="code">Phân quyền chức năng<span class="fire relative">*</span></label>
            <div class="list">
                <p>Nhóm chức năng A</p>
                <div class="item">
                    <label for=""> <input type="checkbox"> Tất cả</label>
                    
                </div>
                <div class="item">
                    <label for=""> <input type="checkbox"> Chức năng A</label>
                </div>
                <div class="item">
                    <label for=""> <input type="checkbox"> Chức năng B</label>
                </div>
                <p>Nhóm chức năng B</p>
                <div class="item">
                    <label for=""> <input type="checkbox"> Tất cả</label>
                    
                </div>
                <div class="item">
                    <label for=""> <input type="checkbox"> Chức năng A</label>
                </div>
                <div class="item">
                    <label for=""> <input type="checkbox"> Chức năng B</label>
                </div>
            </div>
        </div>
        <div class="form-control2">
            <label for="code">Mô tả:</label>
           <input type="text" style="height: 132px" placeholder="Mô tả vai trò">
        </div>
        <div class="form-control2">
            <p><span class="fire relative">*</span>là trường thông tin bắt buộc</p>
        </div>
            <div class="form-buttons">
                <a class="denie-button" href="{{ route('equipment') }}">Hủy bỏ</a>
                <button type="submit" class="continue-button">Thêm thiết bị</button>
            </div>
            <input type="hidden" name="service" value="" id="service">
        </form>
</div>
@endsection
