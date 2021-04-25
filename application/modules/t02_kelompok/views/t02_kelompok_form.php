<!-- <!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php //echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            body{
                padding: 15px;
            }
        </style>
    </head>
    <body>
        <h2 style="margin-top:0px">T02_kelompok <?php //echo $button ?></h2> -->
        <form action="<?php echo $action; ?>" method="post">
			<div class="form-group">
            	<label for="varchar">KELOMPOK <?php echo form_error('Kelompok') ?></label>
            	<input type="text" class="form-control" name="Kelompok" id="Kelompok" placeholder="KELOMPOK" value="<?php echo $Kelompok; ?>" />
        	</div>
			<input type="hidden" name="idkelompok" value="<?php echo $idkelompok; ?>" />
			<button type="submit" class="btn btn-primary"><?php echo $button ?></button>
			<a href="<?php echo site_url('t02_kelompok') ?>" class="btn btn-secondary">Batal</a>
		</form>
    <!-- </body>
</html> -->
