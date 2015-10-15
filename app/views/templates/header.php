<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"><meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="WallFly - Property Mangement System">
    <meta name="author" content="The SuperFlyz">

    <title>Dashboard - WallFly</title>

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
    
    <!-- Favicon -->
    <link rel="shortcut icon" href="localhost/wallfly-mvc/public/favicon/favicon.ico" type="image/x-icon">
    <link rel="icon" href="/favicon.png">
    <link rel="icon" sizes="57x57" href="localhost/wallfly-mvc/public/favicon/favicon-32x32.png">
    <link rel="icon" sizes="57x57" href="localhost/wallfly-mvc/public/favicon/favicon-57x57.png">
    <link rel="icon" sizes="72x72" href="localhost/wallfly-mvc/public/favicon/favicon-72x72.png">
    <link rel="icon" sizes="76x76" href="localhost/wallfly-mvc/public/favicon/favicon-76x76.png">
    <link rel="icon" sizes="114x114" href="localhost/wallfly-mvc/public/favicon/favicon-114x114.png">
    <link rel="icon" sizes="120x120" href="localhost/wallfly-mvc/public/favicon/favicon-120x120.png">
    <link rel="icon" sizes="144x144" href="localhost/wallfly-mvc/public/favicon/favicon-144x144.png">
    <link rel="icon" sizes="152x152" href="localhost/wallfly-mvc/public/favicon/favicon-152x152.png">

    <meta name="msapplication-TileColor" content="#FFFFFF">	
    <meta name="msapplication-TileImage" content="localhost/wallfly-mvc/public/favicon/favicon-144x144.png">
    <meta name="application-name" content="Website Title">

</head>
<body class="ui_body">
