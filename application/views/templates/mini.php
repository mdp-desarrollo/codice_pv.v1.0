<html>
<head>
<meta http-equiv="Content-type" content="text/html; charset=UTF-8" />
    <meta http-equiv="Content-Language" content="es" />
    <link rel="shortcut icon" href="/media/images/icon.png" />
    <title><?php echo $title;?></title>
    <?php foreach($styles as $file => $type) { echo HTML::style($file, array('media' => $type)), "\n"; }?>
    <?php foreach($scripts as $file) { echo HTML::script($file, NULL, TRUE), "\n"; }?>    
</head>
<body >
    <?php echo $content;?>      
</body>
</html>
