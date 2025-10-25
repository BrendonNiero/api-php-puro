<?php
// definir output da api para JSON
header('Content-Type: application/json');

// verifica se foi POST

if($_SERVER['REQUEST_METHOD'] != 'POST'){
    // erro
    http_response_code(405); // 405: Method not allowed
    echo json_encode(['erro' => 'Método não permitido. Use POST']);
    exit;
}

// ler o corpo (body) enviado

$input = json_decode(file_get_contents('php://input'), true);