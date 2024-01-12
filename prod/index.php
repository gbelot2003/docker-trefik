<?php
include "php/config.php";
include "php/mysqli.php";
include "php/general.php";

$idRegistro = isset($_GET["x"]) ? $_GET["x"] : "0";
$modoLogin = "login";
$nombre = "";
$apellido = "";
$nombreMostrar = "";
session_start();
if (isset($_SESSION['idCuenta'])) {
  exit(header("Location:account.php"));
} else {
  if ($idRegistro != "0") {
    $query = "SELECT * FROM z__cuentas WHERE md5(idRegistro)='$idRegistro'";
    $result = $mysqli->query($query);
    $cuenta = mysqli_fetch_object($result);
    $nombre = $cuenta->primerNombre;
    if ($cuenta->activa == 0) {
      $modoLogin = "passwordNuevo";
    } elseif ($cuenta->cambioClave == 1) {
      $modoLogin = "password";
    }
    if ($cuenta->tipoPersona == "J") {
      $query = "SELECT * FROM z__personas WHERE idCuenta=$cuenta->idRegistro and codigoCargo=1";
      $result = $mysqli->query($query);
      $repleg = mysqli_fetch_object($result);
      $nombreMostrar = "$repleg->primerNombre $repleg->segundoNombre $repleg->primerApellido $repleg->segundoApellido";
    } else {
      $nombreMostrar = "$cuenta->primerNombre $cuenta->segundoNombre $cuenta->primerApellido $cuenta->segundoApellido";
    }
  }
}
$mysqli->close();
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <title>
    SuFacturaDigital | Ingresa a tu cuenta
  </title>
  <link href="img/favicon/favicon-96x96.png" type="image/gif" sizes="96x96" rel="icon">
  <!-----------https://www.seools.com/generador-meta-tag---->
  <meta name="title" content="">
  <meta name="description" content="">
  <meta name="keywords" content="">
  <meta name="robots" content="index, follow">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta name="revisit-after" content="10 days">
  <meta name="author" content="Sufactura">
  <meta http-equiv="cache-control" content="no-cache" />
  <!--------------------COMPATIBILIDAD------------------>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!--------------------OTROS------------------>
  <meta name="mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-capable" content="yes" />
  <!--------------------FONTS------------------>
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Caveat&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
  <!--------------------SOCIAL------------------>
  <!--..............NO HAY SOCIAL--------------->
  <!------------------STYLES--------------------->
  <!--<link href="assets/css/<?php //echo $min;?>test.css" rel="stylesheet" type="text/css" />-->
  <link href="css/sb-admin-2.css" rel="stylesheet" type="text/css" />
  <link href="css/styles.css" rel="stylesheet" type="text/css" />
  <link href="css/todos.css" rel="stylesheet" type="text/css" />
  <!--<link href="css/test.less" rel="stylesheet/less" type="text/css" />-->
  <script>
    var idRegistro = "<?php echo $idRegistro; ?>";
    var modoLogin = "<?php echo $modoLogin; ?>";
  </script>
  <script src="js/l-jquery.js"></script>
  <script src="js/a-login.js"></script>
  <script src="js/a-general.js"></script>
  <script src="js/l-popper.js"></script>
  <script src="js/l-bootstrap.js"></script>
  <script src="js/l-confirmation.js"></script>
  <script src="js/l-bootstrap4-toggle.js"></script>
  <!--<script src="assets/animaciones/final.js"></script>
<script src="assets/js/<?php //echo $min;?>l-lottie.js"></script>-->
  <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallbackLogin&render=explicit"></script>
  <script src="https://kit.fontawesome.com/7888d86d0a.js" crossorigin="anonymous"></script>
</head>

<body id="login" class="htmlWEB">
  <?php //include "/includes/contenido/animacion.php";?>
  <div class="contenido-wrapper lightgray">
    <?php //include "/includes/contenido/header.php";?>
    <br> <br>
    <div class="container" id="recuadroPrincipalLogin">
      <div class="row">
        <div class="col-md-12">
          <div id="logoSecundario">
            <img class="img-fluid logo_image" src="img/suFacturaLogIndex.png" alt="SuFactura">
          </div>
        </div>
        <div class="col-md-12">
          <?php include "includes/login/register.php"; ?>
          <?php include "includes/login/login.php"; ?>
          <?php include "includes/login/restore.php"; ?>
          <?php include "includes/login/password.php"; ?>
          <?php include "includes/login/passwordNuevo.php"; ?>
          <?php //include "includes/login/finish.php";?>
          <?php include "includes/login/cerrar.php"; ?>
          <?php include "includes/login/regresar.php"; ?>
          <?php include "includes/login/getPin.php"; ?>
          <?php include "includes/login/loginPin.php"; ?>
          <?php include "includes/login/loginNuevo.php"; ?>
          <?php include "includes/login/activar.php"; ?>
          <div class="hide">
            <a class="small" id="ver-login" data-toggle="collapse" href="#collapseLogin">Login</a>
            <a class="small" id="ver-register" data-toggle="collapse" href="#collapseRegister">Register</a>
            <a class="small" id="ver-restore" data-toggle="collapse" href="#collapseRestore">Restore</a>
            <a class="small" id="ver-password" data-toggle="collapse" href="#collapsePassword">Password</a>
            <a class="small" id="ver-passwordNuevo" data-toggle="collapse" href="#collapsePasswordNuevo">Password</a>
            <a class="small" id="ver-finish" data-toggle="collapse" href="#collapseFinish">Finish</a>
            <a class="small" id="ver-cerrar" data-toggle="collapse" href="#collapseCerrar">Cerrar</a>
            <a class="small" id="ver-regresar" data-toggle="collapse" href="#collapseRegresar">Regresar</a>
            <a class="small" id="ver-loginNuevo" data-toggle="collapse" href="#collapseLoginNuevo">LoginNuevo</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
<?php include 'includes/modals/cuentas/tratamientoDatos.php'; ?>

</html>
<script>
  $(window).on('load', function () {
    cargarScriptsLogin()
  })
  $(window).ready(function () {
    $("input").focus(function () {
      $(this).prop('readonly', false);
    })
    $(".nocaracteres").on('input', function (evt) {
      $(this).val(jQuery(this).val().replace(/[^a-zA-Z0-9ñÑ áÁéÉíÍóÓúÚ&.]/gi, ''));
    });
    $(".nocaracteresrazon").on('input', function (evt) {
      $(this).val(jQuery(this).val().replace(/[^a-zA-Z0-9ñÑ áÁéÉíÍóÓúÚ&.]/gi, ''));
    });
  })
  $("[data-toggle=tooltip]").tooltip({});
</script>