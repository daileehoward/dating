<?php
    class Member
    {
        private $_fname;
        private $_lname;
        private $_species;
        private $_age;
        private $_gender;
        private $_phone;
        private $_email;
        private $_state;
        private $_seeking;
        private $_bio;

        /**
         * @return mixed
         */
        public function getFname()
        {
            return $this->_fname;
        }

        /**
         * @param mixed $fname
         */
        public function setFname($fname): void
        {
            $this->_fname = $fname;
        }

        /**
         * @return mixed
         */
        public function getLname()
        {
            return $this->_lname;
        }

        /**
         * @param mixed $lname
         */
        public function setLname($lname): void
        {
            $this->_lname = $lname;
        }

        /**
         * @return mixed
         */
        public function getSpecies()
        {
            return $this->_species;
        }

        /**
         * @param mixed $fname
         */
        public function setSpecies($species): void
        {
            $this->_species = $species;
        }

        /**
         * @return mixed
         */
        public function getAge()
        {
            return $this->_age;
        }

        /**
         * @param mixed $age
         */
        public function setAge($age): void
        {
            $this->_age = $age;
        }

        /**
         * @return mixed
         */
        public function getGender()
        {
            return $this->_gender;
        }

        /**
         * @param mixed $gender
         */
        public function setGender($gender): void
        {
            $this->_gender = $gender;
        }

        /**
         * @return mixed
         */
        public function getPhone()
        {
            return $this->_phone;
        }

        /**
         * @param mixed $phone
         */
        public function setPhone($phone): void
        {
            $this->_phone = $phone;
        }

        /**
         * @return mixed
         */
        public function getEmail()
        {
            return $this->_email;
        }

        /**
         * @param mixed $email
         */
        public function setEmail($email): void
        {
            $this->_email = $email;
        }

        /**
         * @return mixed
         */
        public function getState()
        {
            return $this->_state;
        }

        /**
         * @param mixed $state
         */
        public function setState($state): void
        {
            $this->_state = $state;
        }

        /**
         * @return mixed
         */
        public function getSeeking()
        {
            return $this->_seeking;
        }

        /**
         * @param mixed $seeking
         */
        public function setSeeking($seeking): void
        {
            $this->_seeking = $seeking;
        }

        /**
         * @return mixed
         */
        public function getBio()
        {
            return $this->_bio;
        }

        /**
         * @param mixed $bio
         */
        public function setBio($bio): void
        {
            $this->_bio = $bio;
        }
    }