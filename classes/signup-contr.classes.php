<?php

class SignupContr extends Signup
{

    private $uid;
    private $pwd;
    private $pwdRepeat;
    private $email;

    public function __construct($uid, $pwd, $pwdRepeat, $email)
    {
        $this->uid = $uid;
        $this->pwd = $pwd;
        $this->pwdRepeat = $pwdRepeat;
        $this->email = $email;
    }

    public function singupUser()
    {
        if ($this->emptyInput()) {
            header("Location: ../index.php?error=emptyinput");
            exit();
        }

        if ($this->invalidUid()) {
            header("Location: ../index.php?error=username");
            exit();
        }

        if ($this->invalidEmail()) {
            header("Location: ../index.php?error=email");
            exit();
        }

        if ($this->uidTakenCheck()) {
            header("Location: ../index.php?error=useroremailtaken");
            exit();
        }

        if ($this->pwdNotMatch()) {
            header("Location: ../index.php?error=passwordmatch");
            exit();
        }

        $this->setUser($this->uid, $this->pwd, $this->email);
    }

    private function emptyInput()
    {
        /*
        if (empty($this->uid) || empty($this->pwd) || empty($this->pwdRepeat) || empty($this->email)) {
            return false;
        } else {
            return true;
        }
        */
        return empty($this->uid) || empty($this->pwd) || empty($this->pwdRepeat) || empty($this->email);
    }

    private function invalidUid()
    {
        /*
        if (!preg_match("/^[a-zA-Z0-9]*$/", $this->uid)) {
            return false;
        } else {
            return true;
        }
        */
        return !preg_match("/^[a-zA-Z0-9]*$/", $this->uid);
    }

    private function invalidEmail()
    {
        /*
        if (!filter_var($this->email,FILTER_VALIDATE_EMAIL)) {
            return false;
        } else {
            return true;
        }
        */
        return !filter_var($this->email, FILTER_VALIDATE_EMAIL);
    }

    private function pwdNotMatch()
    {
        /*
        if ($this->pwd !== $this->pwdRepeat) {
            return false;
        } else {
            return true;
        }
        */
        return $this->pwd !== $this->pwdRepeat;
    }

    private function uidTakenCheck()
    {
        /*
        if (!$this->checkUser($this->uid, $this->email)) {
            return false;
        } else {
            return true;
        }
        */
        return $this->checkUser($this->uid, $this->email);
    }
}
