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

// Função para responder JSON

function responder($dados){
    echo json_encode($dados, JSON_UNESCAPED_UNICODE);
    exit;
}

// verificar qual é o endpoint
$endpoint = $input['endpoint'] ?? null;

switch($endpoint){
    // calcular a média de valores
    case "media":
        if(!isset($input['valores']) || !is_array($input['valores'])){
            responder(['erro' => 'Indique os valores do array.']);
        }

        $valores = array_map('floatval', $input['valores']);
        $media = array_sum($valores) / count($valores);
        responder(['media' => $media]);
    break;
    case "tabuada" :
        if(!isset($input['numero'])){
            responder(['erro' => 'Indique um número para saber a tabuada.']);
        }
        $numero = (float)$input['numero'];
        $tabuada = [];

        for($indice = 1; $indice <= 10; $indice++){
            $tabuada[] = "$numero X $indice = " . ($numero * $indice);
        }

        responder(['numero' => $numero, 'tabuada' => $tabuada]);
    break;
    case "inverter":
        if(!isset($input['texto'])){
            responder(['erro' => 'Indique um texto para inverter.']);
        }

        $texto = (string)$input['texto'];
        $tamanho = mb_strlen($texto);
        $invertido = '';

        while($tamanho-- > 0){
            $invertido .= mb_substr($texto, $tamanho, 1);
        }

        responder(['original' => $texto, 'invertido' => $invertido]);
    break;
    default:
        responder(['erro' => 'Essa rota não existe!', 'rotas_disponiveis' => ['media', 'tabuada', 'inverter']]);
}