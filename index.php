<?php
require 'db.php';

// Buscar todos os temas disponíveis para o select
$temasStmt = $pdo->query("SELECT DISTINCT temas FROM perguntas ORDER BY temas ASC");
$temas = $temasStmt->fetchAll(PDO::FETCH_COLUMN);

// Buscar todos os números de edital disponíveis para o select
$editaisStmt = $pdo->query("SELECT DISTINCT numero_edital FROM perguntas ORDER BY numero_edital ASC");
$editais = $editaisStmt->fetchAll(PDO::FETCH_COLUMN);

// Buscar todos os anos de edital disponíveis para o select
$anosStmt = $pdo->query("SELECT DISTINCT ano_edital FROM perguntas ORDER BY ano_edital DESC");
$anos = $anosStmt->fetchAll(PDO::FETCH_COLUMN);

// Buscar todos os subtemas disponíveis para o select
$subtemasStmt = $pdo->query("SELECT DISTINCT sub_temas FROM perguntas ORDER BY sub_temas ASC");
$subtemas = $subtemasStmt->fetchAll(PDO::FETCH_COLUMN);

$tema = isset($_GET['tema']) ? trim($_GET['tema']) : '';
$numero_edital = isset($_GET['numero_edital']) ? trim($_GET['numero_edital']) : '';
$ano_edital = isset($_GET['ano_edital']) ? trim($_GET['ano_edital']) : '';
$sub_tema = isset($_GET['sub_tema']) ? trim($_GET['sub_tema']) : '';

// Novo campo para quantidade de questões
$qtd_questoes = isset($_GET['qtd_questoes']) ? (int)$_GET['qtd_questoes'] : '';

$where = [];
$params = [];

if ($tema !== '' && $tema !== 'todos') {
    $where[] = "temas = ?";
    $params[] = $tema;
}
if ($numero_edital !== '' && $numero_edital !== 'todos') {
    $where[] = "numero_edital = ?";
    $params[] = $numero_edital;
}
if ($ano_edital !== '' && $ano_edital !== 'todos') {
    $where[] = "ano_edital = ?";
    $params[] = $ano_edital;
}
if ($sub_tema !== '' && $sub_tema !== 'todos') {
    $where[] = "sub_temas = ?";
    $params[] = $sub_tema;
}

$sql = "SELECT * FROM perguntas";
if ($where) {
    $sql .= " WHERE " . implode(" AND ", $where);
}
$sql .= " ORDER BY RAND()";
if ($qtd_questoes > 0) {
    $sql .= " LIMIT " . $qtd_questoes;
}

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$perguntas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Quiz PPP - ESP/CE</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body class="bg-light p-4">
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark">
  <div class="container d-flex align-items-center">
    <!-- Selects de busca por tema, edital, ano, subtema e quantidade de questões -->
    <form class="d-flex me-3" method="get" action="" style="gap: 4px;">
      <!-- ...existing selects... -->
      <select class="form-select form-select-sm" name="tema" aria-label="Buscar por tema">
        <option value="todos" <?= $tema === 'todos' || $tema === '' ? 'selected' : '' ?>>Todos os temas</option>
        <?php foreach ($temas as $t): ?>
          <option value="<?= htmlspecialchars($t) ?>" <?= $tema === $t ? 'selected' : '' ?>>
            <?= htmlspecialchars($t) ?>
          </option>
        <?php endforeach; ?>
      </select>
      <select class="form-select form-select-sm" name="numero_edital" aria-label="Buscar por edital">
        <option value="todos" <?= $numero_edital === 'todos' || $numero_edital === '' ? 'selected' : '' ?>>Todos os editais</option>
        <?php foreach ($editais as $edital): ?>
          <option value="<?= htmlspecialchars($edital) ?>" <?= $numero_edital === $edital ? 'selected' : '' ?>>
            <?= htmlspecialchars($edital) ?>
          </option>
        <?php endforeach; ?>
      </select>
      <select class="form-select form-select-sm" name="ano_edital" aria-label="Buscar por ano">
        <option value="todos" <?= $ano_edital === 'todos' || $ano_edital === '' ? 'selected' : '' ?>>Todos os anos</option>
        <?php foreach ($anos as $ano): ?>
          <option value="<?= htmlspecialchars($ano) ?>" <?= $ano_edital === (string)$ano ? 'selected' : '' ?>>
            <?= htmlspecialchars($ano) ?>
          </option>
        <?php endforeach; ?>
      </select>
      <select class="form-select form-select-sm" name="sub_tema" aria-label="Buscar por subtema">
        <option value="todos" <?= $sub_tema === 'todos' || $sub_tema === '' ? 'selected' : '' ?>>Todos os subtemas</option>
        <?php foreach ($subtemas as $st): ?>
          <option value="<?= htmlspecialchars($st) ?>" <?= $sub_tema === $st ? 'selected' : '' ?>>
            <?= htmlspecialchars($st) ?>
          </option>
        <?php endforeach; ?>
      </select>
      <!-- Novo select para quantidade de questões -->
      <select class="form-select form-select-sm" name="qtd_questoes" aria-label="Quantidade de questões">
        <option value="0" <?= $qtd_questoes === 0 ? 'selected' : '' ?>>Todas</option>
        <?php foreach ([5,10,15,20,30,50] as $qtd): ?>
          <option value="<?= $qtd ?>" <?= $qtd_questoes === $qtd ? 'selected' : '' ?>>
            <?= $qtd ?> questões
          </option>
        <?php endforeach; ?>
      </select>
      <button class="btn btn-outline-light btn-sm" type="submit" title="Buscar">
        <i class="fas fa-search"></i>
      </button>
    </form>
    <a class="navbar-brand d-flex align-items-center" href="#">
      <img src="img/passeiDiretoEspLogo.png" class="navbar-logo" alt="PasseiDiretoESP">
      
    </a>
  </div>
</nav>
<div class="container">
    <h6 class="mb-4 text-success"></h6>
    <form method="post" action="resultado.php">
        <?php foreach ($perguntas as $index => $p): ?>
            <div class="card mb-3">
                <div class="card-body">
                    <p><strong><?= $index + 1 ?>. <?= htmlspecialchars($p['pergunta']) ?></strong></p>
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
        <button class="btn btn-success" type="submit">Enviar</button>
    </form>
</div>
<!-- Footer -->
<footer>
    &copy; <?php echo date('Y'); ?> PasseiDiretoESP. Todos os direitos reservados a mim.
</footer>
</body>
</html>