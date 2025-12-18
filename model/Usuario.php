<?php
    class Usuario {
        public $codUsuario;
        public $password;
        public $descUsuario;
        public $numConexiones;
        public $fechaHoraUltimaConexion;
        public $perfil;
        public $imagenUsuario;
        public $fechaHoraUltimaConexionAnterior;

        // getters (mínimos necesarios)
        public function getCodUsuario() {
             return $this->codUsuario; 
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
        public function getFechaHoraUltimaConexionAnterior() { 
            return $this->fechaHoraUltimaConexionAnterior; 
        }
    }
?>