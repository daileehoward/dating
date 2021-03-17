<?php
    /**
     * @author Dailee Howard
     * @file data-layer.php
     * @description This file contains the methods used to handle the content for the views.
     */

    class DataLayer
    {
        /**
         * Returns an indoor interests array for the interests page.
         * @return string[] indoor interests array
         */
        function getIndoorInterests()
        {
            return array("sleep", "steal treats", "window watching", "hide and seek", "learn new tricks", "scratch furniture",
                "grooming time", "cuddle");
        }

        /**
         * Returns an outdoor interests array for the interests page.
         * @return string[] outdoor interests array
         */
        function getOutdoorInterests()
        {
            return array("fetch", "car ride", "sun bathing", "visit the park", "swimming", "chase wildlife", "get muddy",
                "jump fences");
        }

        function getGenders()
        {
            return array("male", "female");
        }
    }
