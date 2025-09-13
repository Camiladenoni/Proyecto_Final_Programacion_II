<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM usuarios WHERE usuario = :usuario";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':usuario', $usuario);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['usuario_id'] = $user['id'];
        header("Location: index.php");
        exit();
    } else {
        $error = "Usuario o contraseña incorrectos";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="container">

    <div class = "left-side">
        <img src="img/autos.png" alt ="Autos">
    </div>

    <div class ="right-side">
        <div class="form-container">
            <img src = "img/logo.jpg" alt="Logo" class="logo">
            <h2>BIENVENIDOS</h2>

    <form method="post">
        <input type="text" name="usuario" placeholder="Usuario" required><br>
        <input type="password" name="password" placeholder="Contraseña" required><br>
        <button type="submit">Ingresar</button>
    </form>
    <br>
    <a href="register_user.php" class="btn">Registrar nuevo usuario</a>
    <?php if(isset($error)) echo "<p class='error'>$error</p>"; ?>

    </div>
 </div>      
</div>
</body>
</html>