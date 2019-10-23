<?php

class User extends Model {
    protected $isAuth = false;

    public function isUserAuth() {
        return $this->isAuth;
    }

    public function Auth() {
        $this->isAuth = true;
    }

    public function Logout () {
        $this->isAuth = false;
    }
}