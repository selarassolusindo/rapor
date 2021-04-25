<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            .word-table {
                border:1px solid black !important; 
                border-collapse: collapse !important;
                width: 100%;
            }
            .word-table tr th, .word-table tr td{
                border:1px solid black !important; 
                padding: 5px 10px;
            }
        </style>
    </head>
    <body>
        <h2>T03_mapel List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Idkelompok</th>
		<th>MataPelajaran</th>
		<th>SKM</th>
		
            </tr><?php
            foreach ($t03_mapel_data as $t03_mapel)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $t03_mapel->idkelompok ?></td>
		      <td><?php echo $t03_mapel->MataPelajaran ?></td>
		      <td><?php echo $t03_mapel->SKM ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>