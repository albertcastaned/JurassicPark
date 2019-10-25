<?php
    include_once("_header.html");
    require_once("modelo.php");
    include_once("partials/_tableHeader.html");

    echo obtenerIncidentes();

    include_once("partials/_tableFooter.html");

    include_once("_footer.html");
?>