<?php
$apiUrl = 'http://172.18.250.28:5000/servers/serv2';
$response = file_get_contents($apiUrl);

if ($response !== false) {
    $data = json_decode($response, true);
    if ($data !== null) {
        // Agora você tem os dados da API em formato PHP
        foreach ($data as $item) {
            $cpuPercent = $item['cpu_percent'];
            $memoryPercent = $item['memory_percent'];
            $memoryUsage = $item['memory_usage_bytes'];
            $username = $item['username'];

            // Faça algo com esses dados, como exibir na página
        }
    } else {
        echo "Erro ao decodificar JSON.";
    }
} else {
    echo "Erro ao obter resposta da API.";
}
?>
