<?php
    class premium_member extends member
    {
        private $_indoorInterests;
        private $_outdoorInterests;

        /**
         * @return mixed
         */
        public function getIndoorInterests()
        {
            return $this->_indoorInterests;
        }

        /**
         * @param mixed $indoorInterests
         */
        public function setIndoorInterests($indoorInterests): void
        {
            $this->_indoorInterests = $indoorInterests;
        }

        /**
         * @return mixed
         */
        public function getOutdoorInterests()
        {
            return $this->_outdoorInterests;
        }

        /**
         * @param mixed $outdoorInterests
         */
        public function setOutdoorInterests($outdoorInterests): void
        {
            $this->_outdoorInterests = $outdoorInterests;
        }
    }