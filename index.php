<?php

include "infra/conexao.php";

$animais = mysqli_query($conexao, "
    SELECT animais.id, animais.nome, animais.especie, animais.raca, animais.idade,
           cliente.nome AS nome_cliente
    FROM animais
    INNER JOIN cliente ON animais.cliente_id = cliente.id
");

$clientes = mysqli_query($conexao, "SELECT * FROM cliente");
?>

<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patinhas</title>
</head>
<body>
    <header>
        <h1>Atividade_Patinhas</h1>
    </header>
    <main>

<h2>Cadastre um novo cliente</h2>
<form action="public/cadastrar_cliente.php" method="POST">

<label>Nome:</label>
<input type="text" name="nome_cliente" required>
<br>

<label>Email:</label>
<input type="text" name="email" required>
<br>

<button type="submit">Cliente</button>

</form>


<h2>Adicione um novo Animal!</h2>
<form action="public_animais/cadastrar_animais.php" method="POST">
    <label for="nome_animal">Nome do animal:</label>
    <input type="text" name="nome_animal" required>
    <br>
    <label for="especie">Espécie:</label>
    <input type="text" name="especie" required>
    <br>
    <label for="raca">raça do animal:</label>
    <input type="text" name="raca" required>
    <br>
    <label for="idade">idade:</label>
    <input type="number" step="1" name="idade" required>
    <br>
    <label for="cliente_id">Cadastrado por:</label>
    <select name="cliente_id" required>
        <option value="">Selecione um usuário</option>
        <?php while ($cliente = mysqli_fetch_assoc($clientes)) { ?>
            <option value="<?php echo htmlspecialchars($cliente["id"]); ?>">
                <?php echo htmlspecialchars($cliente["nome"]); ?>
            </option>
        <?php } ?>
    </select>
    <br>
    <button type="submit">Cadastrar Animal</button>
</form>

<br>
<a href="public_animais/associar_animal.php">Associar animal a um cliente</a>

<div>
    <h2>Animais Cadastrados</h2>
    <table border="1" cellpadding="8">
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Espécie</th>
            <th>Raça</th>
            <th>Idade</th>
            <th>Dono</th>
            <th>Ações</th>
        </tr>
        <?php while ($animal = mysqli_fetch_assoc($animais)) { ?>
            <tr>
                <td><?php echo htmlspecialchars($animal["id"]) ?></td>
                <td><?php echo htmlspecialchars($animal["nome"]) ?></td>
                <td><?php echo htmlspecialchars($animal["especie"]) ?></td>
                <td><?php echo htmlspecialchars($animal["raca"]) ?></td>
                <td><?php echo htmlspecialchars($animal["idade"]) ?></td>
                <td><?php echo htmlspecialchars($animal["nome_cliente"]) ?></td>
                <td>
                    <a href="public_animais/editar_animais.php?id=<?php echo $animal["id"] ?>">Editar</a>
                    |
                    <a href="public_animais/excluir_animais.php?id=<?php echo $animal["id"] ?>"
                        onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</a>
                </td>
            </tr>
        <?php } ?>
    </table>
</div>

    </main>
    <footer>

    </footer>

</body>
</html>