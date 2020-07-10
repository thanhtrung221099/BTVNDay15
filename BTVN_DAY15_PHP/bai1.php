<?php
$error = '';
$result = '';

if (isset($_POST['submit'])){
    $upload_arr = $_FILES['upload'];
    if ($upload_arr['error'] == 0) {
        $extension = pathinfo($upload_arr['name'], PATHINFO_EXTENSION);
        var_dump($extension);
        $extension = strtolower($extension);
        $extension_allowed = ['png', 'jpg', 'gif', 'jpeg'];
        $file_size_mb = $upload_arr['size'] / 1024 / 1024;
        var_dump($file_size_mb);
        $file_size_mb = round($file_size_mb, 1);
        var_dump($file_size_mb);

        if (!in_array($extension, $extension_allowed)) {
            $error = 'phải upload file dạng ảnh';
        } elseif ($file_size_mb > 1) {
            $error = 'File upload k được vượt quá 1Mb';
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

            $result .= "Tên file: $file_name";
            $result .= "<br>";
            $result .= "Anh đại diện:
            <img src='$path_uploads/$file_name' height='60'>";
            $result .= "<br>";
            $result .= "Đuôi file: $extension";
        }

    }
}
?>
<form action="" method="post" enctype="multipart/form-data">
    Select a file to upload
    <br>
    <input type="file" name="upload">
    <br>
    <input type="submit" name="submit" value="upload">
</form>
<?php
echo "<h3 style=\"color: red;\">$error</h3>";
echo "<h3 style=\"color: green\">$result</h3>";
?>

