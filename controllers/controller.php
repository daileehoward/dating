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
            global $member;
            global $premiumMember;

            if ($_SERVER['REQUEST_METHOD'] == 'POST')
            {
                $firstName = trim($_POST['firstName']);
                $lastName = trim($_POST['lastName']);
                $species = trim($_POST['species']);
                $age = trim($_POST['age']);
                $gender = $_POST['gender'];
                $phone = trim($_POST['phone']);
                $premium = ($_POST['premium']);

                if ($validator->validName($firstName))
                {
                    if (isset($premium))
                    {
                        $premiumMember->setFname($firstName);
                    }
                    else
                    {
                        $member->setFname($firstName);
                    }
                }
                else
                {
                    $this->_f3->set('errors["firstName"]', "*First name can't be empty and must contain only characters");
                }

                if ($validator->validName($lastName))
                {
                    if (isset($premium))
                    {
                        $premiumMember->setLname($lastName);
                    }
                    else
                    {
                        $member->setLname($lastName);
                    }
                }
                else
                {
                    $this->_f3->set('errors["lastName"]', "*Last name can't be empty and must contain only characters");
                }

                if ($validator->validAge($age))
                {
                    if (isset($premium))
                    {
                        $premiumMember->setAge($age);
                    }
                    else
                    {
                        $member->setAge($age);
                    }
                }
                else
                {
                    $this->_f3->set('errors["age"]', "*Age can't be empty and must be numeric between 18 and 118");
                }

                if ($validator->validPhone($phone))
                {
                    if (isset($premium))
                    {
                        $premiumMember->setPhone($phone);
                    }
                    else
                    {
                        $member->setPhone($phone);
                    }
                }
                else
                {
                    $this->_f3->set('errors["phone"]', "*Phone can't be empty and must be in the pattern: XXX-XXX-XXXX");
                }

                if (isset($premium))
                {
                    $premiumMember->setSpecies($species);
                    $premiumMember->setGender($gender);

                    if (empty($this->_f3->get('errors')))
                    {
                        $_SESSION['premiumMember'] = $premiumMember;
                        $this->_f3->reroute('/profile');
                    }
                }
                else
                {
                    $member->setSpecies($species);
                    $member->setGender($gender);

                    if (empty($this->_f3->get('errors')))
                    {
                        $_SESSION['member'] = $member;
                        $this->_f3->reroute('/profile');
                    }
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
                    if ($_SESSION['premiumMember'])
                    {
                        $_SESSION['premiumMember']->setEmail($email);
                    }
                    else
                    {
                        $_SESSION['member']->setEmail($email);
                    }
                }
                else
                {
                    $this->_f3->set('errors["email"]', "*Email can't be empty and must be formatted correctly");
                }

                if ($_SESSION['premiumMember'])
                {
                    $_SESSION['premiumMember']->setState($state);
                    $_SESSION['premiumMember']->setSeeking($seeking);
                    $_SESSION['premiumMember']->setBio($biography);

                    if (empty($this->_f3->get('errors')))
                    {
                        $this->_f3->reroute('/interests');
                    }
                }
                else
                {
                    $_SESSION['member']->setState($state);
                    $_SESSION['member']->setSeeking($seeking);
                    $_SESSION['member']->setBio($biography);

                    if (empty($this->_f3->get('errors')))
                    {
                        $this->_f3->reroute('/summary');
                    }
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
                    $_SESSION['premiumMember']->setIndoorInterests("No indoor interests");
                }
                else if ($validator->validIndoor($indoorInterests))
                {
                    $_SESSION['premiumMember']->setIndoorInterests($indoorInterests);
                }
                else
                {
                    $this->_f3->set('errors["indoor"]', "*Step away from the keyboard!");
                }

                if ($outdoorInterests == "")
                {
                    $_SESSION['premiumMember']->setOutdoorInterests("No outdoor interests");
                }
                else if ($validator->validOutdoor($outdoorInterests))
                {
                    $_SESSION['premiumMember']->setOutdoorInterests($outdoorInterests);
                }
                else
                {
                    $this->_f3->set('errors["outdoor"]', "*Step away from the keyboard!");
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