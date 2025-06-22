<?php
// log_client.php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $datos = json_decode(file_get_contents('php://input'), true);
    if ($datos && is_array($datos)) {
        $archivo = 'log.txt';
        $registro = "==== Datos cliente: " . date('Y-m-d H:i:s') . " ====" . PHP_EOL;
        foreach ($datos as $clave => $valor) {
            $registro .= "$clave: $valor" . PHP_EOL;
        }
        $registro .= PHP_EOL;
        file_put_contents($archivo, $registro, FILE_APPEND);
        http_response_code(200);
        exit('OK');
    }
}
http_response_code(400);
exit('Error');
