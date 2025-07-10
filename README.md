# Quiz PPP - ESP/CE

## Descrição das Páginas

### index.php
Página principal do sistema. Exibe o formulário de filtros (tema, edital, ano, subtema, quantidade de questões) e o quiz com perguntas aleatórias. Ao enviar o quiz, redireciona para `resultado.php`.

### resultado.php
Recebe as respostas do quiz, corrige automaticamente, mostra o número de acertos e feedback detalhado de cada questão (resposta do usuário, alternativa correta, etc).

### db.php
Arquivo de configuração da conexão com o banco de dados MySQL/MariaDB.

### selects.php
Executa os SELECTs para buscar todas as opções distintas de temas, editais, anos e subtemas, usadas nos filtros do formulário.

### selects_form.php
Contém apenas os campos `<select>` do formulário de filtros, para manter o código do formulário limpo e modular.

### filtros.php
Processa os filtros recebidos via GET, monta a query SQL de busca das perguntas e retorna o array `$perguntas` para uso no quiz.

### style.css
Arquivo de estilos customizados para o layout, responsividade e aparência dos componentes.

### quiz_ppp.sql
Script SQL para criar e popular a tabela `perguntas` no banco de dados.

---

## Fluxo principal

1. O usuário acessa `index.php`, escolhe os filtros e responde ao quiz.
2. Ao enviar, as respostas são processadas em `resultado.php`, que mostra o desempenho e feedback.
3. Todas as opções de filtros são carregadas via `selects.php` e exibidas pelo formulário em `selects_form.php`.
4. A lógica de busca das perguntas filtradas está em `filtros.php`.
5. O banco de dados é acessado via `db.php`.

---
