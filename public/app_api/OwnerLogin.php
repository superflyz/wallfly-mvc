<?php
include($_SERVER['DOCUMENT_ROOT']."/wallfly-mvc/app/config/database.php");
require_once($_SERVER['DOCUMENT_ROOT']."/wallfly-mvc/app/core/Database.php");
include("securepassword.php");

$checkUser = "someone@someone.com";
$checkPassword = "Password1";
$_SESSION['loginError'] = "";

$response = array("error" => FALSE);

try {
    $DBH = Database::getInstance();
    $DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Unable to connect";
    file_put_contents('Log/PDOErrorLog.txt', $e->getMessage(), FILE_APPEND);
}

try {

    $securePass = new SecurePassword;
    //execute the SQL query and return records
    $statement = $DBH->prepare("SELECT * FROM super_user WHERE email=:email");
    $statement->execute(['email' => $checkUser]);
    $result = $statement->fetch(PDO::FETCH_OBJ);

    if ($result) {
        $comparehash = $securePass->validate_password($checkPassword, $result->password);

        if ($comparehash) {
            //session expire setup
            $_SESSION["expiration"] = time() + 1800;

            //session user setup
            $response["usertype"] = "Owner";
            $response["username"] = $result->email;
            $response['userFirstName'] = $result->firstname;
            $response['userLastName'] = $result->lastname;
            echo json_encode($response);
            exit();
        } else {
            $response['error'] = TRUE;
            echo json_encode($response);
            exit();
        }
    } else {
        $response['error'] = TRUE;
        echo json_encode($response);
        exit();
    }
    //close database
    $DBH = NULL;

} catch (PDOException $e) {
    echo "Problem logging in";
    file_put_contents('Log/PDOErrorLog.txt', $e->getMessage(), FILE_APPEND);
}