<?php
    class Validate
    {
        private $_dataLayer;

        /*
        function __construct($dataLayer)
        {
            $this->_dataLayer = $dataLayer;
        }
        */

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

        function validOutdoor($outdoorInterests, $validOutdoorInterests)
        {
            return in_array($outdoorInterests, $validOutdoorInterests);
        }

        function validIndoor($indoorInterests, $validIndoorInterests)
        {
            return in_array($indoorInterests, $validIndoorInterests);
        }
    }