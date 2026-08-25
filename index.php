<?php

include "infra/conexao.php";
$animais = myslqli_query($conexao, "SELECT * FROM animais");
$clientes = mysqli_query($conexao, "SELECT * FROM clientes");
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patinhas</title>
</head>
<body>
    
</body>
</html>