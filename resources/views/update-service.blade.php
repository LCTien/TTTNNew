@extends('layout.layout')
@extends('layout.navbar')
@section('content')
<div class="main-title">Dịch vụ > Danh sách dịch vụ  ><span class="orange strong"> Cập nhật dịch vụ </span></div>
<p class="component-title strong">Quản lý dịch vụ</p>
<div class="container bg-white h-400">
    <div class="form-title">Thông tin thiết bị</div>
    <form action="{{ route('update.service') }}" class="form-group" method="POST">
        @csrf
        <input type="hidden" name="oldCode" value="{{ $item[0]->Code }}">
        <input type="hidden" name="oldName" value="{{ $item[0]->name }}">
        <div class="form-control2">
            <label for="code">Mã dịch vụ: <span class="fire">*</span></label>
            <input type="text" name="code" placeholder="Nhập mã dịch vụ" value="{{ $item[0]->Code }}">
        </div>
        <div class="form-control2 margin-left20">
            <label for="code">Mô tả:</label>
           <input type="text" name="description" style="height: 132px" placeholder="Mô tả dịch vụ" value="{{ $item[0]->description }}">
        </div>
        <div class="form-control2 " style="top: -78px">
            <label for="name">Tên dịch vụ: <span class="fire">*</span></label>
            <input type="text" name="name" placeholder="Nhập tên dịch vụ" value="{{ $item[0]->name }}">
        </div> 
        <div class="get-number-rule">
            <div class="rule-title">Quy tắc cấp số</div>
            <div class="rule">
                <input type="checkbox" name="auto_incre" @if ($item[0]->auto_incre != "") checked="" @endif id="auto-increm">
                <p>Tự động tăng từ</p>
                <input type="text" value="{{ $startvalue }}" name="start_value">
                <span>đến</span>
                <input type="text" value="{{ $endvalue }}" name="end_value">
            </div>
            <div class="rule">
                <input type="checkbox" name="prefix" @if ($item[0]->prefix != "") checked="" @endif id="Prefix">
                <p>Prefix</p>
                <input type="text" value="@if ($item[0]->prefix != "") {{ $item[0]->prefix }} @else 0001 @endif" name="prefix_value">
            
            </div>
            <div class="rule">
                <input type="checkbox" name="surfix" @if ($item[0]->surfix != "") checked="" @endif id="Surfix">
                <p>Surfix</p>
                <input type="text" value="@if ($item[0]->surfix != "") {{ $item[0]->surfix }} @else 0001 @endif" name="surfix_value">
            </div>
            <div class="rule">
                <input type="checkbox"  @if ($item[0]->reset_everyday != "") checked="" @endif name="reset" id="reset">
                <p>Reset mỗi ngày</p>
            </div>
            <div class="form-control2">
                <p><span class="fire relative">*</span>là trường thông tin bắt buộc</p>
            </div>
        </div>
            <div class="form-buttons">
                <a class="denie-button" href="{{ route('service') }}">Hủy bỏ</a>
                <button type="submit" class="continue-button">Cập nhật</button>
            </div>
        </form>
        <script>
            $(document).ready(function(){
                if($("#reset").checked(function(){
                    console.log($("#reset").value);
                }))
            });
        </script>
</div>
@endsection
