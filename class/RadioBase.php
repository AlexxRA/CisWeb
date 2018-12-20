<?php
    class RadioBase{
        private $dist_rb;
        private $rss_rb;
        private $ip_rb;
        private $id_sitio;
        private $sector;

        public function __construct($dist_rb, $rss_rb, $ip_rb, $id_sitio, $sector)
        {
            $this->dist_rb = $dist_rb;
            $this->rss_rb = $rss_rb;
            $this->ip_rb = $ip_rb;
            $this->sector = $sector;
            $this->id_sitio = $id_sitio;
        }

        public function getDistRb()
        {
            return $this->dist_rb;
        }

        public function setDistRb($dist_rb)
        {
            $this->dist_rb = $dist_rb;
        }

        public function getRssRb()
        {
            return $this->rss_rb;
        }

        public function setRssRb($rss_rb)
        {
            $this->rss_rb = $rss_rb;
        }

        public function getIpRb()
        {
            return $this->ip_rb;
        }

        public function setIpRb($ip_rb)
        {
            $this->ip_rb = $ip_rb;
        }

        public function getIdPmi()
        {
            return $this->id_pmi;
        }

        public function setIdPmi($id_pmi)
        {
            $this->id_pmi = $id_pmi;
        }

        public function getIdSector()
        {
            return $this->id_sector;
        }

        public function setIdSector($id_sector)
        {
            $this->id_sector = $id_sector;
        }

        public function getSQL()
        {
            return "'".$this->dist_rb."','".$this->rss_rb."','".$this->ip_rb."','".$this->sector."','".$this->id_sitio."'";
        }

        public function UpdateSQL(){
            return "dist_rb='$this->dist_rb', rss_rb='$this->rss_rb', ip_rb='$this->ip_rb', id_sitio='$this->id_sitio', sector='$this->sector'";
        }

    }
?>