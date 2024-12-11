    <!DOCTYPE html>
<html>
<head>
    <title>Sistema de Gestión Odontológica</title>
    <link rel="stylesheet" href="Vista/css/estilos.css">
    <script src="Vista/jquery/jquery-3.7.1.min.js"></script>
    <script src="Vista/jquery/jquery-ui.min.js"></script>
    <script src="Vista/js/script.js"></script>
    <link href="Vista/jquery/jquery-ui.theme.min" rel="stylesheet" type="text/css"/>
</head>  
<body>
    <div id="contenedor">
        <div id="encabezado">
            <h1>Sistema de Gestión Odontológica</h1>
        </div>
        <ul id="menu">
            <li><a href="index.php">Inicio</a> </li>
            <li><a href="index.php?accion=asignar">Asignar</a> </li>
            <li><a href="index.php?accion=consultar">Consultar Cita</a> </li>
            <li><a href="index.php?accion=cancelar">Cancelar Cita</a> </li>
        </ul>
        <div id="contenido">
            <?php
                if(isset($contenido)) {
                    echo $contenido;
                }
            ?>
        </div>
    </div>        
</body>
</html>