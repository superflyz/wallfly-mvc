<?php
/**
 * Created by PhpStorm.
 * User: jimmykovacevic
 * Date: 4/10/2015
 * Time: 7:06 PM
 */

class PropertyTenant extends Controller
{
    public function index()
    {
        if (!Tenant::isAuthenticated()) {
            $this->redirect("/");
        } else {
            $_SESSION['sidebar'] = "dashboard";
            $this->view("tenant/index", $_SESSION["user"]);
        }
    }

    public function manage()
    {
        if (!Tenant::isAuthenticated()) {
            $this->redirect('/');
        } else {
            $data = [];
            $data['property'] = isset($_SESSION['selectedProperty']) ? $_SESSION['selectedProperty'] : null;
            $data['tenant'] = $_SESSION['user'];
            $_SESSION['sidebar'] = "manage";
            $this->view('tenant/managedetails', $data);
        }
    }

    public function manageDetails()
    {
        if (!Tenant::isAuthenticated()) {
            $this->redirect('/');
        } else {
            $_SESSION['sidebar'] = "manage";
            $this->view('tenant/managedetails');
        }
    }

    public function calendar()
    {
        if (!Tenant::isAuthenticated()) {
            $this->redirect('/');
        } else {
            $this->setJavascriptDependencies([
                WEBDIR . '/dzscalendar/dzscalendar.js',
                WEBDIR . '/js/sweetalert.min.js',
                WEBDIR . '/bootstrap/bootstrap.js',
                WEBDIR . '/clockpicker/js/bootstrap.min.js',
                WEBDIR . '/clockpicker/js/timepicki.js'
            ]);
            $this->setCSSDependencies([
                WEBDIR . '/css/bootstrap.css',
                WEBDIR . '/dzstooltip/dzstooltip.css',
                WEBDIR . '/dzscalendar/dzscalendar.css',
                WEBDIR . '/css/sweetalert.css',
                WEBDIR . '/css/wallfly.css',
                WEBDIR . '/clockpicker/css/timepicki.css'
            ]);
            $_SESSION['sidebar'] = "calendar";
            $this->view('tenant/calendar');
        }
    }

    public function chat()
    {
        if (!Tenant::isAuthenticated()) {
            $this->redirect('/');
        } else {

            $this->setJavascriptDependencies([
                WEBDIR . '/js/chat.js'
            ]);

            $this->setCSSDependencies([
                WEBDIR . '/css/module.css'
            ]);
            $_SESSION['sidebar'] = "chat";
            $this->view('tenant/chat');
        }
    }

    public function payment()
    {
        if (!Tenant::isAuthenticated()) {
            $this->redirect('/');
        } else {
            $this->setJavascriptDependencies([
                WEBDIR . '/js/selectProperty.js',
                WEBDIR . '/dzscalendar/dzscalendar.js',
                WEBDIR . '/js/paymentDatePicker.js',
                WEBDIR . '/js/jquery.creditCardValidator.js',
                WEBDIR . '/js/validateCreditCard.js'
            ]);
            $this->setCSSDependencies([
                WEBDIR . '/css/module.css',
                WEBDIR . '/dzstooltip/dzstooltip.css',
                WEBDIR . '/dzscalendar/dzscalendar.css'
            ]);
            $_SESSION['sidebar'] = "payment";
            $this->view('tenant/payment');
        }
    }

    public function viewPayments()
    {
        if (!Tenant::isAuthenticated()) {
            $this->redirect('/');
        } else {
            $_SESSION['sidebar'] = "payment";
            $this->view('tenant/viewpayments');
        }
    }

    public function addPayment()
    {
        if (!Tenant::isAuthenticated()) {
            $this->redirect('/');
        } else {
            $this->setJavascriptDependencies([
                WEBDIR . '/dzscalendar/dzscalendar.js',
                WEBDIR . '/js/paymentDatePicker.js',
                WEBDIR . '/js/jquery.creditCardValidator.js',
                WEBDIR . '/js/validateCreditCard.js'
            ]);

            $this->setCSSDependencies([
                'http://fonts.googleapis.com/css?family=Carrois+Gothic',
                WEBDIR . '/dzstooltip/dzstooltip.css',
                WEBDIR . '/dzscalendar/dzscalendar.css',
                'http://fonts.googleapis.com/css?family=Open+Sans',
                WEBDIR . '/css/module.css'
            ]);
            $_SESSION['sidebar'] = "payment";
            $this->view('tenant/addpayment');
        }
    }

