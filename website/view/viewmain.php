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
                <a class="navbar-brand" href="index.html">Bsmart</a>
            </a>
        </div>
        <div id="menu" class="navbar-collapse collapse">
            <!-- Main navigation buttons -->
            <ul class="nav navbar-nav navbar-left">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Formations<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="english">Anglais</a></li>
                        <li><a href="php">Php</a></li>
                        <li><a href="security">Sécurité des réseaux</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="allFormations">Toutes les formations</a></li>
                    </ul>
                </li>
                <li><a href="evaluation">Vos évaluations</a></li>
                <li><a href="login"><span class="glyphicon glyphicon-user"></span>S'enregistrer</a></li>
                <li><a href="register"><span class="glyphicon glyphicon-log-in"></span>Se connecter</a></li>
            </ul>
            <!-- Search-->
            <form class="navbar-form navbar-right">
            </form>
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
<!-- Script back to top -->
<script>

    function testJSON(result){
        json = {};
        try
        {
            json = JSON.parse(result);
        }
        catch (err)
        {
            json = {'titleContent' : 'Erreur JSON',
                'bodyContent' : result
            };
        }
        return json;
    }

    function jsonDoSomething(objectJS){
        $.each(objectJS, function(key, value){
            //console.log(key +":"+ value);
            switch (key){
                case "titleContent" :
                case "bodyContent" : $("#"+key).html(value);break;
                default : alert("Err.retour : cas non traité ...  " + key);
            }
        });
    }

    $(document).ready(function()
    {
        $(window).scroll(function()
        {
            if ($(this).scrollTop() > 100)
            {
                $('.go-top').fadeIn(100);
            }

            else
            {
                $('.go-top').fadeOut(100);
            }
        });

        $('.go-top').click(function(event)
        {
            event.preventDefault();
            $('html, body').animate({scrollTop: 0}, 100);
        });


       $( '#menu li' ).click(function(event)
       {
            event.preventDefault();
            var rq = $(this).find("a").attr('href');
            if(rq != "#")
            {
                $.get("index.php?content="+rq, function( data )
                {
                    jsonDoSomething(testJSON(data));
                })
                .done( function()
                {
                   console.log('it works');
                    loadAsynchronousForm();
                });

            }

        });

       // console.log('love');

        function loadAsynchronousForm()
        {
            $("#loginButton").click( function( e )
            {
                e.stopPropagation();
                e.preventDefault();

                alert("CC");
            });
        }

    });
</script>

</body>

</html>