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
        <h2 style="margin-top:0px">T30_absensi <?php echo $button ?></h2> -->
        <form action="<?php echo $action; ?>" method="post">
			<div class="form-group">
            	<label for="int">NAMA <?php echo form_error('idsiswa') ?></label>
            	<input type="text" class="form-control" name="" id="" placeholder="" value="<?php echo $Nama; ?>" readonly />
        	</div>
			<div class="form-group">
            	<label for="int">S <?php echo form_error('S') ?></label>
            	<input type="text" class="form-control" name="S" id="S" placeholder="S" value="<?php echo $S; ?>" />
        	</div>
			<div class="form-group">
            	<label for="int">I <?php echo form_error('I') ?></label>
            	<input type="text" class="form-control" name="I" id="I" placeholder="I" value="<?php echo $I; ?>" />
        	</div>
			<div class="form-group">
            	<label for="int">A <?php echo form_error('A') ?></label>
            	<input type="text" class="form-control" name="A" id="A" placeholder="A" value="<?php echo $A; ?>" />
        	</div>
			<input type="hidden" name="idabsensi" value="<?php echo $idabsensi; ?>" />
			<button type="submit" class="btn btn-primary"><?php echo $button ?></button>
			<a href="<?php echo site_url('t30_absensi') ?>" class="btn btn-secondary">Batal</a>
		</form>
    <!-- </body>
</html> -->
