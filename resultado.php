<?php
require 'db.php'; // Conexão com o banco de dados
require 'processa_resultado.php'; // Processa as respostas do quiz
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Resultado</title>
    <!-- CSS customizado -->
    <link rel="stylesheet" href="style.css">
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-4">
<div class="container">
    <!-- Card com resultado geral -->
    <div class="card p-4 mb-4 text-center">
        <h1 class="text-primary">Resultado do Quiz</h1>
        <p class="lead">Você acertou <strong><?= $acertos ?></strong> de <strong><?= $total ?></strong> perguntas.</p>
        <a class="btn btn-outline-primary" href="index.php">Tentar novamente</a>
    </div>

    <!-- Feedback detalhado de cada questão -->
    <?php foreach ($feedbacks as $fb): ?>
        <div class="card mb-3">
            <div class="card-body">
                <!-- Enunciado da pergunta -->
                <h5 class="card-title"><?= htmlspecialchars($fb['pergunta']) ?></h5>
                <ul class="list-group">
                    <?php foreach ($fb['alternativas'] as $letra => $texto): 
                        $classe = '';
                        // Marca a alternativa do usuário como correta ou errada
                        if ($letra === $fb['resposta_usuario']) {
                            $classe = ($fb['status'] === 'correta') ? 'list-group-item-success' : 'list-group-item-danger';
                        } 
                        // Marca a alternativa correta se o usuário errou
                        elseif ($letra === $fb['correta']) {
                            $classe = 'list-group-item-success';
                        }
                    ?>
                        <li class="list-group-item <?= $classe ?>">
                            <strong><?= $letra ?>)</strong> <?= htmlspecialchars($texto) ?>
                            <?php if ($letra === $fb['resposta_usuario']): ?>
                                <?php if ($fb['status'] === 'correta'): ?>
                                    <span class="badge bg-success ms-2">Sua resposta</span>
                                <?php else: ?>
                                    <span class="badge bg-danger ms-2">Sua resposta</span>
                                <?php endif; ?>
                            <?php endif; ?>
                            <?php if ($letra === $fb['correta'] && $fb['resposta_usuario'] !== $fb['correta']): ?>
                                <span class="badge bg-success ms-2">Correta</span>
                            <?php endif; ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    <?php endforeach; ?>
</div>
</body>
</html>