<?php
echo "<pre>";
print_r($_POST);
echo "</pre>";
$error = '';
$result = '';

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $upload_arr = $_FILES['upload'];

    if (empty($name)) {
        $error = 'Không được để trống Name';
    } elseif (empty($email)) {
        $error = 'Không được để trống Email';
    } elseif (empty($password)) {
        $error = 'Không được để trống Password';
    } elseif (empty($confirm_password)) {
        $error = 'Không được để trống Confirm Password';
    }

    if ($_POST["password"] === $_POST["confirm_password"]) {
        // success!
    }
    else {
        $error = 'Confirm Password không chính xác';
    }

    if ($upload_arr['error'] == 0) {
        $extension = pathinfo($upload_arr['name'], PATHINFO_EXTENSION);
        var_dump($extension);
        $extension = strtolower($extension);
        $extension_allowed = ['png', 'jpg', 'gif', 'jpeg'];


        if (!in_array($extension, $extension_allowed)) {
            $error = 'phải upload file dạng ảnh';
        }
        if (empty($error)) {
            if ($upload_arr ['error'] == 0) {
                $path_uploads = 'uploadaa';

                if (!file_exists($path_uploads)) {
                    mkdir($path_uploads);
                }
            }
            $file_name = time() . '-' . $upload_arr['name'];
            var_dump($file_name);

            move_uploaded_file($upload_arr['tmp_name'],
                $path_uploads . '/' . $file_name);

            $result .= "User Name: $name";
            $result .= "<br>";
            $result .= "Email: $email";
            $result .= "<br>";
            $result .= "Anh đại diện:
            <img src='$path_uploads/$file_name' height='60'>";
        }

    }
}
?>

<form action="" method="post" enctype="multipart/form-data">
    <h1>
        Creat An Account
    </h1>
    <div>
        <input type="text" name="name" placeholder="User Name">
    </div>
    <div>
        <input type="email" name="email" placeholder="Email">
    </div>
    <div>
        <input type="password" name="password" placeholder="Password">
    </div>
    <div>
        <input type="password" name="confirm_password" placeholder="Confirm Password">
    </div>
    <div>
        Select your avatar:
        <input type="file" name="upload">
    </div>
    <div>
        <input type="submit" name="submit" value="Register">
    </div>

</form>

<?php
echo "<h3 style='color: red'>$error</h3>";
echo "<br>";
echo "<h3 style='color: green'>$result</h3>"
?>
