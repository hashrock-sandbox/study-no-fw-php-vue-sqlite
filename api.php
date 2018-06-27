<?
require_once './model/bbs.php';
require_once './JWT.php';

//Initialize
$db = new PDO('sqlite:bbs.db');
Bbs::init($db);
header('Content-Type: application/json; charset=UTF-8');

function post($db){
  $text = $_POST["text"];
  return Bbs::insert($db, $text);
}

function get($db){
  return Bbs::findAll($db);
}

$secret = "hellohello";

//Router
if($_SERVER["REQUEST_METHOD"] == "POST"){

  if($_POST["action"] == "auth"){
    //TODO Login
    $jwt = JWT::encode("{user: 'hello'}", $secret);
    echo '{"status": "login success", "jwt":"' . $jwt . '"}';
  }
  
  if($_POST["action"] == "post"){
    $headers = getallheaders();
    print $headers;
    $authorization = $headers['Authorization'];
    $jwt = JWT::decode($authorization, $secret);
    $text = $_POST["text"];
    echo json_encode(post($db));
  }
}

if($_SERVER["REQUEST_METHOD"] == "GET"){
  echo json_encode(get($db));
}