    public function processPayment()
    {
        if (!Tenant::isAuthenticated()) {
            $this->redirect('/');
        } else {
            $startDate = explode('-', $_POST['startDate']);
            $endDate = explode('-', $_POST['endDate']);
            if (count($startDate) == 3 && count($endDate) == 3) {
                $validStartDate = checkdate($startDate[1], $startDate[0], $startDate[2]);
                $validEndDate = checkdate($endDate[1], $endDate[0], $endDate[2]);
            } else {
                $validStartDate = false;
                $validEndDate = false;
            }
            if ($validStartDate && $validEndDate && isset($_POST['payeeName']) && isset($_POST['startDate']) &&
                isset($_POST['endDate']) && isset($_POST['amount']) && isset($_POST['ccv']) &&
                !empty($_POST['payeeName']) && !empty($_POST['startDate']) &&
                !empty($_POST['endDate']) && !empty($_POST['amount']) && !empty($_POST['ccv'])) {
                $result = $_SESSION['selectedProperty']->addPayment($_POST['payeeName'], $_POST['startDate'], $_POST['endDate'],
                    $_POST['amount']);
            } else {
                $result = false;
            }
            if ($result == false) {
                $_SESSION['sidebar'] = "payment";
                $this->redirect('/propertytenant/payment');
            } else {
                $_SESSION['sidebar'] = "payment";
                Notification::addNotification($_SESSION['selectedProperty']->agent_id, "Payment made for " . $_SESSION['selectedProperty']->address . ".");
                Notification::addNotification($_SESSION['selectedProperty']->owner_id, "Payment made for " . $_SESSION['selectedProperty']->address . ".");
                $this->redirect('/propertytenant/payment');
            }
        }
    }

    public function addPaymentError()
    {
        if (!Tenant::isAuthenticated()) {
            $this->redirect('/');
        } else {
            $this->setJavascriptDependencies([
                WEBDIR . '/dzscalendar/dzscalendar.js',
                WEBDIR . '/js/paymentDatePicker.js',
                WEBDIR . '/js/jquery.creditCardValidator.js',
                WEBDIR . '/js/validateCreditCard.js'
            ]);
            $this->setCSSDependencies([
                'http://fonts.googleapis.com/css?family=Carrois+Gothic',
                WEBDIR . '/dzstooltip/dzstooltip.css',
                WEBDIR . '/dzscalendar/dzscalendar.css',
                'http://fonts.googleapis.com/css?family=Open+Sans',
                WEBDIR . '/css/module.css'
            ]);
            $_SESSION['sidebar'] = "payment";
            $this->view('tenant/addpaymenterror');
        }
    }

    public function repair()
    {
        if (!Tenant::isAuthenticated()) {
            $this->redirect('/');
        } else {
            $this->setJavascriptDependencies([
                WEBDIR . '/js/selectProperty.js'
            ]);
            $this->setCSSDependencies([
          //      WEBDIR . '/css/module.css'
            ]);
            $_SESSION['sidebar'] = "repair";
            $this->view('tenant/repair');
        }
    }

    public function viewRepairs()
    {
        if (!Tenant::isAuthenticated()) {
            $this->redirect('/');
        } else {
            $this->setJavascriptDependencies([
                WEBDIR . '/js/selectProperty.js'
            ]);
            $this->setCSSDependencies([
                WEBDIR . '/css/module.css'
            ]);
            $_SESSION['sidebar'] = "repair";
            $this->view('tenant/viewrepairs');
        }
    }

    public function repairRequest()
    {
        if (!Tenant::isAuthenticated()) {
            $this->redirect('/');
        } else {
            $this->setJavascriptDependencies([
                WEBDIR . '/js/selectProperty.js'
            ]);
            $this->setCSSDependencies([
                WEBDIR . '/css/module.css'
            ]);
            $_SESSION['sidebar'] = "repair";
            //Notification::addNotification($_SESSION['selectedProperty']->agent_id, "Repair request made for " . $_SESSION['selectedProperty']->address . ".");
            //Notification::addNotification($_SESSION['selectedProperty']->owner_id, "Repair request made for " . $_SESSION['selectedProperty']->address . ".");
            $this->view('tenant/repairrequest');
        }
    }

