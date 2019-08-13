{{-- NAVBAR --}}
<nav class="navbar navbar-dark fixed-top flex-md-nowrap p-0 shadow-sm">
        <span class="nav-kiri">
            <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="/admin"><img src="{{asset('img/website/logo.png')}}"
                    id="icon"></a>
        </span>
        <input class="form-control form-control-light" type="text" placeholder="Search" aria-label="Search"
            id="search-box">
            <span class="notif-message">
                <ul class="list-inline">
                    <li class="list-inline-item icon">
                        <i class="fas fa-envelope"></i>
                    </li>
                    <li class="list-inline-item icon">
                        <i class="fas fa-bell"></i>
                    </li>
                </ul>
            </span>
        <span class="nav-kanan">
            <ul class="list-inline">
                <li class="list-inline-item">
                    <a class="nav-link" href="/admin/log-out" class="button" style="color:white">Log Out</a>
                </li>
            </ul>
        </span>
    </nav>