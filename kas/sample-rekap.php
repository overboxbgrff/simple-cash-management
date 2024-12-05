<?php
    $root = realpath($_SERVER['DOCUMENT_ROOT']);
    require_once $root."/kas/connector.php";
    require_once $root."/kas/session.php";

    $query = mysqli_query($conn,"SELECT * FROM lapor union 
    SELECT `kas_masuk`.`id_kkm`,`kas_masuk`.`tanggal_km`,`kas_masuk`.`kode_km`,`kas_masuk`.`uraian_km`, `kas_masuk`.`jumlah_km`, '0' from `kas_masuk` 
    UNION SELECT `kas_keluar`.`id_kkk`,`kas_keluar`.`tanggal_kk`,`kas_keluar`.`kode_kk`,`kas_keluar`.`uraian_kk`,'0',`kas_keluar`.`jumlah_kk` FROM `kas_keluar` ORDER BY `tanggal_lapor` ASC");

    //pagination
    $data_pages = 10;
    $pages = (isset($_GET['pages'])) ? (int)$_GET['pages'] : 1;
    $start_pages = ($pages > 1) ? ($pages * $data_pages) - $data_pages : 0;
    $total = mysqli_num_rows($query);
    $hal = ceil($total/$data_pages)
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table border=1>
        <tr>
            <td>Tanggal</td>
            <td>Kode</td>
            <td>Uraian</td>
            <td>Pemasukan</td>
            <td>pengeluaran</td>
            <td>Saldo</td>
        </tr>
        <?php
            $total=0;
            $t_masuk = 0;
            $t_keluar = 0;
            $t_saldo = 0;
            while ($td=mysqli_fetch_array($query)) {
                $total = $total+($td['pemasukan']-$td['pengeluaran']);
                $t_masuk = $t_masuk + $td['pemasukan'];
                $t_keluar = $t_keluar + $td['pengeluaran'];
                $t_saldo = $t_saldo + $total;
                if($td['pemasukan']==0){
                    $masuk = "-";
                } else {
                    $masuk = $td['pemasukan'];
                }
                if ($td['pengeluaran']==0) {
                   $keluar = "-";
                } else {
                    $keluar =$td['pengeluaran'];
                }
        ?>
            <tr>
                <td><?php echo $td['tanggal_lapor'];?></td>
                <td><?php echo $td['kode lapor'];?></td>
                <td><?php echo $td['uraian_lapor'];?></td>
                <td><?php echo $masuk;?></td>
                <td><?php echo $keluar;?></td>
                <td><?php echo $total;?></td>
            </tr>    
        <?php
            }
        ?>
        <tr>
            <td colspan="3">Total</td>
            <td><?php echo $t_masuk;?></td>
            <td><?php echo $t_keluar;?></td>
            <td><?php echo $total;?></td>
        </tr>
    </table>
</body>
</html>