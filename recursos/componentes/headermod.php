<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title><?php echo $titulo_pagina; ?></title>

        <!-- Bootstrap core CSS -->
        <link href="recursos/css/bootstrap.min.css" rel="stylesheet">
        <link href="recursos/css/bootstrap-overrides.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="recursos/css/offcanvas.css" rel="stylesheet">
        <link href="recursos/css/jquery-ui.css" rel="stylesheet">
        <link href="recursos/js/plugins/datatables/jquery-datatables.css" rel="stylesheet">

        <script src="recursos/js/ie-emulation-modes-warning.js"></script>

        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <script src="recursos/js/ie10-viewport-bug-workaround.js"></script>
    </head>

    <body style="padding-top:0px !important;">
        <div class="container" style="width:100%;">
        <div class="alert alert-danger alert-dismissable" style="display:none;" id="merror">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            Hubo un error, reintenta
        </div>
        <div class="alert alert-success alert-dismissable" style="display:none;" id="msuccess">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            Operación Completada con Éxito
        </div>
        <form role="form" id="frmall" class="form-horizontal">