<?php ob_start() ?>
<h2>Consultar Cita</h2>
<form action="index.php?accion=consultarCita" method="post" id="frmconsultar">
    <table>
        <tr>
            <td>Documento del Paciente</td>
            <td><input type="text" name="consultarDocumento" id="consultarDocumento"></td>
        </tr>
        <tr>
            <td colspan="2"><input type="button" name="consultarConsultar" value="Consultar" id="consultarConsultar" onclick="consultarCita()"></td>
        </tr>
        <tr>
            <td colspan="2"><div id="paciente2"></div></td>
        </tr>
    </table>
</form>
<?php
$contenido = ob_get_clean();
include 'plantilla.php';
?>