<?php
// Este arquivo deve conter apenas os campos <select> do formulário de filtros
?>
<!-- Select de temas -->
<select class="form-select form-select-sm" name="tema" aria-label="Buscar por tema" onchange="this.form.submit();">
  <option value="todos" <?= $tema === 'todos' || $tema === '' ? 'selected' : '' ?>>Todos os temas</option>
  <?php foreach ($temas as $t): ?>
    <option value="<?= htmlspecialchars($t) ?>" <?= $tema === $t ? 'selected' : '' ?>>
      <?= htmlspecialchars($t) ?>
    </option>
  <?php endforeach; ?>
</select>

<!-- Select de número de edital -->
<select class="form-select form-select-sm" name="numero_edital" aria-label="Buscar por edital" onchange="this.form.submit();">
  <option value="todos" <?= $numero_edital === 'todos' || $numero_edital === '' ? 'selected' : '' ?>>Todos os editais</option>
  <?php foreach ($editais as $edital): ?>
    <option value="<?= htmlspecialchars($edital) ?>" <?= $numero_edital === $edital ? 'selected' : '' ?>>
      <?= htmlspecialchars($edital) ?>
    </option>
  <?php endforeach; ?>
</select>

<!-- Select de ano do edital -->
<select class="form-select form-select-sm" name="ano_edital" aria-label="Buscar por ano" onchange="this.form.submit();">
  <option value="todos" <?= $ano_edital === 'todos' || $ano_edital === '' ? 'selected' : '' ?>>Todos os anos</option>
  <?php foreach ($anos as $ano): ?>
    <option value="<?= htmlspecialchars($ano) ?>" <?= $ano_edital === (string)$ano ? 'selected' : '' ?>>
      <?= htmlspecialchars($ano) ?>
    </option>
  <?php endforeach; ?>
</select>

<!-- Select de subtema -->
<select class="form-select form-select-sm" name="sub_tema" aria-label="Buscar por subtema" onchange="this.form.submit();">
  <option value="todos" <?= $sub_tema === 'todos' || $sub_tema === '' ? 'selected' : '' ?>>Todos os subtemas</option>
  <?php foreach ($subtemas as $st): ?>
    <option value="<?= htmlspecialchars($st) ?>" <?= $sub_tema === $st ? 'selected' : '' ?>>
      <?= htmlspecialchars($st) ?>
    </option>
  <?php endforeach; ?>
</select>

<!-- Select de quantidade de questões -->
<select class="form-select form-select-sm" name="qtd_questoes" aria-label="Quantidade de questões" onchange="this.form.submit();">
  <option value="0" <?= $qtd_questoes === 0 ? 'selected' : '' ?>>Todas</option>
  <?php foreach ([5,10,15,20,30,50] as $qtd): ?>
    <option value="<?= $qtd ?>" <?= $qtd_questoes === $qtd ? 'selected' : '' ?>>
      <?= $qtd ?> questões
    </option>
  <?php endforeach; ?>
</select>
