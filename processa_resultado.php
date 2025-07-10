<?php
require 'db.php'; // Conexão com o banco de dados

// Recebe as respostas enviadas pelo formulário do quiz
$respostas = $_POST['respostas'] ?? [];
//$respostas = isset($_POST['respostas']) ? $_POST['respostas'] : array();
$acertos = 0; // Contador de acertos
$total = count($respostas); // Total de questões respondidas

$feedbacks = []; // Array para armazenar feedback de cada questão

// Para cada resposta enviada
foreach ($respostas as $id => $resposta) {
    // Busca a pergunta e alternativas no banco pelo ID
    $stmt = $pdo->prepare("SELECT pergunta, alternativa_a, alternativa_b, alternativa_c, alternativa_d, correta FROM perguntas WHERE id = ?");
    $stmt->execute([$id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    $correta = $row['correta']; // Letra da alternativa correta
    if (strtoupper($resposta) === strtoupper($correta)) {
        $acertos++; // Incrementa acertos se a resposta estiver correta
        $status = 'correta';
    } else {
        $status = 'errada';
    }

    // Mapeia as letras para os textos das alternativas
    $alternativas = [
        'A' => $row['alternativa_a'],
        'B' => $row['alternativa_b'],
        'C' => $row['alternativa_c'],
        'D' => $row['alternativa_d'],
    ];

    // Monta o feedback para exibir depois
    $feedbacks[] = [
        'pergunta' => $row['pergunta'],
        'alternativas' => $alternativas,
        'resposta_usuario' => strtoupper($resposta),
        'correta' => strtoupper($correta),
        'status' => $status
    ];
}
