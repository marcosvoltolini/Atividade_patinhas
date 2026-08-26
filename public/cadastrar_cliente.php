<?php

include "../infra/conexao.php";

if (!isset($_POST["nome_cliente"], $_POST["email"])) {
    header("Location: ../index.php");
    exit();
}

$nome = $_POST["nome_cliente"];
$email = $_POST["email"];

$sql = "INSERT INTO cliente (nome, email) VALUES (?, ?)";

$stmt = mysqli_prepare($conexao, $sql);

if ($stmt) {
    mysqli_stmt_bind_param($stmt, "ss", $nome, $email);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
} else {
    echo "Erro ao preparar a query: " . mysqli_error($conexao);
    exit();
}

header("Location: ../index.php");
exit();
?>