<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title> GV | @yield('title')</title>
  <link href={{ asset("assets/theme/vendor/fontawesome-free/css/all.min.css") }} rel="stylesheet" type="text/css">
  <link
    href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
    rel="stylesheet">
  <link href={{ asset("assets/css/main.css")}} rel="stylesheet">
  <link href={{ asset("assets/theme/css/sb-admin-2.css")}} rel="stylesheet">
  <link href={{ asset("assets/css/bootstrap-select.css")}} rel="stylesheet">
  <link rel="shortcut icon" href={{ asset('assets/img/favicon.ico') }}>
</head>

<body id="page-top">
  @yield('content')
  <script src={{ asset("assets/theme/vendor/jquery/jquery.min.js")}}></script>
  <script src={{ asset("assets/theme/vendor/bootstrap/js/bootstrap.bundle.min.js")}}></script>
  <script src={{ asset("assets/theme/vendor/jquery-easing/jquery.easing.min.js")}}></script>
  <script src={{ asset("assets/theme/js/sb-admin-2.min.js")}}></script>
  <script src={{ asset("assets/js/bootstrap-select.min.js")}}></script>
</body>

</html>