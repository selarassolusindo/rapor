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
        <h2 style="margin-top:0px">T31_talent Read</h2>
        <table class="table">
	    <tr><td>Idsiswa</td><td><?php echo $idsiswa; ?></td></tr>
	    <tr><td>TalentNilai</td><td><?php echo $TalentNilai; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('t31_talent') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>