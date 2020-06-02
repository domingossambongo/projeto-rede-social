<?php
//Classe Singleton de Conexão ao Banco - Reutilização do Código
abstract class BDSingleton
{

  static private $con;
  const dbname = "trabalho-rede-social";
  const dbip = "127.0.0.1";
  const dbuser = "root";
  const dbpass = "";

  public static function &getConexao()
  {

    if (self::$con == null) {
      try {
        // Atribui o objeto PDO à variável $INSTANCIA.
        self::$con = new PDO('mysql:host=' . self::dbip . ';dbname=' . self::dbname, self::dbuser, self::dbpass);
        // Garante que o PDO lance exceções durante erros.
        self::$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // Garante que os dados sejam armazenados com codificação UFT-8.
        self::$con->exec('SET NAMES utf8');
      } catch (PDOException $e) {
        die('Falha ao Conectar: ' . $e->getMessage());
      }
    }

    // Retorna a conexão.
    return self::$con;
  }
}

function bd_verificar_apelido_existe($con, $apelido)
{
  $sql = 'SELECT COUNT(*) as contador FROM usuario WHERE apelido ="' . $apelido . '"';
  $res = $con->query($sql)->fetchAll();

  $cont = $res[0]['contador'];

  return  $cont > 0;
}

function bd_verificar_email_existe($con, $email)
{
  $sql = 'SELECT COUNT(*) as contador FROM usuario WHERE email ="' . $email . '"';
  $res = $con->query($sql)->fetchAll();

  $cont = $res[0]['contador'];

  return  $cont > 0;
}

function bd_adicionar_usuario($con, $usuario)
{
  $sql = 'INSERT INTO usuario(email,nome,sobrenome,apelido,senha,dataIngresso,dataNascimento) VALUES
        ("' . $usuario['email'] . '","' . $usuario['nome'] . '","' . $usuario['sobrenome'] . '","' . $usuario['apelido'] . '","' . $usuario['senha'] . '","' . $usuario['dtIngres'] . '","' . $usuario['dtNasc'] . '")';

  $suc = $con->exec($sql);

  return $suc;
}

function bd_adicionar_post($con, $idUser, $postagem)
{
  $date = date('Y-m-d H:i:s');

  $sql = 'INSERT INTO postagem (id_user,conteudo,data) VALUES ("' . $idUser . '","' . $postagem . '","' . $date . '")';

  $suc = $con->exec($sql);

  return $suc;
}

function get_messages($con, $idUser)
{
  // se o user está logado. busca todas as mensagens
  if ($idUser) {
    $sql = 'SELECT * FROM  messages';
    $res = $con->query($sql);

    return $res;
  }

  return  "User not found";
}

// retorna todos os usuários cadastrados
function get_all_users($con)
{
  return $con->exec("SELECT * FROM usuario");
}

// função para adicionar amigo: user_logado e user_friend: são IDs
function set_friend($con, $user_logado, $user_friend)
{
  try {
    if (!($con || $user_logado || $user_friend)) {
      return "Inseri todas as informações requerida no método ";
    }
    $sql = "insert into user_are_friend() values (default, '$user_logado', '$user_friend')";

    return $con->exec($sql);
  } catch (Exception $err) {
    echo $err;
  }

  return 0;
}

// pega todos os amigos
function get_friends($con, $user_logado)
{
  if (!($con || $user_logado)) {
    return "Inseri todas as informações requerida no método ";
  }

  $sql = "SELECT frd.nome AS Amigo, frd.sobrenome  from usuario AS usr
  join user_are_friend AS uaf
  ON usr.id = uaf.user_id
  JOIN usuario AS frd ON uaf.friend_id = frd.id

  -- pega os amigos apenas do usuário que está requisitando
  WHERE usr.id = '$user_logado';";

  return $con->exec($sql);
}
