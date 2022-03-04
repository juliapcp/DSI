<html>

<head>
    <title>Alterar Produto</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php

    if (isset($_GET["id"])) {
        $conexao = mysqli_connect("localhost", "root", "", "dsi") or print(mysqli_error());
        $produtoAtual = mysqli_fetch_array(mysqli_query($conexao, "SELECT * FROM PRODUTO WHERE ID = ". $_GET["id"]));
            
        echo '<form name="update" action="update.php" method="POST">';
        echo '<table>';
        echo '<caption><h1>Alterar Produto</h1></caption>';
        echo '<tbody>';

        echo '<tr>';
        echo '<td><label for="Descricao">Descrição</label></td>';
        echo '<td><input type="text" name="Descricao" value="'.$produtoAtual["descricao"].'"></td>';
        echo '</tr>';

        echo '<tr>';
        echo '<td><label for="Quantidade">Quantidade</label></td>';
        echo '<td><input type="number" step="0.01" name="Quantidade" value="' . $produtoAtual["quantidade"] . '"></td>';
        echo '</tr>';

        echo '<tr>';
        echo '<td><label for="valorUnitario">Valor Unitário</label></td>';
        echo '<td><input type="number" step="0.01" name="valorUnitario" value="' . $produtoAtual["valorUnitario"] . '"></td>';
        echo '</tr>';

        echo '<tr>';
        echo '<td><input type="submit" name="Alterar" value="Alterar"></td>';
        echo '<td><input type="text" name="id" value="'. $_GET["id"].'" hidden></td>';

        echo '</tr>';

        echo '</tbody>';
        echo '</table>';
        echo '</form>';

    } else if (isset($_POST["Alterar"])) {
        $error = "";
        if ($error == "") {
            $conexao = mysqli_connect("localhost", "root", "", "dsi") or print(mysqli_error());
            mysqli_query($conexao, "update produto set descricao = '" . $_POST['Descricao'] . "', quantidade =" . $_POST['Quantidade'] . ", valorUnitario = " . $_POST['valorUnitario'] .' WHERE ID='. $_POST["id"] );
            echo "Produto alterado!<br>\n";
        } else {
            echo "<font color=\"red\">" . $error . "</font>";
        }
    }

    ?>
</body>
<?php


if (isset($_POST["Alterar"])) {
    echo "<script>setTimeout(function () { window.open(\"lista.php\",\"_self\"); }, 3000);</script>";
}


?>

</html>