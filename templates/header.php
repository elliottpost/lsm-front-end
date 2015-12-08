<?php
/**
 * This template is the header of the base template
 */
?><!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="COMP433 Project 4">
    <meta name="author" content="Elliott Post, Rayyan Jaweed, Maggie Aust">

    <title>Lakeshore Market</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?=CSS_PATH?>bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?=CSS_PATH?>1-col-portfolio.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap3-dialog/1.34.7/css/bootstrap-dialog.min.css" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->    

</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?=SITE_URI?>">Lakeshore Market</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <?php
                    if( Auth::isAuthenticated() ) {
                        ?>
                        <li>
                            <a href="<?=SITE_URI?>product/create">New Product</a>
                        </li> 
                        <li>
                            <a href="<?=SITE_URI?>customer/detail/q/<?=Auth::getCustomerId();?>">My Account</a>
                        </li> 
                        <li>
                            <a href="<?=SITE_URI?>logout">Logout</a>
                        </li>
                        <?php
                    } else {
                        ?>
                        <li>
                            <a href="<?=SITE_URI?>customer/create">Register as Customer</a>
                        </li>                        
                        <li>
                            <a href="<?=SITE_URI?>partner/create">Register as Partner</a>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
                <?php
                if( Auth::isAuthenticated() ) {
                    ?>
                    <div class="col-sm-3 col-md-3">
                        <form class="navbar-form" role="search" action='<?=SITE_URI?>products/search/results' method='post'>    
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search Products" name="q">
                                <div class="input-group-btn">
                                    <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <?php
                }
                ?>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Content -->
    <div class="container">