    public function changeSeverity()
    {
        if (!Tenant::isAuthenticated()) {
            $this->redirect('/');
        } else {
            //do some checks if post submit is empty blah blah
            $result = $_SESSION['selectedProperty']->changeSeverity($_POST['submit'], $_POST['severity']);
            $this->setJavascriptDependencies([
                WEBDIR . '/js/selectProperty.js'
            ]);
            $this->setCSSDependencies([
                WEBDIR . '/css/module.css'
            ]);
            Notification::addNotification($_SESSION['selectedProperty']->agent_id, "Repair severity level changed for " . $_SESSION['selectedProperty']->address . ".");
            Notification::addNotification($_SESSION['selectedProperty']->owner_id, "Repair severity level changed for " . $_SESSION['selectedProperty']->address . ".");
            $_SESSION['sidebar'] = "repair";
            $this->redirect('/propertytenant/repair');
        }
    }

    public function processRepairRequest()
    {
        if (!Tenant::isAuthenticated()) {
            $this->redirect('/');
        } else {
            if (!isset($_FILES['image']) || empty($_FILES['image'])) {
                $this->redirect('/propertytenant/repairrequest');
            }
            $fileName = $_FILES['image']['name'];
            $uploadDir = '/img/repair/';
            $target_file = $uploadDir . uniqid() . basename($fileName);

            if ($_FILES['image']['size'] > 0) {
                function random_string($length)
                {
                    $key = '';
                    $keys = array_merge(range(0, 9), range('a', 'z'));
                    for ($i = 0; $i < $length; $i++) {
                        $key .= $keys[array_rand($keys)];
                    }
                    return $key;
                }
                $tmpName = $_FILES['image']['tmp_name'];
                $fileSize = $_FILES['image']['size'];
                $fileType = $_FILES['image']['type'];
                $uploadOk = 1;
                // Check if image file is a actual image or fake image
                if (isset($_POST["submit"])) {
                    $check = getimagesize($fileName);
                    if ($fileSize > 0) {
                        echo "File is an image - " . $check["mime"] . ".";
                        $uploadOk = 1;
                    } else {
                        echo "File is not an image.";
                        $uploadOk = 0;
                    }
                }
                // Check if file already exists
                if (file_exists($target_file)) {
                    $uploadOk = 0;
                }
                // Check file size
                if ($fileSize > 2000000) {
                    echo "Sorry, your file is too large.";
                    $uploadOk = 0;
                }
                // Allow certain file formats
                if ($fileType != "image/jpg" && $fileType != "image/png" && $fileType != "image/jpeg" && $fileType != "image/gif") {
                    echo "Sorry, only JPG, JPEG, PNG and GIF files are allowed.";
                    $uqloadOk = 0;
                }
                // Check if $uqloadOk is set to 0 by an error
                if ($uploadOk == 0) {
                    //$this->view('tenant/payment');
                    echo "Sorry, your file was not uqloaded.";
                    // fie everything is ok, try to uqload file
                } else {
                    $result_upload = move_uploaded_file($tmpName, PUBLIC_ABSOLUTE_PATH .$target_file);
                }
            }

            $result = $_SESSION['selectedProperty']->addRepairRequest($_POST['subject'], $_POST['description'],
                $_POST['severity'], $target_file);
            Notification::addNotification($_SESSION['selectedProperty']->agent_id, "Repair request made for " . $_SESSION['selectedProperty']->address . ".");
            Notification::addNotification($_SESSION['selectedProperty']->owner_id, "Repair request made for " . $_SESSION['selectedProperty']->address . ".");
            if ($result) {
                $_SESSION['sidebar'] = "repair";
                $this->redirect('/propertytenant/repair');
            } else {
                $_SESSION['sidebar'] = "repair";
                $this->redirect('/propertytenant/repair');
            }
        }
    }

    public function viewDetails()
    {
        if (!Tenant::isAuthenticated()) {
            $this->redirect('/');
        } else {
            if (!isset($_POST['submit'])) {
                $this->redirect("/propertytenant/index");
            }
            $properties = $_SESSION['user']->getProperties();
            $_SESSION['selectedProperty'] = $properties[$_POST['submit']];
            $_SESSION['sidebar'] = "manage";
            $this->redirect('/propertytenant/manage');
        }
    }

    public function viewNotifications()
    {
        if (!Tenant::isAuthenticated()) {
            $this->redirect('/');
        } else {
            $this->view('tenant/notifications');
        }
    }
}