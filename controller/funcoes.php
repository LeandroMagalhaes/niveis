<?php

require_once "conexao.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

define("LOG_STATUS_FAIL", 0);
define("LOG_STATUS_OK", 1);

define("TENTATIVAS_LOGIN_FAIL", 3);
define("MINUTOS_LIMITE_LOGIN", 30);

class Funcoes {

    public static function flashMsg($id, $msg = null) {
        
        if (is_null($msg)) {
            echo temFlashMsg($id) ? "<div class='alert alert-$id'>{$_SESSION['flashMsg'][$id]}</div>" : "";
            unset($_SESSION['flashMsg'][$id]);
        } else {
            $_SESSION['flashMsg'][$id] = $msg;
        }
    }

    public static function temFlashMsg($id) {
        return isset($_SESSION['flashMsg'][$id]) ? true : false;
    }

    public static function logar($email, $senha, $lembrar, $token = null) {
            
        // Comentado pois não criei o banco de dados para simular o acesso
        return true;

        // if (is_null($token)) {
        //     $sql = "select * from usuarios where email = :email";
        //     $stmt = $conn->prepare($sql);
        //     $stmt->bindParam(":email", $email);
        //     $stmt->execute();
        //     $row = $stmt->fetch(PDO::FETCH_ASSOC);
        //     $condicao = $row && password_verify($senha, $row['senha']);

        //     if ($lembrar == true) {
        //         setcookie('lembrar', $row['token'], time() + (60 * 60 * 24 * 30));
        //     }

        // } else {
        //     $sql = "select * from usuarios where token = :token";
        //     $stmt = $conn->prepare($sql);
        //     $stmt->bindParam(":token", $token);
        //     $stmt->execute();
        //     $row = $stmt->fetch(PDO::FETCH_ASSOC);
        //     $condicao = !empty($row);
        // }

        // if ($condicao == true) {
        //     unset($row['senha']);
        //     $_SESSION['usuario'] = $row;
        //     logAcesso($email, LOG_STATUS_OK);

        //     return true;
        // }

        // logAcesso($email, LOG_STATUS_FAIL);

        // return false;
    }

    public static function logarRedeSocial($email, $id_user) {
        
        // Comentado pois não criei o banco de dados para simular o acesso
        return true;

        // $sql = "select * from usuarios where email = :email";
        // $stmt = $conn->prepare($sql);
        // $stmt->bindParam(":email", $email);
        // $stmt->execute();

        // $row = $stmt->fetch(PDO::FETCH_ASSOC);
        // $condicao = $row && password_verify($id_user, $row['id_user']);

        // if ($condicao == true) {
        //     $_SESSION['usuario'] = $row;

        //     return true;
        // }

        // return false;
    }

    public static function logAcesso($email, $tipo) {

        $sql = "insert into logs (email, tipo) values (:email, :tipo);";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":tipo", $tipo);

        return $stmt->execute();
    }

    public static function getUltimoAcesso($conn, $email) {

        $sql = "SELECT 
            COUNT(id) AS tentativas, email, data_hora
            FROM
                logs
            WHERE
                email = :email
                    AND data_hora > (SELECT MAX(NOW()) - INTERVAL 30 MINUTE)
                    AND tipo = 0
            GROUP BY email limit 1;";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":email", $email);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function sair($redirecionar = null) {

        setcookie('lembrar', null, time() - 100);
        session_destroy();

        if(!is_null($redirecionar)) {
            header("location:$redirecionar");
        }
    }

}