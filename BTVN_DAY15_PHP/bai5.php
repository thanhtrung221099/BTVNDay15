<?php
$error = '';
echo "<pre>";
print_r($_POST);
echo "</pre>";

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $password = $_POST['password'];

    if (empty($name) || empty($password)) {
        $error = 'Không được để trống name hoặc password';
    } elseif (strlen($password) < 6) {
        $error = 'Password phải có hơn 6 kí tự';
    }
}

echo "<h3 style='color: red'>$error</h3>"
?>

<form action="" method="post">
    <div>
        Username
        <br>
        <input type="text" name="name">
    </div>
    <div>
        Password
        <br>
        <input type="password" name="password">
    </div>
    <div>
        <input type="checkbox" name="checkbox" value="0">
        Remmember me
    </div>
    <div>
        <input type="submit" name="submit" value="Login">
    </div>
</form>
