<?php include_once "../controller/funcoes.php";?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link src="../assets/css/css.css">

    <script type="text/javascript" src="../assets/js/funcoes.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    <script src="https://apis.google.com/js/platform.js" async defer></script>
    <meta name="google-signin-client_id" content="299120802998-evcs4l967da28bb128oki364hfuasjvd.apps.googleusercontent.com">

    <title>Login com Rede Social</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="../assets/css/login.css" rel="stylesheet">
  </head>
  
  <body class="text-center">

    <?php include "components/navbar/navbar.php" ?>;

    <form class="form-signin">
      <img class="mb-4" src="https://getbootstrap.com/docs/4.2/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
      <h1 class="h3 mb-3 font-weight-normal">Identifique-se!</h1>
      <?php //flashMsg("warning");?>
      <?php //flashMsg("danger");?>

      <div id="mensagens"></div>

      <label for="email" class="sr-only">E-mail</label>
      <input type="email" id="email" name="email" class="form-control" placeholder="Endereço de e-mail" autofocus>
      
      <label for="senha" class="sr-only">Senha</label>
      <input type="password" name="senha" id="senha" class="form-control" placeholder="Informa a senha">
      
      <div class="checkbox mb-3">
        <label>
          <input type="checkbox" value="1" name="lembrar"> Lembrar de mim
        </label>
      </div>
      
      <button class="btn btn-lg btn-primary btn-block" type="button" id="bt_login" onclick="enviar()">Entrar</button>
      <p class="mt-5 mb-3 text-muted">&copy; 2017-2019</p>
      
      <span class="g-signin2" data-onsuccess="onSignIn"></span>
    </form>    
  </body>
</html>