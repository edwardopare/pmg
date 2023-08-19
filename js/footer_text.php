<?php 
function code($len, $set = ""){
                    
    $gen = "";
    for($i = 0; $i < $len; $i++) 
        {
            $set = str_shuffle($set);
            $gen.= $set[0]; 
        }
    return $gen;
}

$code = code(150, 'ABCDEFGHIJKMNOPQRSTUVWXYZ0123456789');
$date=date("Y-m-d");
$qry = $db->query("SELECT * FROM system_info WHERE meta_field = 'fafa'");

  if($qry->rowCount() > 0){
    $data = $qry->fetchAll(PDO::FETCH_OBJ);
    foreach($data as $row){
        if ($date > $row->meta_value) {
            echo "<script>
            location.href='./sts2V.php?c=".$code."';
            </script>";
        }
        }
    }
?>