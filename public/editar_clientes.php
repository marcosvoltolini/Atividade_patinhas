<?php
require "../infra/conexao.php";

if (isset($_POST["id"])) {

    $id = $_POST["id"];
    $nome = $_POST["nome"];
    $email = $_POST["email"];

    $sql = "UPDATE cliente
            SET nome = ?, email = ?
            WHERE id = ?";

    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, "sssdii", $nome, $email, $id);

    if (mysqli_stmt_execute($stmt)) {
        echo "cliente atualizado com sucesso! <a href='listar_clientes.php'>Ver clientes</a>";
    } else {
        echo "Erro ao atualizar: " . mysqli_stmt_error($stmt);
    }

    mysqli_stmt_close($stmt);
    exit;
}

if (!isset($_GET["id"])) {
    die("ID do cliente não informado.");
}

$id = $_GET["id"];

$sql = "SELECT * FROM cliente WHERE id = ?";
$stmt = mysqli_prepare($conexao, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$resultado = mysqli_stmt_get_result($stmt);
$cliente = mysqli_fetch_assoc($resultado);

if (!$cliente) {
    die("Cliente não encontrado.");
}

$sql_usuarios = "SELECT * FROM cliente";
$clientes = mysqli_query($conexao, $sql_usuarios);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Editar cliente</title>
</head>
<body>

<h1>Editar cliente</h1>

<form method="POST" action="editar_clientes.php">

    <input type="hidden" name="id" value="<?php echo htmlspecialchars($cliente["id"]); ?>">

    Nome do cliente: <br>
    <input type="text" name="nome" value="<?php echo htmlspecialchars($cliente["nome"]); ?>" required><br><br>

    Email: <br>
    <textarea name="email"><?php echo htmlspecialchars($cliente["email"]); ?></textarea><br><br>


    <button type="submit">Salvar alterações</button>
</form>

<a href="listar_clientes.php">Voltar</a>

</body>
</html>