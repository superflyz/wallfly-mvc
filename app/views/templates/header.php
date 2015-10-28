<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"><meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="WallFly - Property Mangement System">
    <meta name="author" content="The SuperFlyz">

    <title>Welcome to WallFly</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
   
    <!-- Bootstrap Core CSS -->
    <link href="/wallfly-mvc/public/css/bootstrap.min.css" rel="stylesheet">
    <link href="/wallfly-mvc/public/css/jasny-bootstrap.css" rel="stylesheet">
    

    <!-- Custom CSS -->  
     <link href="/wallfly-mvc/public/css/normalize.css" rel="stylesheet">
    <link href="/wallfly-mvc/public/css/wallfly.css" rel="stylesheet">
    

    <!-- Custom Fonts -->
    <link href="/wallfly-mvc/public/css/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    
    <?php require_once '../app/views/templates/links.php'; ?>
    <?php if(!isset($_SESSION['sidebar'])){
        $_SESSION['sidebar'] = "dashboard";
    }?>
    
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="57x57" href="http://103.253.147.221/wallfly-mvc/public/favicon/apple-touch-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="http://103.253.147.221/wallfly-mvc/public/favicon/apple-touch-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="http://103.253.147.221/wallfly-mvc/public/favicon/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="http://103.253.147.221/wallfly-mvc/public/favicon/apple-touch-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="http://103.253.147.221/wallfly-mvc/public/favicon/apple-touch-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="http://103.253.147.221/wallfly-mvc/public/favicon/apple-touch-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="http://103.253.147.221/wallfly-mvc/public/favicon/apple-touch-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="http://103.253.147.221/wallfly-mvc/public/favicon/apple-touch-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="http://103.253.147.221/wallfly-mvc/public/favicon/apple-touch-icon-180x180.png">
    <link rel="icon" type="image/png" href="http://103.253.147.221/wallfly-mvc/public/favicon/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="http://103.253.147.221/wallfly-mvc/public/favicon/android-chrome-192x192.png" sizes="192x192">
    <link rel="icon" type="image/png" href="http://103.253.147.221/wallfly-mvc/public/favicon/favicon-96x96.png" sizes="96x96">
    <link rel="icon" type="image/png" href="http://103.253.147.221/wallfly-mvc/public/favicon/favicon-16x16.png" sizes="16x16">
    <link rel="manifest" href="http://103.253.147.221/wallfly-mvc/public/favicon/manifest.json">
    <link rel="mask-icon" href="http://103.253.147.221/wallfly-mvc/public/favicon/safari-pinned-tab.svg" color="#333333">
    <link rel="shortcut icon" href="http://103.253.147.221/wallfly-mvc/public/favicon/favicon.ico">
    <meta name="apple-mobile-web-app-title" content="WallFly">
    <meta name="application-name" content="sWallFly">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="msapplication-TileImage" content="http://103.253.147.221/wallfly-mvc/public/favicon/mstile-144x144.png">
    <meta name="msapplication-config" content="http://103.253.147.221/wallfly-mvc/public/favicon/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">
    <link href="/wallfly-mvc/public/js/dropdown2/dropdown2.css" rel="stylesheet">

</head>

