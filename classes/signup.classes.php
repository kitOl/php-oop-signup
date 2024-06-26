<?php

class Signup extends Dbh
{

    protected function setUser($uid, $pwd, $email)
    {
        $sql = "INSERT INTO users (uid, pwd, email) VALUES (?, ?, ?);";
        $stmt = $this->connect()->prepare($sql);

        $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

        if (!$stmt->execute(array($uid, $hashedPwd, $email))) {
            $stmt = null;
            header("Location: ../index.php?error=stmtfailed");
            exit();
        }

        $stmt = null;
    }

    protected function checkUser($uid, $email)
    {
        $sql = "SELECT uid FROM users WHERE uid = ? OR email = ?;";
        $stmt = $this->connect()->prepare($sql);

        if (!$stmt->execute(array($uid, $email))) {
            $stmt = null;
            header("Location: ../index.php?error=stmtfailed");
            exit();
        }
        /*
        if ($stmt->rowCount() > 0) {
            return false;
        } else {
            return true;
        }
        */
        return $stmt->rowCount() > 0;
    }
}
