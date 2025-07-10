<?php
require 'db.php'; // Conexão com o banco de dados
require 'selects.php'; // Carrega arrays de opções para os selects

// --- Filtro por tema (campo do formulário GET) ---
$tema = isset($_GET['tema']) ? trim($_GET['tema']) : '';

// --- Filtro por número de edital (campo do formulário GET) ---
$numero_edital = isset($_GET['numero_edital']) ? trim($_GET['numero_edital']) : '';

// --- Filtro por ano do edital (campo do formulário GET) ---
$ano_edital = isset($_GET['ano_edital']) ? trim($_GET['ano_edital']) : '';

// --- Filtro por subtema (campo do formulário GET) ---
$sub_tema = isset($_GET['sub_tema']) ? trim($_GET['sub_tema']) : '';

// --- Filtro por quantidade de questões (campo do formulário GET) ---
$qtd_questoes = isset($_GET['qtd_questoes']) ? (int)$_GET['qtd_questoes'] : '';

// --- Montagem dos filtros SQL dinâmicos ---
$where = [];   // Array para condições WHERE
$params = [];  // Array para parâmetros do PDO

// Adiciona filtro de tema se selecionado
if ($tema !== '' && $tema !== 'todos') {
    $where[] = "temas = ?";
    $params[] = $tema;
}
// Adiciona filtro de número de edital se selecionado
if ($numero_edital !== '' && $numero_edital !== 'todos') {
    $where[] = "numero_edital = ?";
    $params[] = $numero_edital;
}
// Adiciona filtro de ano do edital se selecionado
if ($ano_edital !== '' && $ano_edital !== 'todos') {
    $where[] = "ano_edital = ?";
    $params[] = $ano_edital;
}
// Adiciona filtro de subtema se selecionado
if ($sub_tema !== '' && $sub_tema !== 'todos') {
    $where[] = "sub_temas = ?";
    $params[] = $sub_tema;
}

// Monta a query principal de perguntas
$sql = "SELECT * FROM perguntas";
if ($where) {
    $sql .= " WHERE " . implode(" AND ", $where); // Adiciona condições WHERE se houver filtros
}
$sql .= " ORDER BY RAND()"; // Ordena aleatoriamente as perguntas
if ($qtd_questoes > 0) {
    $sql .= " LIMIT " . $qtd_questoes; // Limita a quantidade de perguntas se selecionado
}

// Executa a consulta preparada
$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$perguntas = $stmt->fetchAll(PDO::FETCH_ASSOC); // Array com as perguntas filtradas
