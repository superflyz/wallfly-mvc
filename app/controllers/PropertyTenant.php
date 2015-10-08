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
            $this->view('tenant/addpayment');
        }
    }

    public function processPayment()
    {
        if (!Tenant::isAuthenticated()) {
            $this->redirect('/');
        }
        $result = $_SESSION['selectedProperty']->addPayment($_POST['amount']);
        if ($result == false) {
            $this->view('tenant/addpayment');
        } else {
            $this->view('tenant/viewpayments');
        }
    }

    public function repair()
    {
        if (!Tenant::isAuthenticated()) {
            $this->redirect('/');
        } else {
            $this->view('tenant/repair');
        }
    }
}