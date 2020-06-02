<?php
	require_once 'api/Comum.php';
	require_once 'api/BDSingleton.php';

	$con=BDSingleton::getConexao();

	session_start();
	if( !isset($_SESSION) || !isset($_SESSION['logado']) || $_SESSION['logado'] != true ) {
		header("location: ./index.php"); // Vai pro inicio
	}	
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <title>Home</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="css/post.css">
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
<div class="newPost">
  <h3>Nova Publicação</h3>
  <div class="toolbar">
    <button type="button" data-func="bold"><i class="fa fa-bold"></i></button>
    <button type="button" data-func="italic"><i class="fa fa-italic"></i></button>
    <button type="button" data-func="underline"><i class="fa fa-underline"></i></button>
    <button type="button" data-func="justifyleft"><i class="fa fa-align-left"></i></button>
    <button type="button" data-func="justifycenter"><i class="fa fa-align-center"></i></button>
    <button type="button" data-func="justifyright"><i class="fa fa-align-right"></i></button>
    <button type="button" data-func="insertunorderedlist"><i class="fa fa-list-ul"></i></button>
    <button type="button" data-func="insertorderedlist"><i class="fa fa-list-ol"></i></button>
    <div class="customSelect">
      <select data-func="fontname">
        <optgroup label="Serif Fonts">
          <option value="Bree Serif">Bree Serif</option>
          <option value="Georgia">Georgia</option>
           <option value="Palatino Linotype">Palatino Linotype</option>
          <option value="Times New Roman">Times New Roman</option>
        </optgroup>
        <optgroup label="Sans Serif Fonts">
          <option value="Arial">Arial</option>
          <option value="Arial Black">Arial Black</option>
          <option value="Asap" selected>Asap</option>
          <option value="Comic Sans MS">Comic Sans MS</option>
          <option value="Impact">Impact</option>
          <option value="Lucida Sans Unicode">Lucida Sans Unicode</option>
          <option value="Tahoma">Tahoma</option>
          <option value="Trebuchet MS">Trebuchet MS</option>
          <option value="Verdana">Verdana</option>
        </optgroup>
        <optgroup label="Monospace Fonts">
          <option value="Courier New">Courier New</option>
          <option value="Lucida Console">Lucida Console</option>
        </optgroup>
      </select>
    </div>
    <div class="customSelect">
      <select data-func="formatblock">
        <option value="h1">Heading 1</option>
        <option value="h2">Heading 2</option>
        <option value="h4">Subtitle</option>
        <option value="p" selected>Paragraph</option>
      </select>
    </div>
  </div>
  <form action="post.php" method="POST">
    <textarea maxlength="300" id="conteudo" name="conteudo" class="editor"></textarea>
    <div class="buttons">

    <script>
      function clearContents() {
        document.getElementById("conteudo").value = '';
      }
    </script>

    <button onclick="clearContents();" data-func="clear" type="button">Limpar</button>
    <button data-func="save" class="button" type="submit" name="publicar" value="insert">Publicar</button>
  </div>
  </form>
</div>
    </div>

</body>
</html>

<?php
    require_once "api/BDSingleton.php";
    require_once "api/Comum.php";

    if (isset($_POST["conteudo"])) {
      $con = BDSingleton::getConexao();
      $postagem = $_POST['conteudo'];
      $idUsuario =  $_SESSION['id'];
  
      $resposta = bd_adicionar_post($con, $idUsuario, $postagem);
      
      if ($resposta == 1) {
        echo "<script> alert('Postagem feita com sucesso!') </script>
        <meta http-equiv='refresh' content=0.1;url='home.php'>";
      } else {
        echo "<script> alert('Não foi possível realizar a postagem.!') </script>
        <meta http-equiv='refresh' content=0.1;url='post.php'>";
      }
    }
?>