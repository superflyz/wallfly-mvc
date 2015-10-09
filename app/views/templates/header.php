<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"><meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="WallFly - Property Mangement System">
    <meta name="author" content="The SuperFlyz">

    <title>WallFly</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <!--jquery validation    -->
    <script src="http://cdn.jsdelivr.net/jquery.validation/1.14.0/jquery.validate.js"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.0/additional-methods.js"></script>

    <!-- Bootstrap Core CSS -->
    <link href="/wallfly-mvc/public/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="/wallfly-mvc/public/css/wallfly.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="/wallfly-mvc/public/css/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <?php require_once '../app/views/templates/links.php'; ?>
    <?php if(!isset($_SESSION['sidebar'])){
        $_SESSION['sidebar'] = "dashboard";
    }?>

</head>
<body>
