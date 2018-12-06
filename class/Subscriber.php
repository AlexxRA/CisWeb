<?php
    class Subscriber{
        private $ns_sus;
        private $ip_sus;
        private $mac_sus;
        private $azimuth;
        private $rss_sus;
        private $id_pmi;
        private $id_rb;

        public function __construct($ns_sus, $ip_sus, $mac_sus, $azimuth, $rss_sus, $id_pmi, $id_rb)
        {
            $this->ns_sus = $ns_sus;
            $this->ip_sus = $ip_sus;
            $this->mac_sus = $mac_sus;
            $this->azimuth = $azimuth;
            $this->rss_sus = $rss_sus;
            $this->id_pmi = $id_pmi;
            $this->id_rb = $id_rb;
        }

        public function getNsSus()
        {
            return $this->ns_sus;
        }

        public function setNsSus($ns_sus)
        {
            $this->ns_sus = $ns_sus;
        }

        public function getIpSus()
        {
            return $this->ip_sus;
        }

        public function setIpSus($ip_sus)
        {
            $this->ip_sus = $ip_sus;
        }

        public function getMacSus()
        {
            return $this->mac_sus;
        }

        public function setMacSus($mac_sus)
        {
            $this->mac_sus = $mac_sus;
        }

        public function getAzimuth()
        {
            return $this->azimuth;
        }

        public function setAzimuth($azimuth)
        {
            $this->azimuth = $azimuth;
        }

        public function getRssSus()
        {
            return $this->rss_sus;
        }

        public function setRssSus($rss_sus)
        {
            $this->rss_sus = $rss_sus;
        }

        public function getIdPmi()
        {
            return $this->id_pmi;
        }

        public function setIdPmi($id_pmi)
        {
            $this->id_pmi = $id_pmi;
        }

        public function getIdRb()
        {
            return $this->id_rb;
        }

        public function setIdRb($id_rb)
        {
            $this->id_rb = $id_rb;
        }

        public function getSQL()
        {
            return "'".$this->ns_sus."','".$this->ip_sus."','".$this->mac_sus."','".$this->azimuth."','".$this->rss_sus."','".$this->id_pmi."','".$this->id_rb."'";
        }

        public function UpdateSQL(){
            return "ns_sus='$this->ns_sus', ip_sus='$this->ip_sus', mac_sus='$this->mac_sus', azimuth='$this->azimuth', rss_sus='$this->rss_sus', id_pmi='$this->id_pmi', id_rb='$this->id_rb'";
        }

    }
?>