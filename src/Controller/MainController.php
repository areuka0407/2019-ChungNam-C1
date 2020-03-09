<?php
namespace Controller;

class MainController {
    function indexPage(){
        redirect("/admin");
    }

    function loginPage(){
        view("login");
    }
}