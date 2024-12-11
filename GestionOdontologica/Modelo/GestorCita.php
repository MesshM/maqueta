<?php
require_once 'Conexion.php';
require_once 'Cita.php';
require_once 'Paciente.php';

class GestorCita {
    private $conexion;

    public function __construct() {
        $this->conexion = new Conexion();
    }

    public function agregarCita(Cita $cita) {
        try {
            $fecha = $cita->obtenerFecha();
            $hora = $cita->obtenerHora();
            $paciente = $cita->obtenerPaciente();
            $medico = $cita->obtenerMedico();
            $consultorio = $cita->obtenerConsultorio();
            $estado = $cita->obtenerEstado();
            $observaciones = $cita->obtenerObservaciones();
    
            // Verificar que la hora no esté vacía
            if (empty($hora)) {
                throw new Exception("La hora es obligatoria");
            }
    
            // Verificar si el paciente existe
            $sqlVerificar = "SELECT PacIdentificacion FROM Pacientes WHERE PacIdentificacion = '$paciente'";
            $resultado = $this->conexion->consulta($sqlVerificar);
            
            if (!$resultado || $resultado->num_rows == 0) {
                throw new Exception("El paciente no existe en el sistema");
            }
    
            $sql = "INSERT INTO citas (CitFecha, CitHora, CitPaciente, CitMedico, CitConsultorio, CitEstado, CitObservaciones) 
                    VALUES ('$fecha', '$hora', '$paciente', '$medico', '$consultorio', '$estado', '$observaciones')";
            
            if ($this->conexion->consulta($sql)) {
                return $this->conexion->obtenerCitaId();
            }
            return false;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function consultarCitaPorId($id) {
        $sql = "SELECT c.*, 
                p.PacNombres, p.PacApellidos,
                m.MedNombres, m.MedApellidos,
                co.ConNombre
                FROM citas c
                LEFT JOIN Pacientes p ON c.CitPaciente = p.PacIdentificacion
                LEFT JOIN Medicos m ON c.CitMedico = m.MedIdentificacion
                LEFT JOIN Consultorios co ON c.CitConsultorio = co.ConNumero
                WHERE c.CitNumero = $id";
        
        return $this->conexion->consulta($sql);
    }

    public function consultarCitasPorDocumento($doc) {
        $sql = "SELECT * FROM citas WHERE CitPaciente = '$doc' AND CitEstado = 'Solicitada'";
        return $this->conexion->consulta($sql);
    }

    public function consultarPaciente($doc) {
        $sql = "SELECT * FROM Pacientes WHERE PacIdentificacion = '$doc'";
        return $this->conexion->consulta($sql);
    }

    public function agregarPaciente(Paciente $paciente) {
        $identificacion = $paciente->obtenerIdentificacion();
        $nombres = $paciente->obtenerNombres();
        $apellidos = $paciente->obtenerApellidos();
        $fechaNacimiento = $paciente->obtenerFechaNacimiento();
        $sexo = $paciente->obtenerSexo();
        
        $sql = "INSERT INTO Pacientes VALUES ('$identificacion', '$nombres', '$apellidos', '$fechaNacimiento', '$sexo')";
        $this->conexion->consulta($sql);
        return $this->conexion->obtenerFilasAfectadas();
    }

    public function consultarMedicos() {
        $sql = "SELECT * FROM Medicos";
        return $this->conexion->consulta($sql);
    }

    public function consultarConsultorios() {
        $sql = "SELECT * FROM Consultorios";
        return $this->conexion->consulta($sql);
    }

    public function consultarHorasDisponibles($medico, $fecha) {
        $sql = "SELECT hora FROM horas WHERE hora NOT IN 
                (SELECT CitHora FROM citas 
                WHERE CitMedico = '$medico' 
                AND CitFecha = '$fecha' 
                AND CitEstado IN ('Asignada', 'Solicitada'))
                ORDER BY hora";
        return $this->conexion->consulta($sql);
    }

    public function cancelarCita($cita) {
        $sql = "UPDATE citas SET CitEstado = 'Cancelada' WHERE CitNumero = $cita";
        $this->conexion->consulta($sql);
        return $this->conexion->obtenerFilasAfectadas();
    }
}