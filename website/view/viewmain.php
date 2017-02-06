<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A website to find the perfect activity in your region">
    <meta name="author" content="Groupe B">
    <link rel="shortcut icon" href="img/favicon-16x16.png"> <!-- needs a favicon -->

    <!-- Title of Website -->
    <title>Bsmart</title>

    <!-- Css for style -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">

    <!-- Scripts -->



</head>



<body>

<!-- Navigation Bar -->
<div class="navbar navbar-inverse navbar-static-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="index.php">
                <img src="img/logo-alpha.png" id="logo" alt="Laptop" style="width:56px;height:56px;border:0;">
                <a class="navbar-brand">Bsmart</a>
            </a>
        </div>
        <div id="menu" class="navbar-collapse collapse">
            <!-- Main navigation buttons -->
            <ul id="menuContent" class="nav navbar-nav navbar-left">
                <?php echo $json_data['menuContent'];?>
            </ul>
        </div>
    </div>
</div>

<!-- Main content of the page -->
<div class="main" id="content">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1 id="titleContent">
                    <?php echo $json_data['titleContent'] ?>
                </h1>
                <p id="bodyContent">
                    <?php echo $json_data['bodyContent']; ?>
                </p>
            </div>
        </div>
    </div>

</div>

<!-- Back to top button-->
<a href="#" class="go-top">
    <img src="img/arrow-up-alpha.png" id="up" alt="back to top" style="width:56px;height:56px;border:0;">
</a>

<!-- Footer of the page -->
<footer class="website-footer">
    <p>
        Copyright © 2017 Bsmart | <button class="mod" id="contact" >Contact</button> | <button class="mod" id="credits" >Design, Crédits & Mentions Légales</button>
    </p>
</footer>

<!-- SCRIPTS -->
<!-- End of the document, so the page load faster-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/bordelDelvigneStyle.js"> </script>
<!-- Script back to top -->

</body>

</html>