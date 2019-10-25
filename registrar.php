<?php
    include_once("_header.html");
    require_once("modelo.php");

    if(isset($_POST["lugar"]) && isset($_POST["tipo"]))
    {
        registrarIncidente($_POST["lugar"],$_POST["tipo"]);
        echo "<h2>Se registro exitosamente</h2>";
    }else{
        $lugares = obtenerLugares();
        $tipos = obtenerTipos();
        include_once("partials/_registrar.html");
    }

    include_once("_footer.html");

?>