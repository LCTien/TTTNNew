@extends('layout.layout')
@extends('layout.navbar')
@section('content')
<div class="main-title">Cài đặt hệ thống > Danh sách vai trò >  <span class="orange strong"> Thêm vai trò</span></div>
<p class="component-title strong">Thêm vai trò</p>
</div>
<div class="container bg-white h-400">
    <form action="{{ route('update.role') }}" class="form-group" method="POST">
        @csrf
        <input type="hidden" name="id" placeholder="Nhập tên vai trò" value="{{ $role[0]->id }}">
        <div class="form-control2">
            <label for="name">Tên vai trò: <span class="fire">*</span></label>
            <input type="text" name="name" placeholder="Nhập tên vai trò" value="{{ $role[0]->name }}" @if(isset($errName))style="border: 0.5px solid red" @endif>
        </div>
        <div class="list-function">
            <label for="roles">Phân quyền chức năng<span class="fire relative">*</span></label>
            <div class="list">
                <div class="item">
                    <label for="checkAll"> <input type="checkbox" name="All" value="Toàn quyền" id="checkAll"> Tất cả</label>
                </div>
                <p>Quản lý thiết bị</p>
                <div class="item">
                    <label for="allEquipt"> <input type="checkbox" name = "allEquipt" value="Toàn quyền quản lý thiết bị"> Tất cả</label>
                    
                </div>
                <div class="item">
                    <label for=""> <input type="checkbox" name = "roleEquipt[]" value="Thêm thiết bị"> Chức năng Thêm</label>
                </div>
                <div class="item">
                    <label for=""> <input type="checkbox" name="roleEquipt[]" value="Cập nhật thông tin thiết bị"> Chức năng Cập nhật</label>
                </div>
                <p>Quản lý Dịch vụ</p>
                <div class="item">
                    <label for="allService"> <input type="checkbox" name="allService" value="Toàn quyền quản lý dịch vụ"> Tất cả</label>
                </div>
                <div class="item">
                    <label for="roleService[]"> <input type="checkbox" name = "roleService[]" value="Thêm dịch vụ"> Chức năng Thêm</label>
                </div>
                <div class="item">
                    <label for="roleService[]"> <input type="checkbox" name="roleService[]" value="Cập nhật thông tin dịch vụ"> Chức năng Cập nhật</label>
                </div>
                <p>Quản lý Cấp số</p>
                <div class="item">
                    <label for="allGiveNumber"> <input type="checkbox" name="allGiveNumber" value="Toàn quyền quản lý Cấp Số"> Tất cả</label>
                </div>
                <div class="item">
                    <label for="roleGiveNumber[]"> <input type="checkbox" name="roleGiveNumber[]" value="Cấp số"> Chức năng Cấp số</label>
                </div>
                <p>Quản lý Vai trò</p>
                <div class="item">
                    <label for="allRule"> <input type="checkbox" name="allRule" value="Toàn quyền quản lý Vai trò"> Tất cả</label>
                </div>
                <div class="item">
                    <label for="roleRule[]"> <input type="checkbox" name = "roleRule[]" value="Thêm vai trò"> Chức năng Thêm</label>
                </div>
                <div class="item">
                    <label for="roleRule[]"> <input type="checkbox" name="roleRule[]" value="Cập nhật vai trò"> Chức năng Cập nhật</label>
                </div>
                <p>Quản lý Tài khoản</p>
                <div class="item">
                    <label for="allAccount"> <input type="checkbox" name="allAccount" value="Toàn quyền quản lý Tài khoản"> Tất cả</label>
                </div>
                <div class="item">
                    <label for="roleAccount[]"> <input type="checkbox" name = "roleAccount[]" value="Thêm tài khoản"> Chức năng Thêm</label>
                </div>
                <div class="item">
                    <label for="roleAccount[]"> <input type="checkbox" name="roleAccount[]" value="Cập nhật tài khoản"> Chức năng Cập nhật</label>
                </div>
            </div>
        </div>
        <div class="form-control2">
            <label for="description">Mô tả:</label>
           <input name="description"type="text" style="height: 132px" placeholder="Mô tả vai trò"  value="{{ $role[0]->description }}">
        </div>
        <input type="hidden" name="powers" value="{{ $role[0]->powers }}" id="power">
        <div class="form-control2">
            <p><span class="fire relative">*</span>là trường thông tin bắt buộc</p>
        </div>
            <div class="form-buttons">
                <a class="denie-button" href="{{ route('rule.management') }}">Hủy bỏ</a>
                <button type="submit" class="continue-button">Cập nhật</button>
            </div>
        </form>
