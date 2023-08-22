<!DOCTYPE html>
<html>
<head>
    <style>
        .user-container {
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <?php foreach ($data as $item) : ?>
        <div class="user-container">
            <p><strong>Usuário:</strong> <?= $item['username'] ?></p>
            <p><strong>Percentual de CPU:</strong> <?= $item['cpu_percent'] ?>%</p>
            <p><strong>Percentual de Memória:</strong> <?= $item['memory_percent'] ?>%</p>
            <p><strong>Uso de Memória:</strong> <?= $item['memory_usage_bytes'] ?> bytes</p>
        </div>
    <?php endforeach; ?>
</body>
</html>