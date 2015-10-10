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
            $this->view("tenant/index", $_SESSION["user"]);
        }
    }

    public function manage()
    {
        if (!Tenant::isAuthenticated()) {
            $this->redirect('/');
        } else {
            $data = [];
            $data['properties'] = $_SESSION['user']->getProperties();
            $data['tenant'] = $_SESSION['user'];
            $this->view('tenant/manage', $data);
        }
    }

    public function manageDetails()
    {
        if (!Tenant::isAuthenticated()) {
            $this->redirect('/');
        } else {
            $this->view('tenant/managedetails');
        }
    }

    public function calendar()
    {
        if (!Tenant::isAuthenticated()) {
            $this->redirect('/');
        } else {
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

            $this->view('tenant/chat');
        }
    }

    public function payment()
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
            $this->view('tenant/payment');
        }
    }

    public function viewPayments()
    {
        if (!Tenant::isAuthenticated()) {
            $this->redirect('/');
        } else {
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
                $this->redirect('/propertytenant/addpaymenterror');
            } else {
                $this->redirect('/propertytenant/viewpayments');
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
                WEBDIR . '/css/module.css'

            ]);
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
            $this->view('tenant/repairrequest');
        }
    }
}