<h2>Style</h2>
<?php
$uploaddir  =  dirname(dirname(__FILE__)) . '/css/';

if (isset($_FILES['stylesheet'])) {
    $myFile = $_FILES['stylesheet'];
    $fileCount = count($myFile["name"]);

    for ($i = 0; $i < $fileCount; $i++) {
        $uploadfile = $uploaddir . basename($myFile['name'][$i]);
        move_uploaded_file($myFile["tmp_name"][$i], $uploadfile);
    }
}
?>
<form action="index.php?dashboard=style&upload=true" enctype="multipart/form-data" method="post" id="stylesheetUpload">
    <label for="stylesheet[]">Upload Stylesheet</label>
    <input type="file" id="stylesheet[]" name="stylesheet[]" multiple required accept=".css">
    <input type="submit" value="Upload" id="upload" class="btn btn-md btn-primary">
</form>

<section class="note" id="styleUploadNote">
    <h3>Note: Please name the files as following:</h3>
    <ul>
        <li>Defualt stylesheet: style.css</li>
        <li>Home page: index.css</li>
        <li>About Me Page: about.css</li>
        <li>Header: header.css</li>
        <li>Campaign Section: campaign.css</li>
    </ul>
</section>