<?php
require "../infra/conexao.php";

if (isset($_POST["id"])) {

    $id = $_POST["id"];
    $nome = $_POST["nome"];
    $especie = $_POST["especie"];
    $raca = $_POST["raca"];
    $idade = $_POST["idade"];
    $cliente_id = $_POST["cliente_id"];

    $sql = "UPDATE animais
            SET nome = ?, especie = ?, raca = ?, idade = ?, cliente_id = ?
            WHERE id = ?";

    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, "sssdii", $nome, $especie, $raca, $idade, $cliente_id, $id);

    if (mysqli_stmt_execute($stmt)) {
        echo "Animal atualizado com sucesso! <a href='listar_animais.php'>Ver animais</a>";
    } else {
        echo "Erro ao atualizar: " . mysqli_stmt_error($stmt);
    }

    mysqli_stmt_close($stmt);
    exit;
}

if (!isset($_GET["id"])) {
    die("ID do animal não informado.");
}

$id = $_GET["id"];

$sql = "SELECT * FROM animais WHERE id = ?";
$stmt = mysqli_prepare($conexao, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$resultado = mysqli_stmt_get_result($stmt);
$animal = mysqli_fetch_assoc($resultado);

if (!$animal) {
    die("Animal não encontrado.");
}

$sql_usuarios = "SELECT * FROM cliente";
$clientes = mysqli_query($conexao, $sql_usuarios);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Editar Animal</title>
</head>
<body>

<h1>Editar Animal</h1>

<form method="POST" action="editar_animais.php">

    <input type="hidden" name="id" value="<?php echo htmlspecialchars($animal["id"]); ?>">

    Nome do animal: <br>
    <input type="text" name="nome" value="<?php echo htmlspecialchars($animal["nome"]); ?>" required><br><br>

    Espécie: <br>
    <textarea name="especie"><?php echo htmlspecialchars($animal["especie"]); ?></textarea><br><br>

    Raça: <br>
    <input type="text" name="raca" value="<?php echo htmlspecialchars($animal["raca"]); ?>" required><br><br>

    Idade: <br>
    <input type="number" step="0.01" name="idade" value="<?php echo htmlspecialchars($animal["idade"]); ?>" required><br><br>

    Cadastrado por: <br>
    <select name="cliente_id" required>
        <?php while ($cliente = mysqli_fetch_assoc($clientes)) { ?>
            <option value="<?php echo htmlspecialchars($cliente["id"]); ?>"
                <?php if ($cliente["id"] == $animal["cliente_id"]) echo "selected"; ?>>
                <?php echo htmlspecialchars($cliente["nome"]); ?>
            </option>
        <?php } ?>
    </select><br><br>

    <button type="submit">Salvar alterações</button>
</form>

<a href="listar_animais.php">Voltar</a>

</body>
</html>