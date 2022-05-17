<nav>
    <img src="/assets/img/LogoAltaMedia.png" alt="logo" class="dashboard-logo">
    @if (!empty(Session::get('UserId')))
    <a href="{{ route('dashboard') }}" class="nav-item @if (isset($isDashboard))active @endif"><i class="material-icons">dashboard</i> <p>Dashboard</p></a>
    <a href="{{ route('equipment') }}" class="nav-item @if (isset($isEquipment)) active @endif"> <i class="material-icons">desktop_windows</i> <p>Thiết bị</p></a>
    <a href="{{ route('service') }}" class="nav-item @if (isset($isService))active @endif"> <i class="material-icons">question_answer</i> <p>Dịch vụ</p></a>   
    @endif
    <a href="{{ route('givenumber') }}" class="nav-item @if (isset($isGivenumber))active @endif"> <i class="fas fa-layer-group"></i> <p>Cấp số</p></a>
    @if (!empty(Session::get('UserId')))
    <a href="{{ route('report') }}" class="nav-item @if (isset($isReport))active @endif"> <i class="fas fa-chart-bar"></i> <p>Báo cáo</p></a>
    <div id="installSystem" class="nav-item @if (isset($isInstall))active @endif""> <i class="material-icons">settings</i> <p>Cài đặt hệ thống<i class="fa fa-navicon"></i></p>
    <div class="installDropdown">
        <a href="{{ route('rule.management') }}" class="installDropdown-items @if (!empty($isRule)) active-2 @endif">Quản lý vai trò</a>
        <a href="{{ route('account') }}" class="installDropdown-items @if (!empty($isAccount)) active-2 @endif">Quản lý tài khoản</a>
        <a href="{{ route('diary') }}" class="installDropdown-items @if (!empty($isDiary)) active-2 @endif">Nhật ký người dùng</a>
    </div>
</div>
    <a href="{{ route('logout') }}" class="logout"> <i class="fas fa-sign-out-alt"></i> Đăng Xuất</a>
    @endif
</nav>

    @if (!empty(Session::get('UserId')))
    <a  class="anoun-bell" href="#"><i class="fas fa-bell"></i>
        <div class="dropbox ">
            <div class="dropbox content">Thông báo</div>
            <div class="dropbox item">   
                <div class=" dropbox item items"> 
                    <p>Người dùng: Lê Công Tiến</p>
                    <span>Thời gian nhận số: 12h20 ngày 30/11/2022</span>
                    <hr/>
                </div>
            </div>
            
    </div></a>
    <img class ="img-profile" src="/assets/img/{{ Session::get('Avatar') }}" alt="avatar">
    <div class="title-2">
        <p>Xin Chào</p>
        <a href="{{ route('admin.info',['id' => Session::get('UserId')]) }}">Lê Công Tiến</a>
    </div>
    @endif