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
            <li class="list-group-item">Name : <?=$result->data[0]->Name?> </li>
            <li class="list-group-item">Name : <?=$result->data[0]->Email?> </li>
            <li class="list-group-item">DateJoin : <?=date("d M Y", strtotime($result->data[0]->DateJoin))?></li>
        </ul>
        <br>
        <a href="list.php?page=1&size=10">Go Back</a>
        </div>
    </div>
</div>
