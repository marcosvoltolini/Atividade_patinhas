<?php
include "../infra/conexao.php";

$nome = $_POST["nome_animal"];
$especie = $_POST["especie"];
$raca = $_POST["raca"];
$idade = $_POST["idade"];
$cliente_id = $_POST["cliente_id"];

$sql = "INSERT INTO animais (nome, especie, raca, idade, cliente_id) VALUES (?, ?, ?, ?, ?)";

$stmt = mysqli_prepare($conexao, $sql);

if ($stmt) {
    mysqli_stmt_bind_param(
        $stmt,
        "sssdi",
        $nome,
        $especie,
        $raca,
        $idade,
        $cliente_id
    );
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
} else {
    echo "Erro ao preparar a query: " . mysqli_error($conexao);
    exit();
}

header("Location: ../index.php");
exit();
?>