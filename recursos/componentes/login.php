<?php
$err = 0;
if (isset($_COOKIE['nombre_usuario'])) {
    header('Location: dashboard_sistema.php');
} else {
    if (isset($_REQUEST['user']) && isset($_REQUEST['pass'])) {
        include_once('nucleo/include/MasterConexion.php');
        $conn = new MasterConexion();
        $query = "Select * from usuarios where usuario = '" . $_REQUEST['user'] . "' AND clave = '" . $_REQUEST['pass'] . "' ";
        $res = $conn->consulta_arreglo($query);
        if ($res !== 0) {
            setcookie("nombre_usuario", $res["nombres"] . " " . $res["apellidos"]);
            setcookie("id_usuario", $res["id"]);
            setcookie("tipo_usuario", $res["tipo"]);
            header('Location: dashboard_sistema.php');
        } else {
            $err = 1;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="apple-touch-icon" sizes="57x57" href="recursos/img/fav/apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="recursos/img/fav/apple-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="recursos/img/fav/apple-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="recursos/img/fav/apple-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="recursos/img/fav/apple-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="recursos/img/fav/apple-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="recursos/img/fav/apple-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="recursos/img/fav/apple-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="recursos/img/fav/apple-icon-180x180.png">
        <link rel="icon" type="image/png" sizes="192x192"  href="recursos/img/fav/android-icon-192x192.png">
        <link rel="icon" type="image/png" sizes="32x32" href="recursos/img/fav/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="recursos/img/fav/favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="recursos/img/fav/favicon-16x16.png">
        <link rel="icon" href="recursos/img/fav/favicon.ico">
        <meta name="theme-color" content="#ffffff">

        <title>Inicio de Sesión</title>

        <!-- Bootstrap core CSS -->
        <link href="recursos/css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="recursos/css/signin.css" rel="stylesheet">

        <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
        <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
        <script src="recursos/js/ie-emulation-modes-warning.js"></script>

        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <script src="recursos/js/ie10-viewport-bug-workaround.js"></script>

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>

    <body>

        <div class="container">

            <form class="form-signin" role="form">
                <center>
                    <img src="recursos/img/logo_mamut.png"/>
                    <h2 class="form-signin-heading">Inicio de Sesión</h2>
                </center>
                <input type="text" class="form-control" placeholder="Usuario" required autofocus name='user'>
                <input type="password" class="form-control" placeholder="Contraseña" required name='pass'>
                <button class="btn btn-lg btn-primary btn-block" type="submit">Autenticar</button>
            </form>

        </div> <!-- /container -->


        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
    </body>
</html>

