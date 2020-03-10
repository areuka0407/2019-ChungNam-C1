<?php

use Engine\Router;

Router::get("/", "MainController@indexPage");

/**
 * 사이트 관리
 */
Router::get("/admin/teaser_builder.html", "MainController@builderPage", "user");
Router::post("/admin/set-site", "MainController@setSite", "user");;

/**
 * 회원관리
 */
Router::get("/admin", "UserController@loginPage", "guest");
Router::post("/admin", "UserController@login", "guest");

Router::get("/sign-up", "UserController@joinPage", "guest");
Router::post("/sign-up", "UserController@join", "guest");

Router::get("/logout", "UserController@logout", "user");

Router::connect();