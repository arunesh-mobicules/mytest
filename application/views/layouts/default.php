<html>
<head>
    <title><?php echo $template['title']; ?></title>

    <!--    Start CSS -->
    <link href="<?php echo base_url() . "assets/css/style.css"; ?>" rel="stylesheet" type="text/css"/>
    <!---End CSS -->

    <!---Start JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.0/jquery.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url() . ("assets/js/jquery.tmpl.js")?>" type="text/javascript"></script>
    <!--End JS -->
</head>
<body>
<div class="container">
    <section>
        <div id="header">
            <img src="<?php echo base_url() . "assets/img/banner.jpg";?>" alt="">
        </div>
        <div id="fb-root"></div>

        <?php echo $template['body']; ?>
    </section>
</div>


</body>

</html>