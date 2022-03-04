<html>

<head>
    <title>Incluir Produto</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php

    if (isset($_POST["Incluir"])) {
        $error = "";
        if ($error == "") {
            $conexao = mysqli_connect("localhost", "root", "", "dsi") or print(mysqli_error());
            mysqli_query($conexao,"insert into produto (descricao, quantidade, valorUnitario) values ('" . $_POST['Descricao'] . "'," . $_POST['Quantidade'] . "," . $_POST['valorUnitario'] . "  )");
            echo "Produto incluído!<br>\n";
        } else {
            echo "<font color=\"red\">" . $error . "</font>";
        }
    } else {
        
        echo '<form name="insert" action="insert.php" method="POST">';
        echo '<table>';
        echo '<caption><h1>Incluir Produto</h1></caption>';
        echo '<tbody>';

        echo '<tr>';
        echo '<td><label for="Descricao">Descrição</label></td>';
        echo '<td><input type="text" name="Descricao"></td>';
        echo '</tr>';

        echo '<tr>';
        echo '<td><label for="Quantidade">Quantidade</label></td>';
        echo '<td><input type="number" step="0.01" name="Quantidade"></td>';
        echo '</tr>';

        echo '<tr>';
        echo '<td><label for="valorUnitario">Valor Unitário</label></td>';
        echo '<td><input type="number" step="0.01" name="valorUnitario"></td>';
        echo '</tr>';

        echo '<tr>';
        echo '<td><input type="submit" name="Incluir" value="Incluir"></td>';
        echo '</tr>';

        echo '</tbody>';
        echo '</table>';
        echo '</form>';
    }

    ?>
</body>
<?php


if (isset($_POST["Incluir"])) {
    echo "<script>setTimeout(function () { window.open(\"lista.php\",\"_self\"); }, 3000);</script>";
}


?>

</html>