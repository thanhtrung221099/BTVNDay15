<?php
$error = '';
$result = '';
echo "<pre>";
print_r($_POST);
echo "</pre>";

if (isset($_POST['submit'])) {
    $text = $_POST['text'];
    $note = $_POST['note'];
    $country = $_POST['country'];
    $upload_arr = $_FILES['upload'];

    if (empty($text)) {
        $error = 'Không được để trống Text';
    } elseif (!isset($_POST['checkbox'])) {
        $error = 'Cần check ít nhất 1 checkbox';
    } elseif (empty($note)) {
        $error = 'Không Được để trống Textarea';
    } elseif (!isset($_POST['gender'])) {
        $error = 'Phải chọn ít nhất 1 Radio';
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



            $result .= "Text: $text";
            $result .= "<br>";

            //xử lý checkbox của jobs
            if (isset($_POST['checkbox'])) {
                $checkbox = $_POST['checkbox'];
                foreach($checkbox AS $job) {
                    switch ($job) {
                        case 0: $result .= "Checkbox: Checkbox1"; break;
                        case 1: $result .= "Checkbox: Checkbox2"; break;
                        case 2: $result .= "Checkbox: Checkbox3";break;
                    }
                }
            }

            $result .= "<br>";
            $result .= "Textarea: $note";
            $result .= "<br>";

            if (isset($_POST['gender'])) {
                $gender = $_POST['gender'];
                switch ($gender) {
                    case 0: $result .= "Gender: Yep";break;
                    case 1: $result .= "Gender: Nope";break;
                    case 2: $result .= "Gender: None";break;
                }
                $result .= "<br />";
            }
            switch ($country) {
                case 0: $result .= "Country: Option1";break;
                case 1: $result .= "Country: Option2";break;
                case 2: $result .= "Country: Option3";break;
            }

            $result .= "<br>";
            $result .= "Anh đại diện:
            <img src='$path_uploads/$file_name' height='60'>";
        }

    }
}

?>

<form action="" method="POST" enctype="multipart/form-data">
    <div>
        Text
        <br>
        <input type="text" name="text">
    </div>

    <div>
        Checkbox
        <br>
        <input type="checkbox" name="checkbox[]" value="0">
        Checkbox1
        <br>
        <input type="checkbox" name="checkbox[]" value="1">
        Checkbox2
        <br>
        <input type="checkbox" name="checkbox[]" value="2">
        Checkbox3
    </div>

    <div>
        Textarea
        <br>
        <textarea cols="20" name="note"></textarea>
    </div>

    <div>
        Radio Button
        <br>
        <input type="radio" name="gender" value="0"> Yep

        <input type="radio" name="gender" value="1"> Nope

        <input type="radio" name="gender" value="2"> None

    </div>

    <div>
        Select
        <br>
        <select name="country">
            <option value="0">Option1</option>
            <option value="1">Option2</option>
            <option value="2">Option3</option>
        </select>
    </div>

    <div>
        Upload files
        <br>
        <input type="file" name="upload">
    </div>

    <div>
        <input type="submit" name="submit" value="Submit">
    </div>
</form>

<?php
echo "<h3 style='color: red'>$error</h3>";
echo "<br>";
echo "<h3 style='color: green;'>$result</h3>";
