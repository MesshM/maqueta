<?php
require_once 'Modelo/GestorCita.php';
require_once 'Modelo/Cita.php';
require_once 'Modelo/Paciente.php';

class Controlador {
    
    public function verPagina($ruta) {
        require_once $ruta;
    }

    public function inicio() {
        $this->verPagina('Vista/html/inicio.php');
    }

    public function cargarAsignar() {
        $gestorCita = new GestorCita();
        $result = $gestorCita->consultarMedicos();
        $result2 = $gestorCita->consultarConsultorios();
        require_once 'Vista/html/asignar.php';
    }

    public function agregarCita($doc, $med, $fec, $hor, $con) {
        try {
            if (empty($doc)) {
                throw new Exception("El documento del paciente es obligatorio");
            }
            
            $cita = new Cita(null, $fec, $hor, $doc, $med, $con, "Solicitada", "Ninguna");
            $gestorCita = new GestorCita();
            $id = $gestorCita->agregarCita($cita);
            
            if ($id) {
                $result = $gestorCita->consultarCitaPorId($id);
                require_once 'Vista/html/confirmarCita.php';
            } else {
                throw new Exception("Error al crear la cita");
            }
        } catch (Exception $e) {
            echo "<div class='error'>" . $e->getMessage() . "</div>";
        }
    }

    public function consultarPaciente($doc) {
        $gestorCita = new GestorCita();
        $result = $gestorCita->consultarPaciente($doc);
        require_once 'Vista/html/consultarPaciente.php';
    }

    public function agregarPaciente($doc, $nom, $ape, $fec, $sex) {
        $paciente = new Paciente($doc, $nom, $ape, $fec, $sex);
        $gestorCita = new GestorCita();
        $registros = $gestorCita->agregarPaciente($paciente);
        if ($registros > 0) {
            echo "Se insertó el paciente con éxito";
        } else {
            echo "Error al grabar el paciente";
        }
    }

    public function consultarCitas($doc) {
        $gestorCita = new GestorCita();
        $result = $gestorCita->consultarCitasPorDocumento($doc);
        require_once 'Vista/html/consultarCitas.php';
    }

    public function verCita($cita) {
        $gestorCita = new GestorCita();
        $result = $gestorCita->consultarCitaPorId($cita);
        require_once 'Vista/html/confirmarCita.php';
    }

    public function cancelarCitas($doc) {
        $gestorCita = new GestorCita();
        $result = $gestorCita->consultarCitasPorDocumento($doc);
        require_once 'Vista/html/cancelarCitas.php';
    }

    public function confirmarCancelarCita($cita) {
        $gestorCita = new GestorCita();
        $registros = $gestorCita->cancelarCita($cita);
        if ($registros > 0) {
            echo "La cita se ha cancelado con éxito";
        } else {
            echo "Hubo un error al cancelar la cita";
        }
    }

    public function consultarHorasDisponibles($medico, $fecha) {
        $gestorCita = new GestorCita();
        $result = $gestorCita->consultarHorasDisponibles($medico, $fecha);
        require_once 'Vista/html/consultarHoras.php';
    }
}