<?php
    class Boton{
        private $ext;
        private $ip_bt;
        private $mac_bt;
        private $fecha_inst;
        private $id_pmi;

        public function __construct($ext, $ip_bt, $mac_bt, $fecha_inst, $id_pmi)
        {
            $this->ext = $ext;
            $this->ip_bt = $ip_bt;
            $this->mac_bt = $mac_bt;
            $this->fecha_inst = $fecha_inst;
            $this->id_pmi = $id_pmi;
        }

        /**
         * @return mixed
         */
        public function getExt()
        {
            return $this->ext;
        }

        /**
         * @param mixed $ext
         */
        public function setExt($ext)
        {
            $this->ext = $ext;
        }

        /**
         * @return mixed
         */
        public function getIpBt()
        {
            return $this->ip_bt;
        }

        /**
         * @param mixed $ip_bt
         */
        public function setIpBt($ip_bt)
        {
            $this->ip_bt = $ip_bt;
        }

        /**
         * @return mixed
         */
        public function getMacBt()
        {
            return $this->mac_bt;
        }

        /**
         * @param mixed $mac_bt
         */
        public function setMacBt($mac_bt)
        {
            $this->mac_bt = $mac_bt;
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

        public function getSQL(){
            return "'$this->ext','$this->ip_bt','$this->mac_bt','$this->fecha_inst','$this->id_pmi'";
        }

        public function UpdateSQL(){
            return "ext='$this->ext', ip_bt='$this->ip_bt', mac_bt='$this->mac_bt', fecha_inst='$this->fecha_inst', id_pmi='$this->id_pmi'";
        }
    }
?>