<?php
require_once 'api/Comum.php';
require_once 'api/BDSingleton.php';

$con = BDSingleton::getConexao();

session_start();
if (!isset($_SESSION) || !isset($_SESSION['logado']) || $_SESSION['logado'] != true) {
  header("location: ./index.php"); // Vai pro inicio
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <title>Home</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="css/nav.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>

<body>

  <nav class="navbar navbar-icon-top navbar-expand-lg navbar-dark navbar-custom">
    <a class="navbar-brand" href="#">Rede Social</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <form class="form-inline my-2 my-lg-0">
          <input class="form-control mr-sm-2" type="text" placeholder="Pesquisar..." aria-label="Search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
        </form>
      </ul>

      <ul class="navbar-nav ">
        <li class="nav-item active">
          <a class="nav-link" href="home.php">
            <i class="fa fa-home"></i>
            Página Inicial
            <span class="sr-only">(current)</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">
            <i class="fa fa-users">
            </i>
            Amigos
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">
            <i class="fa fa-bell">
            </i>
            Solicitações
          </a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-user">
            </i>
            Opções
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="#">Perfil</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="logout.php">Sair</a>
          </div>
        </li>
      </ul>
    </div>
  </nav>


  <div class="wrapper">
    <div class="set-1">

      <div class="card-set-1" id="user">
        <span class="card"><i class="fa fa-users"></i></span>
        <p>Amigos</p>
        <button onclick="location.href='./friends.php'" class="cardb">Vizualizar Amigos</button>
      </div>

      <div class="card-set-1" id="msg">
        <span class="card"><i class="fa fa-envelope"></i></span>
        <p>Mensagens</p>
        <button onclick="location.href='./messages.php'" class="cardb">Buscar</button>
      </div>

      <div class="card-set-1" id="post">
        <span class="card"><i class="fa fa-sticky-note"></i></span>
        <p>Postagens</p>
        <button class="cardb" onclick="location.href='post.php'">Publicar</button>
      </div>

    </div>
  </div>

</body>

</html>
