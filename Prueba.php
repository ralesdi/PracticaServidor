<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>HELLO</h1>
    
    <?php
    echo "HOLA";
    require_once "config/database.php";
    require_once "config/global.php";
    require_once "models/User.php";

    $user = new User(1,"23232323N","Ralesdi","Alessandro","Rinaldi Gómez","alessandrorinaldifma@gmail.com","123");
    
    $user->save();
    /*
    $student = new User("Alessandro Rinaldi","Ralesdin","alessandrorinaldifma@gmail.com","123");
    $student->delete();
    
    
    $course = new Course("Desarrollo de Aplicaciones Web","DAW-2880");
    $course->delete();
    */
    ?>
    
</body>
</html>
