<?php
    class Switches{
        private $ns_sw;
        private $ip_sw;
        private $mac_sw;
        private $tipo;
        private $conexion;

        /**
         * @return mixed
         */
        public function getNsSw()
        {
            return $this->ns_sw;
        }

        /**
         * @param mixed $ns_sw
         */
        public function setNsSw($ns_sw)
        {
            $this->ns_sw = $ns_sw;
        }

        /**
         * @return mixed
         */
        public function getIpSw()
        {
            return $this->ip_sw;
        }

        /**
         * @param mixed $ip_sw
         */
        public function setIpSw($ip_sw)
        {
            $this->ip_sw = $ip_sw;
        }

        /**
         * @return mixed
         */
        public function getMacSw()
        {
            return $this->mac_sw;
        }

        /**
         * @param mixed $mac_sw
         */
        public function setMacSw($mac_sw)
        {
            $this->mac_sw = $mac_sw;
        }

        /**
         * @return mixed
         */
        public function getTipo()
        {
            return $this->tipo;
        }

        /**
         * @param mixed $tipo
         */
        public function setTipo($tipo)
        {
            $this->tipo = $tipo;
        }

        /**
         * @return mixed
         */
        public function getConexion()
        {
            return $this->conexion;
        }

        /**
         * @param mixed $conexion
         */
        public function setConexion($conexion)
        {
            $this->conexion = $conexion;
        }

        /**
         * @return mixed
         */
        public function getFechaInst()
        {
            return $this->fecha_inst;
        }

        /**
         * @param mixed $fecha_inst
         */
        public function setFechaInst($fecha_inst)
        {
            $this->fecha_inst = $fecha_inst;
        }

        /**
         * @return mixed
         */
        public function getIdPmi()
        {
            return $this->id_pmi;
        }

        /**
         * @param mixed $id_pmi
         */
        public function setIdPmi($id_pmi)
        {
            $this->id_pmi = $id_pmi;
        }
        private $fecha_inst;
        private $id_pmi;


        public function __construct($ns_sw, $ip_sw, $mac_sw, $tipo, $conexion, $fecha_inst, $id_pmi)
        {
            $this->ns_sw = $ns_sw;
            $this->ip_sw = $ip_sw;
            $this->mac_sw = $mac_sw;
            $this->tipo = $tipo;
            $this->conexion = $conexion;
            $this->fecha_inst = $fecha_inst;
            $this->id_pmi = $id_pmi;
        }

        public function getSQL(){
            return "'$this->ns_sw','$this->mac_sw','$this->ip_sw','$this->tipo','$this->conexion','$this->fecha_inst','$this->id_pmi'";
        }

    }

?>