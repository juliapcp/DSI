<html>

<body>
    <?php
    if (isset($_GET["id"])) {
        $conexao = mysqli_connect("localhost", "root", "", "dsi") or print(mysqli_error());
        mysqli_query($conexao, "delete from produto where id = " . $_GET["id"]);
        echo " Produto eliminado!";
    }
    ?>
</body>
<script>
    setTimeout(function() {
        window.open("lista.php", "_self");
    }, 3000);
</script>

</html>