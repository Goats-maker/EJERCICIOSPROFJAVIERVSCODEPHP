<?php
require "db.php";

$error = null;

if ($_POST) {
    $nombre = trim($_POST['nombre']);
    $email = trim($_POST['email']);
    $pwd = $_POST['password'];

    if (strlen($pwd) < 8) {
        $error = "La contraseña debe tener mínimo 8 caracteres";
    } else {
        try {
            $hash = password_hash($pwd, PASSWORD_DEFAULT);

            getDB()->prepare(
                "INSERT INTO usuarios (nombre, email, password_hash)
                 VALUES (?, ?, ?)"
            )->execute([$nombre, $email, $hash]);

            header("Location: login.php?ok=1");
            exit;

        } catch (PDOException $e) {
            $error = "Ese email ya existe";
        }
    }
}
?>

<h2>Registro</h2>

<?php if ($error) echo "<p style='color:red'>$error</p>"; ?>

<form method="POST">
    <input name="nombre" placeholder="Nombre" required>
    <input name="email" placeholder="Email" required>
    <input name="password" type="password" placeholder="Contraseña" required>
    <button>Registrarse</button>
</form>