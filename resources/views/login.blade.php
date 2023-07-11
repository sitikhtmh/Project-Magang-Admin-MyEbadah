<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->


<html>
    <head>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <link rel="stylesheet" href="assets/css/login.css">
    </head>

<body id="LoginForm" >
    <!-- HEADER -->
    <div class="top">
        <div class="logo float-left">
            <a style="width:100%;" href="{{asset('/')}}"><img class="logo" src="{{asset('assets/images/logo.png')}}"></a>
        </div>
    </div>

    <div class="yellow">
    </div>
    <div class="green">
    </div>
    <div class="bg-img">
        <div class="container">
            <div class="login-form">
                <div class="main-div">
                    <div class="panel">
                        <h2>Admin MyEbadah</h2>
                        <p>Universitas Muhammadiyah Yogyakarta</p>
                    </div>
                    <form style="width:100%;"  action="/login/success" method="POST">
                        {{csrf_field()}}
                        <div class="form-group">
                            <input type="text" class="form-control"  placeholder="Username" name="username">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" id="inputPassword" placeholder="Password" name="password">
                        </div>
                        <button type="submit" class="btn btn-primary">Login</button>
                        <!-- <a class="btn btn-primary" href="/dashboard" role="button">Login</a> -->
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <footer class="page-footer">
        <div class="footer-copyright text-center py-3">© 2020 Copyright:
            <a href="https://umy.ac.id"> Universitas Muhammadiyah Yogyakarta</a>
        </div>
        <div class="footer-red">
        </div>
    </footer>
</body>
</html>
