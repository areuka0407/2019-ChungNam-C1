<?php

use Engine\Router;

/**
 * 사이트 관리
 */
Router::get("/admin/teaser_builder.html", "BuilderController@builderPage", "user");
Router::post("/admin/set-site", "BuilderController@setSite", "user");
Router::post("/admin/set-image", "BuilderController@setImage", "user");
Router::post("/admin/get-image-count", "BuilderController@getImageCount", "user");

/**
 * 통계 관리
 */

Router::get("/admin/site-stats/{type}/{code}", "StatsController@statsPage", "user");


/**
 * 회원관리
 */
Router::get("/admin", "UserController@loginPage", "guest");
Router::post("/admin", "UserController@login", "guest");

Router::get("/sign-up", "UserController@joinPage", "guest");
Router::post("/sign-up", "UserController@join", "guest");

Router::get("/logout", "UserController@logout", "user");

/* 사이트
*/
Router::get("/", "MainController@indexPage");
RouteR::get("/{code}", "MainController@teaserPage");

Router::connect();