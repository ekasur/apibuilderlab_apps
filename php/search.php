<?php
require_once("style.css.php");
require_once("class-ablapp.php");
$app = new AblApp();

extract($_POST);
if (!isset($id)){
    $id = 1;
}

$postJson = '{
    "country_name_aka_111752597" : "'.$s.'"
}';
$enpointurl = $app->baseurl."/api/searchreq/".$app->idbase;
$result = json_decode($app->curlPostWithBody($enpointurl, $postJson));
$totaldata = $result->total;
?>


<div class="container">
    <div class="row">
        <div class="col-lg-12">
        <br><br>
        <?php echo "APIURL link preview: ".$enpointurl; echo "<br>"; ?>

        <div class="col-lg-3 offset-lg-9">
            <form method="POST" action="search.php" class="float-right">
                <input class="form-control float-left" type="text" name="s" placeholder="Search Data" required> <input class="btn btn-primary" type="submit" name="submit" value="SEARCH">
            </form>
        </div>
        <br>
        <a href="list.php?page=1&size=10">Go Back</a>
        <br><br>
        <h3>TOTAL DATA: <?=$result->total?></h3>
            <table class="table table-striped table-hover">
                <tr>
                    <th>ID</th><th>Name</th><th>Email</th><th>DateJoin</th><th>#</th>
                </tr>
            <?php
            $n=1;
            for ($i=0;$i<count($result->data);$i++){
                ?>
                <tr>
                    <td><?=$result->data[$i]->id?></td>
                    <td><?=$result->data[$i]->country_name?></td>
                    <td><?=$result->data[$i]->phone_code?></td>
                    <td><?=date("d M Y", strtotime($result->data[$i]->created_datetime))?></td>
                    <td><a href="details.php?id=<?=$result->data[$i]->id?>">View Details</a></td>
                </tr>
                <?php
                $n++;
            }
            ?>
            </table>
        </div>
    </div>
</div>