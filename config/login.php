<?php
// CORS headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Methods: POST, OPTIONS");
// Se for uma requisição OPTIONS (preflight), encerre aqui
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

//Conexão com o banco de dados
$conn = new mysqli("localhost", "root", "gabriel27", "TechFit");

if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

//pega os dados do script - frontend
$dados = json_decode(file_get_contents("php://input"), true);
$usuario = $dados['usuario']; //pega o usuario
$senha = $dados['senha']; // pega a senha 

$stmt = $conn->prepare("SELECT senha FROM funcionarios WHERE LOGIN_REDE = ?"); // codigo do banco de dados
$stmt->bind_param("s", $usuario); // define que o ? será o valor do usuario
$stmt->execute(); // executa o codigo
$result = $stmt->get_result(); // pega o resultado
$row = $result->fetch_assoc(); // busca o valor do fetch(busca) e cria um array com os dados 

if ($row && password_verify($senha, $row['senha'])) { // se usuario e senha tem no banco de dados
    echo json_encode(["status" => "sucesso"]); // se tiver = sucesso
} else {
    echo json_encode(["status" => "erro", "mensagem" => "Usuário ou senha inválidos!"]); // senão envia o erro
}

$stmt->close();
$conn->close();

?>