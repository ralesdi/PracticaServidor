<?php require VIEWS_FOLDER .'includes/header.php'; ?>
<?php require VIEWS_FOLDER .'includes/navInstalation.php'; ?>
<section>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="<?=INSTALATION_FOLDER?>finish.php" method="POST">
        <div class="card w-25 m-auto">
        <h1>Instalación para MySQL/MariaDB</h1>
        <input name="config" type="text" value=<?=CONFIG_FOLDER?> hidden>
        Indica el usuario de la Base de Datos: <input name="username" type="text"> <br>
        Indica la contraseña de la Base de Datos: <input name="password" type="text"> <br>
        Indica la localización de la base de datos: <input name="location" type="text" value="localhost"> <br>
        Indica la base de datos para instalar la estructura: <input name="database" type="text">
        <input type="submit" value="crear">
        </div>
        
    </form>
    <h6>AVISO! LA BASE DE DATOS DEBE ESTAR VACIA!</h6>
</body>
</section>
<?php require VIEWS_FOLDER . 'includes/footer.php'; ?>