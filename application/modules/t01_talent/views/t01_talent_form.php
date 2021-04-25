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
        <h2 style="margin-top:0px">T01_talent <?php echo $button ?></h2> -->
        <form action="<?php echo $action; ?>" method="post">
			<div class="form-group">
            	<label for="varchar">TALENT <?php echo form_error('Talent') ?></label>
            	<input type="text" class="form-control" name="Talent" id="Talent" placeholder="TALENT" value="<?php echo $Talent; ?>" />
        	</div>
			<input type="hidden" name="idtalent" value="<?php echo $idtalent; ?>" />
			<button type="submit" class="btn btn-primary"><?php echo $button ?></button>
			<a href="<?php echo site_url('t01_talent') ?>" class="btn btn-secondary">Batal</a>
		</form>
    <!-- </body>
</html> -->