</div>
<script>
    $(document).ready(function ()
    {
        flag = 0;
        var listPower = [];

        var checkboxAll = $('#checkAll');
        var allCheckbox = $('input[type="checkbox"]');
    
        var equiptAll = $('input[name="allEquipt"]');
        var equipPowers = $('input[name="roleEquipt[]"]');

        var serviceAll = $('input[name="allService"]');
        var servicePowers = $('input[name="roleService[]"]');

        var givenumberAll = $('input[name="allGiveNumber"]');
        var givenumberPowers = $('input[name="roleGiveNumber[]"]');

        var ruleAll = $('input[name="allRule"]');
        var rulePowers = $('input[name="roleRule[]"]');

        var accountAll = $('input[name="allAccount"]');
        var accountPowers = $('input[name="roleAccount[]"]');

        var power = document.getElementById('power');
        checkboxAll.change(function ()
        {
            flag = 0;
            var isChecked = $(this).prop('checked');
            allCheckbox.prop('checked',isChecked);
            listPower.push("Toàn quyền");
            power.value = "Toàn quyền";
            if(!isChecked)
            {
                flag = 1;
                listPower = [];
            }
            console.log(power.value);
        });
        equiptAll.change(function ()
        {
            var isChecked = $(this).prop('checked');
            equipPowers.prop('checked',isChecked);
            var listBox = $('input[name="roleEquipt[]"]:checked');
            for(var i = 0; i < listBox.length; i++)
                {
                   listPower.push(listBox[i].value);
                }
            if(!isChecked)
            {
                checkboxAll.prop('checked',isChecked);
                for(var i = 0; i < listBox.length; i++)
                {
                    listPower = listPower.filter(e => e != listBox[i].value);
                }
            }
                
        });
        serviceAll.change(function ()
        {
            var isChecked = $(this).prop('checked');
            servicePowers.prop('checked',isChecked);
            var listBox = $('input[name="roleService[]"]:checked');
            for(var i = 0; i < listBox.length; i++)
                {
                   listPower.push(listBox[i].value);
                }
            if(!isChecked)
            {
                checkboxAll.prop('checked',isChecked);
                for(var i = 0; i < listBox.length; i++)
                {
                    listPower = listPower.filter(e => e != listBox[i].value);
                }
            }
        });
        givenumberAll.change(function ()
        {
            var isChecked = $(this).prop('checked');
            givenumberPowers.prop('checked',isChecked);
            var listBox = $('input[name="roleGiveNumber[]"]:checked');
            for(var i = 0; i < listBox.length; i++)
                {
                   listPower.push(listBox[i].value);
                }
            if(!isChecked)
            {
                checkboxAll.prop('checked',isChecked);
                for(var i = 0; i < listBox.length; i++)
                {
                    listPower = listPower.filter(e => e != listBox[i].value);
                }
            }
        });
        ruleAll.change(function ()
        {
            var isChecked = $(this).prop('checked');
            rulePowers.prop('checked',isChecked);
            var listBox = $('input[name="roleRule[]"]:checked');
            for(var i = 0; i < listBox.length; i++)
                {
                   listPower.push(listBox[i].value);
                }
            if(!isChecked)
            {
                checkboxAll.prop('checked',isChecked);
                for(var i = 0; i < listBox.length; i++)
                {
                    listPower = listPower.filter(e => e != listBox[i].value);
                }
            }
        });
        accountAll.change(function ()
        {
            var isChecked = $(this).prop('checked');
            accountPowers.prop('checked',isChecked);
            var listBox = $('input[name="roleAccount[]"]:checked');
            for(var i = 0; i < listBox.length; i++)
                {
                   listPower.push(listBox[i].value);
                }
            if(!isChecked)
            {
                checkboxAll.prop('checked',isChecked);
                for(var i = 0; i < listBox.length; i++)
                {
                    listPower = listPower.filter(e => e != listBox[i].value);
                }
            }
        });
        allCheckbox.change(function(){
            var isChecked = $(this).prop('checked');
            var value = $(this).val();
            var isCheckEquiptAll = equipPowers.length === $('input[name="roleEquipt[]"]:checked').length;
                equiptAll.prop('checked', isCheckEquiptAll);
                
                var isCheckServiceAll = servicePowers.length === $('input[name="roleService[]"]:checked').length;
                serviceAll.prop('checked', isCheckServiceAll);
                
                var isCheckGivenumberAll = givenumberPowers.length === $('input[name="roleGiveNumber[]"]:checked').length;
               givenumberAll.prop('checked', isCheckGivenumberAll);
                
                var isCheckRuleAll = rulePowers.length === $('input[name="roleRule[]"]:checked').length;
               ruleAll.prop('checked', isCheckRuleAll);
                
                var isCheckAccountAll = accountPowers.length === $('input[name="roleAccount[]"]:checked').length;
                accountAll.prop('checked', isCheckAccountAll);
            if(isChecked == true && value != "Toàn quyền")
            {
                var isCheckAll = (allCheckbox.length) == ($('input[type=checkbox]:checked').length + 1);
                checkboxAll.prop('checked', isCheckAll);
                var listBox = $('input[type="checkbox"]:checked');
                console.log(listBox);
                power.value = "";
                for(var i = 0; i < listBox.length; i++)
                {
                    if(!listBox[i].value.includes("Toàn"))
                    {
                        if(power.value == '')
                        {
                            power.value = listBox[i].value;
                        }
                        else
                        {
                            power.value += ", " + listBox[i].value;
                        }
                    }
                }
                console.log(power.value);
                if(checkboxAll.prop('checked'))
            {
                listPower = [];
                listPower.push("Toàn quyền");
                power.value = "Toàn quyền";
                console.log(power.value);
            }
            }
            else if(value != "Toàn quyền"){
                flag = 0;
                checkboxAll.prop('checked', isChecked);
                listPower = listPower.filter(e => e != value);
                var listBox = $('input[type="checkbox"]:checked');
                power.value = "";
                for(var i = 0; i < listBox.length; i++)
                {
                    if(!listBox[i].value.includes("Toàn"))
                    {
                        if(power.value == '')
                        {
                            power.value = listBox[i].value;
                        }
                        else
                        {
                            power.value += ", " + listBox[i].value;
                        }
                    }
                        
                }
                console.log(power.value);
            }
                 
        });
        for(var i = 0; i < allCheckbox.length; i++)
        {
                if(power.value.includes(allCheckbox[i].value))
                allCheckbox[i].checked = true;
        }
        if(checkboxAll.prop('checked'))
        {
            allCheckbox.prop('checked',true);
        }
        else
        {
            var isCheckAll = (allCheckbox.length) == ($('input[type=checkbox]:checked').length + 1);
                checkboxAll.prop('checked', isCheckAll);
                var isCheckEquiptAll = equipPowers.length === $('input[name="roleEquipt[]"]:checked').length;
                equiptAll.prop('checked', isCheckEquiptAll);
                
                var isCheckServiceAll = servicePowers.length === $('input[name="roleService[]"]:checked').length;
                serviceAll.prop('checked', isCheckServiceAll);
                
                var isCheckGivenumberAll = givenumberPowers.length === $('input[name="roleGiveNumber[]"]:checked').length;
               givenumberAll.prop('checked', isCheckGivenumberAll);
                
                var isCheckRuleAll = rulePowers.length === $('input[name="roleRule[]"]:checked').length;
               ruleAll.prop('checked', isCheckRuleAll);
                
                var isCheckAccountAll = accountPowers.length === $('input[name="roleAccount[]"]:checked').length;
                accountAll.prop('checked', isCheckAccountAll);
        }
                
    });
</script>
@endsection
