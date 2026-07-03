<?php
session_start();
require "db.php";

$error = null;

if ($_POST) {
    $email = trim($_POST['email']);
    $pwd = $_POST['password'];

    $stmt = getDB()->prepare("SELECT * FROM usuarios WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($pwd, $user['password_hash'])) {

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['nombre'] = $user['nombre'];

        getDB()->prepare(
            "UPDATE usuarios SET ultimo_login = NOW() WHERE id = ?"
        )->execute([$user['id']]);

        header("Location: panel.php");
        exit;

    } else {
        $error = "Email o contraseña incorrectos";
    }
}
?>

<h2>Login</h2>

<?php if ($error) echo "<p style='color:red'>$error</p>"; ?>

<form method="POST">
    <input name="email" placeholder="Email" required>
    <input name="password" type="password" placeholder="Contraseña" required>
    <button>Entrar</button>
</form>