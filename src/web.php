<?php

use Engine\Router;

Router::get("/", "MainController@indexPage");
Router::get("/admin", "MainController@loginPage");


Router::connect();