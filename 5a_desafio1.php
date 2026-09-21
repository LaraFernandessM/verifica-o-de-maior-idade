<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de usuário</title>
</head>
<body>

    <!-- Formulário -->
    <form method="post" action="">

        <!-- Campo nome -->
        <label for="nome">Nome:</label>
        <input type="text" name="nome" required>

        <!-- Campo ano de nascimento -->
        <label for="anodenascimento">Ano de Nascimento:</label>
        <input type="number" name="anodenascimento" required>

        <!-- Botão de cadastro -->
        <button type="submit">Cadastrar</button>

    </form>

    <!-- Lógica para gravar as informações -->
    <?php 
    $nome = '';

    // Verifica se as informações vieram do Front-end
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Captura os valores enviados do Front-end
        $nome = $_POST['nome'];
        $anodenascimento = $_POST['anodenascimento'];

        if (!is_numeric($anodenascimento) || $anodenascimento > 2007 || $anodenascimento > date("Y")) {
            echo "<p>Acesso negado " . $nome . "!</p>";
            exit;
        }

        // Lógica para gravar os dados em um arquivo txt

        // O fopen significa "File open" ou abrir arquivo e a letra "a"
        // significa "append" ou acrescentar
        $arquivo = fopen('usuarios.txt', 'a');

        // Criar uma linha para guardar o nome e ano de nascimento
        $linha = $nome . ';' . $anodenascimento . "\n";

        // fwrite ou "File write" habilita de fato a escrita ou criação da linha
        fwrite($arquivo, $linha);

        // Fecha o arquivo
        fclose($arquivo);

        // Redireciona para a própria página (Após cadastro)
        header('Location: ' .$_SERVER['PHP_SELF']. '?sucesso=1');
        exit;
    }
    if(isset($_GET['sucesso'])){
        // Mensagem ou feedback visual para o usuário
        echo "<p>Acesso permitido " . $nome . "!</p>";

        // Comunica para o front-end e atualiza após 3 segundos
        header('Refresh: 3; url=' . $_SERVER['PHP_SELF']);

    }
     
    ?>
    
</body>
</html>