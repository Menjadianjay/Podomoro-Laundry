
    <div class="sidebar">
        <a class="navbar-brand" href="dashboard">
            <img src="{{ asset('img/logo.png') }}" style="width: 200px; height: auto; display: block;">
        </a>

        <br><br>
        <a href="dashboard"><i></i>Dashboard</a>
        <a href="inputdata"><i class="fas fa-plus"></i> Enter Transaction</a>
        <a href="viewdata"><i class="fas fa-file-alt"></i> View Transactions</a>
        <a href="presensi"><i class="fas fa-edit"></i>Staff Attendance</a>
        <a href="viewpresensi"><i class="fas fa-calendar-alt"></i> View Attendance</a>
        <a href="inputlayanan"><i class="fas fa-plus"></i> Add Service</a>
        <a href="viewlayanan"><i class="fas fa-eye"></i> View Service Rates</a>
        <form method="POST" action="{{ route('logout') }}" id="logout-form">
            @csrf
            <a href="#" onclick="document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
        </form>
    </div>
