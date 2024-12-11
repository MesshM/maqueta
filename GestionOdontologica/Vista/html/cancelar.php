<?php ob_start() ?>
<h2>Cancelar Cita</h2>
<form action="index.php?accion=cancelarCita" method="post" id="frmcancelar">
    <table>
        <tr>
            <td>Documento del Paciente</td>
            <td><input type="text" name="cancelarDocumento" id="cancelarDocumento"></td>
        </tr>
        <tr>
            <td colspan="2"><input type="button" value="Consultar" onclick="cancelarCita()"></td>
        </tr>
        <tr>
            <td colspan="2"><div id="paciente3"></div></td>
        </tr>
    </table>
</form>
<?php
$contenido = ob_get_clean();
include 'plantilla.php';
?>