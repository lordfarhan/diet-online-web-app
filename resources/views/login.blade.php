<html>

<head>
    <title>Login for Dashboard Admin</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.min.js">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
</head>

<style>
    body {
        background-color: #f5f5f5;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    #message {
        margin-top: 2.5rem;
    }

    #login {
        min-width: 300px;
        max-width: 1080px;
        margin: auto;
        background-color: white;
        border-radius: 5px;
        padding-bottom: 10px;
        padding-top: 10px;
        padding-left: 10px;
        padding-right: 10px;
    }

</style>

<body>
    <section id="message">
        <div class="container">
            @include('message')
            
        </div>
    </section>

    <section id="login">
        <div class="container">
            <a href="#" class="btn btn-info">Back</a>
            <h1>Login</h1>
            <small>Login for DION Admin</small>
            <br> <br>
            <form method="POST" action="/admin/login/check">
                @csrf
                <div class="form-group">
                    <label for="username">User Name</label>
                    <input type="text" class="form-control" id="username" name="username" aria-describedby="username"
                        placeholder="Enter your username">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password"
                        placeholder="Enter your Password">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </section>
</body>

</html>

{{-- 
Notes : 
Protecting Routes
Session Login
Log Out 
--}}
