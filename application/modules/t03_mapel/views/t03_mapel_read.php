<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            body{
                padding: 15px;
            }
        </style>
    </head>
    <body>
        <h2 style="margin-top:0px">T03_mapel Read</h2>
        <table class="table">
	    <tr><td>Idkelompok</td><td><?php echo $idkelompok; ?></td></tr>
	    <tr><td>MataPelajaran</td><td><?php echo $MataPelajaran; ?></td></tr>
	    <tr><td>SKM</td><td><?php echo $SKM; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('t03_mapel') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>