<html>

<head>
    <title>Login for Dashboard Admin</title>
    @include('inc.link')
    <link rel="stylesheet" href="{{asset('css/login-style.css')}}">
</head>

<body>
    <section id="login">
        <div class="row">
            <div class="col-lg-7">
                <img src="{{asset('img/website/kiri-login.png')}}" class="img-fluid">
            </div>
            <div class="col-lg-5">
                <div class="container">
                    <form method="POST" action="/admin/login/check" class="isi-form">
                        @csrf
                        <img src="{{asset('img/website/logo.png')}}" class="logo">
                        <h1>Selamat Datang !</h1><br>
                        <span class="isi">Login Dashboard Admin</span><br>
                        <div class="message"> @include('message')</div>
                        @csrf
                        <div class="isian">
                            <label class="sr-only" for="UsernameLabel">Username</label>
                            <div class="input-group mb-2 mr-sm-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fas fa-user-friends"></i></div>
                                </div>
                                <input type="text" class="form-control" name="username"
                                    placeholder="Enter your username" id="UsernameLabel">
                            </div>
                            <label class="sr-only" for="PasswordLabel">Password</label>
                            <div class="input-group mb-2 mr-sm-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fas fa-lock"></i></div>
                                </div>
                                <input type="password" class="form-control" name="password"
                                    placeholder="Enter your Password" id="PasswordLabel">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>

</html>
