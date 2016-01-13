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

        <title><?php echo $titulo_sistema; ?></title>

        <!-- Bootstrap core CSS -->
        <link href="recursos/css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="recursos/css/offcanvas.css" rel="stylesheet">

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
        <div class="navbar navbar-fixed-top navbar-inverse" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Ver Menu</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.php" style="margin-top: -10px;">
                        <img src="recursos/img/fav_mamut.png" style="width:45px;height:45px;"/>
                        <?php echo $titulo_sistema; ?>
                    </a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="index.php"> Hola, <?php echo $_COOKIE["nombre_usuario"]; ?></a></li>
                        <li><a href="logout_sistema.php"> Salir</a></li>
                    </ul>
                </div><!-- /.nav-collapse -->
            </div><!-- /.container -->
        </div><!-- /.navbar -->

        <div class="container">
            <div class="row row-offcanvas row-offcanvas-right">
                <div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">
                    <div class="list-group">
                        <?php include_once('navbar_sistema.php'); ?>
                    </div>
                </div><!--/span-->
                <div class="col-xs-12 col-sm-9">
                    <p class="pull-right visible-xs">
                        <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Ver Menu</button>
                    </p>
                    <img src="recursos/img/landing.jpg" style="width: 100%;"/>
                </div><!--/row-->

                <hr>

            </div><!--/.container-->
            <div style="width:100%;">
            <footer>
                <p><?php echo $titulo_sistema; ?> - 2015</p>
            </footer>
            </div>
        </div>

        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="recursos/js/jquery.js"></script>
        <script src="recursos/js/bootstrap.min.js"></script>
        <script src="recursos/js/offcanvas.js"></script>
    </body>
</html>