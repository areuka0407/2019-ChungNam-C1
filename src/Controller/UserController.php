<?php
namespace Controller;

use Engine\DB;

class UserController {
    /**
     * 회원 관리
     */

    function loginPage(){
        view("login");
    }
    function login(){
        isEmpty();
        extract($_POST);

        $found = DB::fetch("SELECT * FROM users WHERE identity = ?", [$identity]);;
        if(!$found || $found->password !== hash("sha256", $password)) back("아이디와 패스워드가 일치하지 않습니다.");

        $_SESSION['user'] = $found;

        $site = DB::fetch("SELECT * FROM sites ORDER BY created_at DESC");; // 가장 최근에 생성된 사이트를 가져옴
        $site ? redirect("/{$site->code}", "로그인 되었습니다.") : redirect("/admin/teaser_builder.html", "로그인 되었습니다.");
    }

    function joinPage(){
        view("join");
    }
    function join(){
        isEmpty();
        extract($_POST);

        if(preg_match("/^[a-zA-Z]+$/", $identity) == false) back("아이디는 [영문]으로만 구성되어야 합니다.");
        if(preg_match("/^(?=.*[a-zA-Z].*)(?=.*[0-9].*)[a-zA-Z0-9]+/", $password) == false) back("비밀번호는 [영문/숫자] 조합으로 구성되어야 합니다.");
        if(preg_match("/^[a-zA-Z0-9]+@[a-zA-Z0-9]+\.[a-zA-Z]{2,4}$/", $email) == false) back("올바른 이메일을 입력해 주십시오.");
        if(DB::fetch("SELECT * FROM users WHERE identity = ?", [$identity])) back("동일한 아이디를 가진 회원이 이미 존재합니다.");
        
        $password = hash("sha256", $password);
        DB::query("INSERT INTO users(identity, password, email, name) VALUES (?, ?, ?, ?)", [$identity, $password, $email, $name]);

        redirect("/admin", "회원가입 되었습니다.");
    }

    function logout(){
        unset($_SESSION['user']);
        redirect("/admin", "로그아웃 되었습니다.");
    }
}