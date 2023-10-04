<?php
require_once("style.css.php");
require_once("class-ablapp.php");
$app = new AblApp();

extract($_GET);
if (!isset($page)){
    $page = 1;
}
if (!isset($size)){
    $size = 20;
}

$enpointurl = $app->baseurl."/api/getreq/".$app->idbase."/paging?page=".$page."&size=".$size;

$result = json_decode($app->curlPost($enpointurl));
$totaldata = $result->total;
$totalpages = ceil($totaldata / $size);
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
        <h3>TOTAL DATA: <?=$result->total?></h3>
            <table class="table table-striped table-hover">
                <tr>
                    <th>COUNTRY</th><th>COUNTRY CODE</th><th>DATE CREATED</th><th>#</th>
                </tr>
            <?php
            $n=1;
            for ($i=0;$i<count($result->data);$i++){
                ?>
                <tr>
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

            <nav aria-label="Page navigation example">
            <ul class="pagination">
                <?php
                if ($totaldata > $size){
                    for($i=1;$i<=$totalpages;$i++){
                        ?>
                        <li class="page-item">
                            <a class="page-link" href="index.php?page=<?=$i?>"> <?=$i?> </a>
                        </li>
                        <?php
                    }
                }
                ?>
            </ul>
            </nav>
        </div>
    </div>
</div>
