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
        <h2 style="margin-top:0px">T04_wsheet Read</h2>
        <table class="table">
	    <tr><td>Idmapel</td><td><?php echo $idmapel; ?></td></tr>
	    <tr><td>NoUrut</td><td><?php echo $NoUrut; ?></td></tr>
	    <tr><td>Kdasar</td><td><?php echo $Kdasar; ?></td></tr>
	    <tr><td>Induk</td><td><?php echo $induk; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('t04_wsheet') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>