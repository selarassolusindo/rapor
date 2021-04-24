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
        <h2 style="margin-top:0px">T30_absensi Read</h2>
        <table class="table">
	    <tr><td>Idsiswa</td><td><?php echo $idsiswa; ?></td></tr>
	    <tr><td>S</td><td><?php echo $S; ?></td></tr>
	    <tr><td>I</td><td><?php echo $I; ?></td></tr>
	    <tr><td>A</td><td><?php echo $A; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('t30_absensi') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>