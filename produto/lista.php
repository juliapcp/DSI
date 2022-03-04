<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>Lista de Produtos</title>
</head>

<body>
    <?php
    function url($campo, $valor)
    {
        $result = array();
        if (isset($_GET["descricao"])) $result["descricao"] = "descricao=" . $_GET["descricao"];
        if (isset($_GET["orderby"])) $result["orderby"] = "orderby=" . $_GET["orderby"];
        if (isset($_GET["offset"])) $result["offset"] = "offset=" . $_GET["offset"];
        $result[$campo] = $campo . "=" . $valor;
        return ("lista.php?" . strtr(implode("&", $result), " ", "+"));
    }


    $conexao = mysqli_connect("localhost", "root", "", "dsi") or print(mysqli_error());


    $limit = 5;

    echo "<h1>Cadastro de Produtos</h1>\n";

    // echo "<select id=\"campo\" name=\"campo\">\n";
    // echo "<option value=\"descricao\"" . ((isset($_GET["descricao"])) ? " selected" : "") . ">Descrição</option>\n";
    // echo "<option value=\"quantidade\"" . ((isset($_GET["quantidade"])) ? " selected" : "") . ">Quantidade</option>\n";
    // echo "<option value=\"valorUnitario\"" . ((isset($_GET["valorUnitario"])) ? " selected" : "") . ">Valor Unitário</option>\n";

    // echo "</select>\n";

    $value = "";
    // if (isset($_GET["descricao"])) $where[] = "descricao like '%" . strtr($_GET["descricao"], " ", "%") . "%'";
    // if (isset($_GET["quantidade"])) $where[] = "quantidade = " .$_GET["quantidade"];
    // if (isset($_GET["valorUnitario"])) $where[] = "valorUnitario = " .$_GET["valorUnitario"];

    // echo "<input type=\"text\" id=\"valor\" name=\"valor\" value=\"" . $value . "\" size=\"20\"> \n";

    $parameters = array();
    if (isset($_GET["orderby"])) $parameters[] = "orderby=" . $_GET["orderby"];
    if (isset($_GET["offset"])) $parameters[] = "offset=" . $_GET["offset"];
    // echo "<a href=\"\" onclick=\"value = document.getElementById('valor').value.trim().replace(/ +/g, '+'); result = '" . strtr(implode("&", $parameters), " ", "+") . "'; result = ((value != '') ? document.getElementById('campo').value+'='+value+((result != '') ? '&' : '') : '')+result; this.href ='lista.php'+((result != '') ? '?' : '')+result;\">&#x1F50E;</a><br>\n";
    echo "<br>\n";

    echo "<table border=\"1\">\n";
    echo "<tr>\n";
    echo "<td><a href=\"insert.php\">&#x1F4C4;</a></td>\n";
    echo "<td><b>Descrição</b> <a href=\"" . url("orderby", "descricao+asc") . "\">&#x25BE;</a> <a href=\"" . url("orderby", "descricao+desc") . "\">&#x25B4;</a></td>\n";
    echo "<td><b>Quantidade</b> <a href=\"" . url("orderby", "quantidade+asc") . "\">&#x25BE;</a> <a href=\"" . url("orderby", "quantidade+desc") . "\">&#x25B4;</a></td>\n";
    echo "<td><b>Valor Unitário</b> <a href=\"" . url("orderby", "valorUnitario+asc") . "\">&#x25BE;</a> <a href=\"" . url("orderby", "valorUnitario+desc") . "\">&#x25B4;</a></td>\n";
    echo "<td></td>\n";
    echo "</tr>\n";

    $where = array();

    $where = (count($where) > 0) ? "where " . implode(" and ", $where) : "";

    $total = mysqli_fetch_array(mysqli_query($conexao,"select count(*) as total from produto ".$where))["total"];

    $orderby = (isset($_GET["orderby"])) ? $_GET["orderby"] : "descricao asc";

    $offset = (isset($_GET["offset"])) ? max(0, min($_GET["offset"], $total - 1)) : 0;
    $offset = $offset - ($offset % $limit);

    $results = mysqli_query($conexao,("select * from produto" . $where . " order by " . $orderby . " limit " . $limit . " offset " . $offset));

    while ($row = mysqli_fetch_array($results)) {
        echo "<tr>";
        echo '<td>' . "<a href=\"update.php?id=" . $row["id"] . "\">&#x1F4DD;</a>" . '</td>';
        echo "<td>" . $row["descricao"] . "</td>";
        echo "<td>" . $row["quantidade"] . "</td>";
        echo "<td>" . $row["valorUnitario"] . "</td>";
        echo "<td><a href=\"delete.php?id=" . $row["id"] . "\" onclick=\"return(confirm('Tem certeza que deseja eliminar o produto " . $row["descricao"] . "?'));\">&#x1F5D1;</a></td>\n";
    }
    echo "<td>\n";
    echo "</table>\n";
    echo "<br>\n";

    for ($page = 0; $page < ceil($total / $limit); $page++) {
        echo (($offset == $page * $limit) ? ($page + 1) : "<a href=\"" . url("offset", $page * $limit) . "\">" . ($page + 1) . "</a>") . " \n";
    }

    ?>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>

</html>