<?php
    class RadioBase{
        private $id_rb;
        private $dist_rb;
        private $rss_rb;
        private $ip_rb;
        private $id_pmi;
        private $id_sector;

        public function __construct($id_rb, $dist_rb, $rss_rb, $ip_rb, $id_pmi, $id_sector)
        {
            $this->id_rb = $id_rb;
            $this->dist_rb = $dist_rb;
            $this->rss_rb = $rss_rb;
            $this->ip_rb = $ip_rb;
            $this->id_pmi = $id_pmi;
            $this->id_sector = $id_sector;
        }

        public function getIdRb()
        {
            return $this->id_rb;
        }

        public function setIdRb($id_rb)
        {
            $this->id_rb = $id_rb;
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
            return "'".$this->id_rb."','".$this->dist_rb."','".$this->rss_rb."','".$this->ip_rb."','".$this->id_pmi."','".$this->id_sector."'";
        }

        public function UpdateSQL(){
            return "id_rb='$this->id_rb', dist_rb='$this->dist_rb', rss_rb='$this->rss_rb', ip_rb='$this->ip_rb', id_pmi='$this->id_pmi', id_sector='$this->id_sector'";
        }

    }
?>