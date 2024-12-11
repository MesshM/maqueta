<?php
require_once 'Controlador/Controlador.php';

$controlador = new Controlador();

if (isset($_GET["accion"])) {
    switch ($_GET["accion"]) {
        case 'asignar':
            $controlador->cargarAsignar();
            break;
        case 'consultar':
            $controlador->verPagina('Vista/html/consultar.php');
            break;
        case 'cancelar':
            $controlador->verPagina('Vista/html/cancelar.php');
            break;
        case 'guardarCita':
            $controlador->agregarCita(
                $_POST["asignarDocumento"],
                $_POST["medico"],
                $_POST["fecha"],
                $_POST["hora"],
                $_POST["consultorio"]
            );
            break;
        case 'consultarPaciente':
            $controlador->consultarPaciente($_GET["documento"]);
            break;
        case 'ingresarPaciente':
            $controlador->agregarPaciente(
                $_GET["PacDocumento"],
                $_GET["PacNombres"],
                $_GET["PacApellidos"],
                $_GET["PacNacimiento"],
                $_GET["PacSexo"]
            );
            break;
        case 'consultarCita':
            $controlador->consultarCitas($_GET["consultarDocumento"]);
            break;
        case 'verCita':
            $controlador->verCita($_GET["numero"]);
            break;
        case 'cancelarCita':
            $controlador->cancelarCitas($_GET["cancelarDocumento"]);
            break;
        case 'confirmarCancelar':
            $controlador->confirmarCancelarCita($_GET["numero"]);
            break;
        case 'consultarHora':
            $controlador->consultarHorasDisponibles($_GET["medico"], $_GET["fecha"]);
            break;
        default:
            $controlador->inicio();
    }
} else {
    $controlador->inicio();
}