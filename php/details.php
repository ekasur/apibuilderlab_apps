<?php
require_once("style.css.php");
require_once("class-ablapp.php");
$app = new AblApp();

extract($_GET);
if (!isset($id)){
    $id = 1;
}
$enpointurl = $app->baseurl."/api/getreq/".$app->idbase."/details?id=".$id;
$result = json_decode($app->curlPost($enpointurl));
?>

<div class="container">
    <div class="row">
        <div class="col-lg-12">
        <br><br>
        <?php echo "APIURL link preview: ".$enpointurl; echo "<br>"; ?>
        <h3>Data details: </h3><br>
        <ul class="list-group">
            <li class="list-group-item">Country : <?=$result->data[0]->country_name?> </li>
            <li class="list-group-item">Country Code : <?=$result->data[0]->country_code?> </li>
            <li class="list-group-item">Created date : <?=date("d M Y", strtotime($result->data[0]->created_datetime))?></li>
        </ul>
        <br>
        <a href="index.php?page=1">Go Back</a>
        </div>
    </div>
</div>
