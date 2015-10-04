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
}