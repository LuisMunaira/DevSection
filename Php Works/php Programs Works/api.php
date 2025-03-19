<?php
// Configurar cabeçalhos
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

// Dados fictícios de produtos
$produtos = [
    ["id" => 1, "nome" => "Produto A", "preco" => 10.50],
    ["id" => 2, "nome" => "Produto B", "preco" => 20.75],
    ["id" => 3, "nome" => "Produto C", "preco" => 15.30],
];

// Obter o método HTTP
$method = $_SERVER['REQUEST_METHOD'];

// Obter e limpar a URL requisitada
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$path = str_replace("/api.php", "", $path); // Remover prefixos, se necessário
$pathParts = explode("/", trim($path, "/"));

// Verificar o recurso e o ID
$resource = $pathParts[0] ?? null; // Primeiro segmento da URL
$id = isset($pathParts[1]) ? intval($pathParts[1]) : null; // Segundo segmento (ID)

// Validar se o recurso é "produtos"
if ($resource !== "produtos") {
    http_response_code(404);
    echo json_encode(["message" => "Recurso '{$resource}' não encontrado"]);
    exit;
}

// Processar métodos HTTP
if ($method === "GET") {
    if ($id) {
        // Retornar produto específico
        foreach ($produtos as $produto) {
            if ($produto["id"] === $id) {
                echo json_encode($produto);
                exit;
            }
        }
        http_response_code(404);
        echo json_encode(["message" => "Produto não encontrado"]);
    } else {
        // Retornar todos os produtos
        echo json_encode($produtos);
    }
} else {
    // Método não permitido
    http_response_code(405);
    echo json_encode(["message" => "Método não permitido"]);
}
?>
