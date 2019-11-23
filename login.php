<?php
session_start();

    if(trim($_POST['email']) != "" && trim($_POST['senha'] != "")) {
        $email = addslashes($_POST['email']);
        $senha = md5(addslashes($_POST['senha']));

        $dsn = "mysql:dbname=u581887291_sispeltnu;host=127.0.0.1";
        $dbuser = "root";
        $dbpass = "";

        try {
            $pdo = new PDO($dsn, $dbuser, $dbpass);

            $sql = "SELECT * FROM usuarios WHERE email = :email AND senha = :senha";

            $sql = $pdo->prepare($sql);
            $sql->bindValue(':email', $email);
            $sql->bindValue(':senha', $senha);
            $sql->execute();

            if($sql->rowCount() > 0) {

                $dado = $sql->fetch();

                $_SESSION['id'] = $dado['id'];

                header("Location: index.php");
            }

        } catch(PDOException $e) {
            echo "Falhou: ".$e->getMessage();
        }
    } else {
        header("Location: login.html");
    }

?>
