<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name=viewport content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="OSCAR DE SALES YORDI">

    <title>JVCR acceso</title>

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	
	<!-- Custom CSS -->


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	
	<style>
	#accessformcontainer{height: 50%; position: absolute; top: 25%; width:100%; }
	</style>
</head>
<body>
    <div class="container" id="accessformcontainer">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default" >
                    <div class="panel-heading">
                        <h3 class="panel-title">Acceso</h3>
                    </div>
                    <div class="panel-body">
						 <form role="form" action="index_sesion2.php" method="post" > <!--PARA SITIO LOCAL -->
                    <!--    <form role="form" action="https://jetvan.mx/jetvan/app/index_sesion2.php" method="post" >  PARA WEB -->
                            <fieldset>
							
									<p> <?php if (@$_GET['errorusuario']=="si"){ ?> 
									<span style="color:#ffffff;background:#D62738"><b>Datos incorrectos</b></span>
									<?php }else{ ?>
									Anota tus datos
									<?php }?>
									</p>
							
                                <div class="form-group">
                                    <input class="form-control" placeholder="email" name="usuario" type="email" >
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="clave" name="clave" type="password" >
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
								<div class="form-group">
								<input type="submit" class="btn btn-lg btn-success btn-block" value="Entrar">
                               	</div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>