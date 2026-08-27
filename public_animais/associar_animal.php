<?php

include "../infra/conexao.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $animal_id = intval($_POST["animal_id"]);
    $cliente_id = intval($_POST["cliente_id"]);

    if ($animal_id <= 0 || $cliente_id <= 0) {
        die("Selecione um animal e um cliente.");
    }

    $sql = "UPDATE animais
            SET cliente_id = ?
            WHERE id = ?";

    $stmt = $conexao->prepare($sql);

    if (!$stmt) {
        die("Erro ao preparar a consulta.");
    }

    $stmt->bind_param("ii", $cliente_id, $animal_id);

    if ($stmt->execute()) {
        echo "Animal associado ao cliente com sucesso!<br><br>";
        echo '<a href="../index.php">Voltar para o início</a>';
    } else {
        echo "Erro ao associar animal.";
    }

    $stmt->close();
    $conexao->close();

    exit;
}

$animais = $conexao->query(
    "SELECT id, nome FROM animais ORDER BY nome"
);

$clientes = $conexao->query(
    "SELECT id, nome FROM cliente ORDER BY nome"
);

?>

<h2>Associar Animal a um Cliente</h2>

<form method="POST">

    <label>Animal:</label><br>

    <select name="animal_id" required>

        <option value="">Selecione o animal</option>

        <?php while ($animal = $animais->fetch_assoc()): ?>

            <option value="<?= $animal["id"] ?>">
                <?= htmlspecialchars($animal["nome"]) ?>
            </option>

        <?php endwhile; ?>

    </select>

    <br><br>

    <label>Cliente:</label><br>

    <select name="cliente_id" required>

        <option value="">Selecione o cliente</option>

        <?php while ($cliente = $clientes->fetch_assoc()): ?>

            <option value="<?= $cliente["id"] ?>">
                <?= htmlspecialchars($cliente["nome"]) ?>
            </option>

        <?php endwhile; ?>

    </select>

    <br><br>

    <button type="submit">
        Associar
    </button>

</form>

<br>

<a href="../index.php">Voltar</a>