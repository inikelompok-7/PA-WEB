<?php
// Array yang berisi data pengguna dan peran (role) pengguna
$users = array(
    array("username" => "admin", "password" => "admin123", "role" => "Admin"),
    array("username" => "user", "password" => "user123", "role" => "User"),
);

// Fungsi untuk melakukan autentikasi pengguna
function authenticateUser($username, $password, &$userRole) {
    global $users;
    foreach ($users as $user) {
        if ($user["username"] == $username && $user["password"] == $password) {
            $userRole = $user["role"];
            return true;
        }
    }
    return false;
}
// Proses form login
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $userRole = "";
    if (authenticateUser($username, $password, $userRole)) {
        // Jika autentikasi sukses, set session dan redirect ke halaman sesuai peran (role) pengguna
        $_SESSION["logged_in"] = true;
        $_SESSION["user_role"] = $userRole;
        if ($userRole == "Admin") {
            header("Location: admin.php");
            exit();
        } elseif ($userRole == "User") {
            header("Location: test1.php");
            exit();
        }
    } else {
        $error_message = "Username atau password salah. Silakan coba lagi.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="login.css">
    <title>Login</title>
</head>
<body>
    <div class="login-container">
        <h1>Login</h1>
        <form method="post">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required >
            <input type="submit" value="Login">
        </form>
    </div>
</body>
</html>
