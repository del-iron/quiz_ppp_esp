<?php
require_once 'db.php';

// SELECT dos temas para o filtro de temas
$temasStmt = $pdo->query("SELECT DISTINCT temas FROM perguntas ORDER BY temas ASC");
$temas = $temasStmt->fetchAll(PDO::FETCH_COLUMN);

// SELECT dos números de edital para o filtro de edital
$editaisStmt = $pdo->query("SELECT DISTINCT numero_edital FROM perguntas ORDER BY numero_edital ASC");
$editais = $editaisStmt->fetchAll(PDO::FETCH_COLUMN);

// SELECT dos anos de edital para o filtro de ano
$anosStmt = $pdo->query("SELECT DISTINCT ano_edital FROM perguntas ORDER BY ano_edital DESC");
$anos = $anosStmt->fetchAll(PDO::FETCH_COLUMN);

// SELECT dos subtemas para o filtro de subtema
$subtemasStmt = $pdo->query("SELECT DISTINCT sub_temas FROM perguntas ORDER BY sub_temas ASC");
$subtemas = $subtemasStmt->fetchAll(PDO::FETCH_COLUMN);
