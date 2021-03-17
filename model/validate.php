<?php
    class Validate
    {
        private $_dataLayer;

        function __construct($dataLayer)
        {
            $this->_dataLayer = $dataLayer;
        }

        function validName($name)
        {
            return !empty($name) && ctype_alpha($name);
        }

        function validAge($age)
        {
            return !empty($age) && is_numeric($age) && $age >= 18 && $age <= 118;
        }

        function validPhone($phone)
        {
            return !empty($phone) && preg_match("/^([1]-)?[0-9]{3}-[0-9]{3}-[0-9]{4}$/i", $phone);
        }

        function validEmail($email)
        {
            return !empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL);
        }

        function validOutdoor($outdoorInterests)
        {
            $validOutdoorInterests = $this->_dataLayer->getOutdoorInterests();

            foreach ($outdoorInterests as $outdoorInterest)
            {
                if (!in_array($outdoorInterest, $validOutdoorInterests))
                {
                    return false;
                }
            }

            return true;
        }

        function validIndoor($indoorInterests)
        {
            $validIndoorInterests = $this->_dataLayer->getIndoorInterests();

            foreach ($indoorInterests as $indoorInterest)
            {
                if (!in_array($indoorInterest, $validIndoorInterests))
                {
                    return false;
                }
            }

            return true;
        }
    }