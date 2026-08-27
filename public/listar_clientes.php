<?php
require "../infra/conexao.php";

$sql = "SELECT id, nome, email FROM cliente";

$resultado = mysqli_query($conexao, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Clientes</title>
</head>
<body>

<h1>Lista de Clientes</h1>

<a href="cadastrar_cliente.php">Cadastrar novo cliente</a>
<br><br>

<table border="1" cellpadding="8">
    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Email</th>
        <th>Ações</th>
    </tr>

    <?php while ($linha = mysqli_fetch_assoc($resultado)) { ?>
        <tr>
            <td><?php echo htmlspecialchars($linha["id"]); ?></td>
            <td><?php echo htmlspecialchars($linha["nome"]); ?></td>
            <td><?php echo htmlspecialchars($linha["email"]); ?></td>
            <td>
                <a href="editar_cliente.php?id=<?php echo $linha["id"]; ?>">Editar</a>
                |
                <a href="excluir_cliente.php?id=<?php echo $linha["id"]; ?>"
                    onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</a>
            </td>
        </tr>
    <?php } ?>

</table>

</body>
</html>