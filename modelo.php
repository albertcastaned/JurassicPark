<?php
function connectDB() {
    $environment = "PROD";
    
    if ($environment == "DEV") {
         $bd = mysqli_connect("localhost","root","","FUROCE");
    } else if($environment == "PROD") {
         $bd = mysqli_connect("mysql1008.mochahost.com","dawbdorg_1250647","1250647","dawbdorg_A01250647");
    }
    
    mysqli_set_charset($bd,"utf8");
   
    return $bd;
}

function obtenerLugares()
{
    $db = connectDB();
    if($db == null){
        echo "Conexion base de datos no exitosa";
        return;
    }
    $query = 'CALL ConsultarLugares()';
    $resultado = array();
    
    $registros = $db->query($query);

    while ($fila = mysqli_fetch_array($registros, MYSQLI_BOTH)) {
        array_push($resultado, array($fila["id"],$fila["nombreLugar"]));
    }
        
    mysqli_free_result($registros);

    
    closeDB($db);
    return $resultado;
}

function obtenerTipos()
{
    $db = connectDB();
    if($db == null){
        echo "Conexion base de datos no exitosa";
        return;
    }
    $query = 'CALL ConsultarTipos()';
    $resultado = array();
    
    $registros = $db->query($query);

    while ($fila = mysqli_fetch_array($registros, MYSQLI_BOTH)) {
        array_push($resultado, array($fila["id"], $fila["nombreIncidente"]));
    }
        
    mysqli_free_result($registros);

    
    closeDB($db);
    return $resultado;
}
function obtenerIncidentes() {
    
    $db = connectDB();
    if($db == null){
        echo "Conexion base de datos no exitosa";
        return;
    }
    $query = 'CALL ConsultarIncidente()';
    
    
    $registros = $db->query($query);

    while ($fila = mysqli_fetch_array($registros, MYSQLI_BOTH)) {
        $lugar = $fila["nombreIncidente"];
        $tipo = $fila["nombreLugar"];
        $fecha = $fila["fecha"];
        include("partials/_tableEntry.html");
    }
        
    mysqli_free_result($registros);

    
    closeDB($db);
    
}
function closeDB($bd) {
    
    mysqli_close($bd);
}

function registrarIncidente($lugar, $tipo)
{
    $db = connectDB();
    $parametros = $lugar . ", " . $tipo;
    $query="CALL `RegistrarIncidente`($parametros)";
    
    if (!$db->query($query)) {
        echo "Falló CALL: (" . $query->errno . ") " . $query->error;
    }   
    
    
    closeDB($db);
}
?>