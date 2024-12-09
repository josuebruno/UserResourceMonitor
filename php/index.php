<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
</head>
<body>

<?php
$apiUrl = 'http://172.18.250.28:5000/servers/serv2';
$response = file_get_contents($apiUrl);

if ($response !== false) {
    $data = json_decode($response, true);
    if ($data === null) {
        echo "Erro ao decodificar JSON.";
    }
} else {
    echo "Erro ao obter resposta da API.";
}
?>

<div class="container">
    <?php foreach ($data as $item) : ?>
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">Usuário: <?= $item['username'] ?></h5>
                <p class="card-text">Percentual de CPU: <?= max(0, $item['cpu_percent']) ?>%</p>
                <p class="card-text">Percentual de Memória: <?= max(0, $item['memory_percent']) ?>%</p>
                <p class="card-text">Uso de Memória: <?= round(max(0, $item['memory_usage_bytes']) / (1024 * 1024), 2) ?> MB</p>
                <div id="cpuChart<?= $item['username'] ?>"></div>
                <div id="memoryChart<?= $item['username'] ?>"></div>
            </div>
        </div>

        <script>
            google.charts.load('current', {'packages':['corechart']});
            google.charts.setOnLoadCallback(drawCharts<?= $item['username'] ?>);

            function drawCharts<?= $item['username'] ?>() {
                var data = google.visualization.arrayToDataTable([
                    ['Task', 'Percentual'],
                    ['CPU', <?= max(0, $item['cpu_percent']) ?>],
                    ['Memória', <?= max(0, $item['memory_percent']) ?>]
                ]);

                var options = {
                    title: 'Uso de Recursos',
                    pieHole: 0.4,
                    colors: ['#2196F3', '#F44336']
                };

                var cpuChart<?= $item['username'] ?> = new google.visualization.PieChart(document.getElementById('cpuChart<?= $item['username'] ?>'));
                cpuChart<?= $item['username'] ?>.draw(data, options);

                var memoryChart<?= $item['username'] ?> = new google.visualization.PieChart(document.getElementById('memoryChart<?= $item['username'] ?>'));
                memoryChart<?= $item['username'] ?>.draw(data, options);
            }
        </script>
    <?php endforeach; ?>
</div>

</body>
</html>