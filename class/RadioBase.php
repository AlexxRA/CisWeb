<?php
    class RadioBase{
        private $id_rb;
        private $id_bs;
        private $sector;
        private $dist_rb;
        private $rss_rb;
        private $ip_rb;
        private $id_pmi;
        private $id_sitio;

        public function __construct($id_rb, $id_bs, $sector, $dist_rb, $rss_rb, $ip_rb, $id_pmi, $id_sitio)
        {
            $this->id_rb = $id_rb;
            $this->id_bs = $id_bs;
            $this->sector = $sector;
            $this->dist_rb = $dist_rb;
            $this->rss_rb = $rss_rb;
            $this->ip_rb = $ip_rb;
            $this->id_pmi = $id_pmi;
            $this->id_sitio = $id_sitio;
        }

        public function getIdRb()
        {
            return $this->id_rb;
        }

        public function setIdRb($id_rb)
        {
            $this->id_rb = $id_rb;
        }

        public function getIdBs()
        {
            return $this->id_bs;
        }

        public function setIdBs($id_bs)
        {
            $this->id_bs = $id_bs;
        }

        public function getSector()
        {
            return $this->sector;
        }

        public function setSector($sector)
        {
            $this->sector = $sector;
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

        public function getIdSitio()
        {
            return $this->id_sitio;
        }

        public function setIdSitio($id_sitio)
        {
            $this->id_sitio = $id_sitio;
        }

        public function getSQL()
        {
            return "'".$this->id_rb."','".$this->id_bs."','".$this->sector."','".$this->dist_rb."','".$this->rss_rb."','".$this->ip_rb."','".$this->id_pmi."','".$this->id_sitio."'";
        }

        public function UpdateSQL(){
            return "id_rb='$this->id_rb', id_bs='$this->id_bs', sector='$this->sector', dist_rb='$this->dist_rb', rss_rb='$this->rss_rb', ip_rb='$this->ip_rb', id_pmi='$this->id_pmi', id_sitio='$this->id_sitio'";
        }

    }
?>