<?php
$files = file('bt6.csv');
echo "<pre>";
print_r($files);
echo "</pre>";

?>

<table border="1" cellspacing="0" cellpadding="8">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Age</th>
        <th>Gender</th>
        <th>Status</th>
        <th>Created_at</th>
    </tr>
    <?php
    foreach ($files as $file):

        $arr_info = explode(',', $file);
        ?>

        <tr>
            <td><?php echo $arr_info[0]?></td>
            <td><?php echo $arr_info[1]?></td>
            <td><?php echo $arr_info[2]?></td>
            <td><?php echo $arr_info[3]?></td>
            <td><?php echo $arr_info[4]?></td>
            <td><?php echo $arr_info[5]?></td>
        </tr>
    <?php
    endforeach;
    ?>
</table>