<?php
$idbase = 8;
$token = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6Imd1c2VrYS5kZXZAZ21haWwuY29tIiwiaWF0IjoxNjgwMjQ2ODc5fQ.dueWFsCiZHrtMp0SxBSkq3xs-NjM8RcluSlFmcG7OI8";
$setlimit = 2;
extract($_GET);
if (isset($page) && isset($start)){
    $urllistlimitpaging = "https://app.apibuilderlab.com/api/getreq/".$idbase."/paging/".$start."/".$setlimit;
}else{
    $urllistlimitpaging = "https://app.apibuilderlab.com/api/getreq/".$idbase."/setlimit/".$setlimit;
}

function getpaging($urlpaging, $token){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $urlpaging);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'x-access-token: '.$token,
        'Content-Type: application/json'
    ]);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    curl_close ($ch);
    return $result;
}

$listlimit = json_decode(getpaging($urllistlimitpaging, $token));
$totaldata = $listlimit->total;
$totalpages = ceil($totaldata / $setlimit);
?>
<style>
    table{border-collapse: collapse;}
    table tr th{ border: 1px solid #333; padding: 5px 10px;}
    table tr td{ border: 1px solid #333; padding: 5px 10px;}
    p.paging a{background: #673AB7;  padding: 4px 10px;  display: inline-block;  border-radius: 2px; color: #fff; text-decoration: none;}
    p.paging a:hover{background: #482981;}
</style>
<h1>TOTAL DATA: <?=$listlimit->total?></h1>
<table>
    <tr>
        <th>ID</th><th>EMAIL</th><th>DATE</th>
    </tr>
<?php
$n=1;
for ($i=0;$i<count($listlimit->data);$i++){
    ?>
    <tr>
        <td><?=$listlimit->data[$i]->id?></td>
        <td><?=$listlimit->data[$i]->email?></td>
        <td><?=date("d M Y h:m:s", strtotime($listlimit->data[$i]->created_datetime))?></td>
    </tr>
    <?php
    $n++;
}
?>
</table>

<p class="paging">
    <?php
    if ($totalpages > $setlimit){
        for($i=0;$i<$totalpages;$i++){
            if ($i==0){
                $start = $i;
            }
            $page = $i+1;

            if ($page == $totalpages){
                ?>
                <a href="list.php?page=<?=$page?>&start=<?=$start?>"> Last Page &raquo; </a>
                <?php
            }else{
                ?>
                <a href="list.php?page=<?=$page?>&start=<?=$start?>"> <?=$page?> </a>
                <?php
            }
            $start = $start + 2;
        }
    }
    ?>
</p>
