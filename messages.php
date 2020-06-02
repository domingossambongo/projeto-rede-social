<?php
require_once './api/Comum.php';
require_once './api/BDSingleton.php';

$con = BDSingleton::getConexao();

session_start();
if (!isset($_SESSION) || !isset($_SESSION['logado']) || $_SESSION['logado'] != true) {
  header("location: ./index.php"); // Vai pro inicio
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="css/nav.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <link rel="stylesheet" href="./css/inner/messages.css">
  <title>Messages Screen</title>
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

      <div class="card-messages" id="user">
        <?php
        require('./database/index.php');

        // $test = get_messages($con, '9');
        // $sql = "SELECT * FROM messages";
        $sql = "SELECT * FROM usuario JOIN messages as msg ON usuario.id = msg.user_id";
        $query = mysqli_query($link, $sql);

        while ($set = mysqli_fetch_array($query)) {
          $index = $set['id'];
          echo
            "
            <div id='message-group'>
              <header>
                <strong>" . $set['nome'] . "</strong>
              </header>
              <div id='body-group'>
                <span>" . $set['title'] . "%</span>
                <p>" . $set['body'] . " R$</p>
              </div>
            </div>
          ";
        }
        ?>
      </div>


    </div>
  </div>

</body>

</html>
