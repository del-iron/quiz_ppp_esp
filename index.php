<?php
// Importa conexão com o banco de dados
require 'db.php';
// Importa selects de filtros (temas, editais, anos, subtemas)
require 'selects.php';
// Importa lógica de filtros e busca das perguntas
require 'filtros.php';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Quiz PPP - ESP/CE</title>
    <!-- CSS customizado -->
    <link rel="stylesheet" href="style.css">
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome para ícones -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body class="bg-light p-4">
<!-- Navbar com filtros de busca -->
<nav class="navbar navbar-expand-lg navbar-dark">
  <div class="container d-flex align-items-center">
    <!-- Formulário de filtros (GET) -->
    <form class="d-flex me-3" method="get" action="" style="gap: 4px;">
      <?php require 'selects_form.php'; ?>
      <button class="btn btn-outline-light btn-sm" type="submit" title="Buscar">
        <i class="fas fa-search"></i>
      </button>
    </form>
    <!-- Logo/marca da navbar -->
    <a class="navbar-brand d-flex align-items-center" href="#">
      <img src="img/passeiDiretoEspLogo.png" class="navbar-logo" alt="PasseiDiretoESP">
    </a>
  </div>
</nav>
<!-- Container principal do conteúdo -->
<div class="container">
    <h6 class="mb-4 text-success"></h6>
    <!-- Formulário do quiz (envia respostas para resultado.php) -->
    <form method="post" action="resultado.php">
        <?php foreach ($perguntas as $index => $p): ?>
            <div class="card mb-3">
                <div class="card-body">
                    <!-- Enunciado da pergunta -->
                    <p><strong><?= $index + 1 ?>. <?= htmlspecialchars($p['pergunta']) ?></strong></p>
                    <!-- Alternativas da pergunta -->
                    <?php foreach (["a","b","c","d"] as $letra): ?>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="respostas[<?= $p['id'] ?>]" value="<?= strtoupper($letra) ?>" required>
                            <label class="form-check-label">
                                <?= strtoupper($letra) ?>) <?= htmlspecialchars($p["alternativa_" . $letra]) ?>
                            </label>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endforeach; ?>
        <!-- Botão de envio do quiz -->
        <button class="btn btn-success" type="submit">Enviar</button>
    </form>
</div>
<!-- Footer fixo -->
<footer>
    &copy; <?php echo date('Y'); ?> PasseiDiretoESP. Todos os direitos reservados a Jardel Menezes Rocha.
</footer>
</body>
</html>