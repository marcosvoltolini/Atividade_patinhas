<?php
require "../infra/conexao.php";

$sql = "SELECT animais.id, animais.nome, animais.especie, animais.raca, animais.idade, cliente.nome AS nome_cliente
        FROM animais
        INNER JOIN cliente ON animais.cliente_id = cliente.id";

$resultado = mysqli_query($conexao, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Animais</title>
</head>
<body>

<h1>Lista de Animais</h1>

<a href="cadastrar_animais.php">Cadastrar novo animal</a>
<br><br>

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

    <?php while ($linha = mysqli_fetch_assoc($resultado)) { ?>
        <tr>
            <td><?php echo htmlspecialchars($linha["id"]); ?></td>
            <td><?php echo htmlspecialchars($linha["nome"]); ?></td>
            <td><?php echo htmlspecialchars($linha["especie"]); ?></td>
            <td><?php echo htmlspecialchars($linha["raca"]); ?></td>
            <td><?php echo htmlspecialchars($linha["idade"]); ?></td>
            <td><?php echo htmlspecialchars($linha["nome_cliente"]); ?></td>
            <td>
                <a href="editar_animais.php?id=<?php echo $linha["id"]; ?>">Editar</a>
                |
                <a href="excluir_animais.php?id=<?php echo $linha["id"]; ?>"
                    onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</a>
            </td>
        </tr>
    <?php } ?>

</table>

</body>
</html>