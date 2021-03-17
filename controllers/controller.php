<?php
    class Controller
    {
        private $_f3;

        function __construct($f3)
        {
            $this->_f3 = $f3;
        }

        function home()
        {
            $view = new Template();
            echo $view->render('views/home.html');
        }

        function personalInformation()
        {
            global $validator;
            global $dataLayer;

            if ($_SERVER['REQUEST_METHOD'] == 'POST')
            {
                $firstName = trim($_POST['firstName']);
                $lastName = trim($_POST['lastName']);
                $species = trim($_POST['species']);
                $age = trim($_POST['age']);
                $gender = $_POST['gender'];
                $phone = trim($_POST['phone']);

                if ($validator->validName($firstName) && $validator->validName($lastName))
                {
                    $_SESSION['name'] = $firstName . " " . $lastName;
                }
                else
                {
                    if (!$validator->validName($firstName))
                    {
                        $this->_f3->set('errors["firstName"]', "*First name can't be empty and must contain only characters");
                    }

                    if (!$validator->validName($lastName))
                    {
                        $this->_f3->set('errors["lastName"]', "*Last name can't be empty and must contain only characters");
                    }
                }

                if ($validator->validAge($age))
                {
                    $_SESSION['age'] = $age;
                }
                else
                {
                    $this->_f3->set('errors["age"]', "*Age can't be empty and must be numeric between 18 and 118");
                }

                if ($validator->validPhone($phone))
                {
                    $_SESSION['phone'] = $_POST['phone'];
                }
                else
                {
                    $this->_f3->set('errors["phone"]', "*Phone can't be empty and must be in the pattern: XXX-XXX-XXXX");
                }

                $_SESSION['species'] = $species;
                $_SESSION['gender'] = $gender;

                if (empty($this->_f3->get('errors')))
                {
                    $this->_f3->reroute('/profile');
                }
            }

            $this->_f3->set('arrayGenders', $dataLayer->getGenders());

            $this->_f3->set('firstName', isset($firstName) ? $firstName : "");
            $this->_f3->set('lastName', isset($lastName) ? $lastName : "");
            $this->_f3->set('species', isset($species) ? $species : "");
            $this->_f3->set('age', isset($age) ? $age : "");
            $this->_f3->set('gender', isset($gender) ? $gender : "");
            $this->_f3->set('phone', isset($phone) ? $phone : "");

            // Display the view
            $view = new Template();
            echo $view->render('views/personal-information-form.html');
        }

        function profile()
        {
            global $validator;
            global $dataLayer;

            if ($_SERVER['REQUEST_METHOD'] == 'POST')
            {
                $email = trim($_POST['email']);
                $state = trim($_POST['state']);
                $seeking = $_POST['seeking'];
                $biography = $_POST['biography'];

                if ($validator->validEmail($email))
                {
                    $_SESSION['email'] = $email;
                }
                else
                {
                    $this->_f3->set('errors["email"]', "*Email can't be empty and must be formatted correctly");
                }

                $_SESSION['state'] = $state;
                $_SESSION['seeking'] = $seeking;
                $_SESSION['biography'] = $biography;

                if (empty($this->_f3->get('errors')))
                {
                    $this->_f3->reroute('/interests');
                }
            }

            $this->_f3->set('arrayGenders', $dataLayer->getGenders());

            $this->_f3->set("email", isset($email) ? $email : "");
            $this->_f3->set('state', isset($state) ? $state : "");
            $this->_f3->set('seeking', isset($seeking) ? $seeking : "");
            $this->_f3->set('biography', isset($biography) ? $biography : "");

            // Display the view
            $view = new Template();
            echo $view->render('views/profile-form.html');
        }

        function interests()
        {
            global $validator;
            global $dataLayer;

            if ($_SERVER['REQUEST_METHOD'] == 'POST')
            {
                $indoorInterests = $_POST['indoor'];
                $outdoorInterests = $_POST['outdoor'];

                if ($indoorInterests == "")
                {
                    $_SESSION['indoorInterests'] = "No indoor interests";
                }
                else if ($validator->validIndoor($indoorInterests))
                {
                    $_SESSION['indoorInterests'] = implode(", ", $indoorInterests);
                }
                else
                {
                    $this->_f3->set('errors["indoor"]', "*Select at least one indoor interest");
                }

                if ($outdoorInterests == "")
                {
                    $_SESSION['outdoorInterests'] = "No outdoor interests";
                }
                else if ($validator->validOutdoor($outdoorInterests))
                {
                    $_SESSION['outdoorInterests'] = implode(", ", $outdoorInterests);
                }
                else
                {
                    $this->_f3->set('errors["outdoor"]', "*Select at least one outdoor interest");
                }

                if (!empty($_SESSION['indoorInterests']) && !empty($_SESSION['outdoorInterests']))
                {
                    $_SESSION['interests'] = $_SESSION['indoorInterests'] . ", " . $_SESSION['outdoorInterests'];
                }

                if (empty($this->_f3->get('errors')))
                {
                    $this->_f3->reroute('/summary');
                }
            }

            $this->_f3->set('indoorInterests', $dataLayer->getIndoorInterests());
            $this->_f3->set('outdoorInterests', $dataLayer->getOutdoorInterests());

            $this->_f3->set("indoor", isset($indoorInterests) ? $indoorInterests : "");
            $this->_f3->set("outdoor", isset($outdoorInterests) ? $outdoorInterests : "");

            // Display the view
            $view = new Template();
            echo $view->render('views/interests-form.html');
        }

        function summary()
        {
            $view = new Template();
            echo $view->render('views/profile-summary.html');
        }
    }