<?php
    class Usuario {
        private $codUsuario;
        private $password;
        private $descUsuario;
        private $numConexiones;
        private $fechaHoraUltimaConexion;
        private $fechaHoraUltimaConexionAnterior;
        private $perfil;
        private $imagenUsuario;
        
        public function __construct($codUsuario,$password,$descUsuario,$numConexiones,$fechaHoraUltimaConexion,$perfil,$imagenUsuario,$fechaHoraUltimaConexionAnterior) {
            $this->codUsuario = $codUsuario;
            $this->password = $password;
            $this->descUsuario = $descUsuario;
            $this->numConexiones = $numConexiones;
            $this->fechaHoraUltimaConexion = $fechaHoraUltimaConexion;
            $this->perfil = $perfil;
            $this->imagenUsuario = $imagenUsuario==null?'':$imagenUsuario;
            $this->fechaHoraUltimaConexionAnterior=$fechaHoraUltimaConexionAnterior;
        }
        
        public function getCodUsuario() {
             return $this->codUsuario; 
        }
        public function getPassword() { 
            return $this->password; 
        }
        public function getDescUsuario() { 
            return $this->descUsuario; 
        }
        public function getPerfil() { 
            return $this->perfil; 
        }
        public function getNumConexiones() { 
            return $this->numConexiones; 
        }
        public function getFechaHoraUltimaConexion() { 
            return $this->fechaHoraUltimaConexion; 
        }
        public function setFechaHoraUltimaConexion($fecha) {
            $this->fechaHoraUltimaConexion = $fecha;
        }
        public function getFechaHoraUltimaConexionAnterior() { 
            return $this->fechaHoraUltimaConexionAnterior; 
        }
    }
?>