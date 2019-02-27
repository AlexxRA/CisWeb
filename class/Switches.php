<?php
    class Switches{
        private $ns_sw;
        private $ip_sw;
        private $mac_sw;
        private $tipo;
        private $conexion;
        private $fecha_inst;
        private $id_pmi;
        private $id_vlan;

        public function getNsSw()
        {
            return $this->ns_sw;
        }

        public function setNsSw($ns_sw)
        {
            $this->ns_sw = $ns_sw;
        }

        public function getIpSw()
        {
            return $this->ip_sw;
        }

        public function setIpSw($ip_sw)
        {
            $this->ip_sw = $ip_sw;
        }

        public function getMacSw()
        {
            return $this->mac_sw;
        }

        public function setMacSw($mac_sw)
        {
            $this->mac_sw = $mac_sw;
        }

        public function getTipo()
        {
            return $this->tipo;
        }

        public function setTipo($tipo)
        {
            $this->tipo = $tipo;
        }

        public function getConexion()
        {
            return $this->conexion;
        }

        public function setConexion($conexion)
        {
            $this->conexion = $conexion;
        }

        public function getFechaInst()
        {
            return $this->fecha_inst;
        }

        public function setFechaInst($fecha_inst)
        {
            $this->fecha_inst = $fecha_inst;
        }

        public function getIdPmi()
        {
            return $this->id_pmi;
        }

        public function setIdPmi($id_pmi)
        {
            $this->id_pmi = $id_pmi;
        }

        public function __construct($ns_sw, $ip_sw, $mac_sw, $tipo, $conexion, $fecha_inst, $id_pmi,$id_vlan)
        {
            $this->ns_sw = $ns_sw;
            $this->ip_sw = $ip_sw;
            $this->mac_sw = $mac_sw;
            $this->tipo = $tipo;
            $this->conexion = $conexion;
            $this->fecha_inst = $fecha_inst;
            $this->id_pmi = $id_pmi;
            $this->id_vlan=$id_vlan;
        }

        public function getSQL(){
            return "'$this->ns_sw','$this->mac_sw','$this->ip_sw','$this->tipo','$this->conexion','$this->fecha_inst','$this->id_pmi','$this->id_vlan'";
        }

        public function UpdateSQL(){
            return "ns_sw='$this->ns_sw', mac_sw='$this->mac_sw', ip_sw='$this->ip_sw', tipo='$this->tipo', conexion='$this->conexion', fecha_inst='$this->fecha_inst', id_pmi='$this->id_pmi',id_vlan='$this->id_vlan'";
        }

    }
?>