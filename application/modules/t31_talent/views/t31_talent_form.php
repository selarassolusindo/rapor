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
        <h2 style="margin-top:0px">T31_talent <?php echo $button ?></h2> -->
        <form action="<?php echo $action; ?>" method="post">
			<div class="form-group">
            	<label for="int">Idsiswa <?php echo form_error('idsiswa') ?></label>
            	<input type="text" class="form-control" name="idsiswa" id="idsiswa" placeholder="Idsiswa" value="<?php echo $idsiswa; ?>" />
        	</div>
			<div class="form-group">
            	<label for="TalentNilai">TalentNilai <?php echo form_error('TalentNilai') ?></label>
            	<textarea class="form-control" rows="3" name="TalentNilai" id="TalentNilai" placeholder="TalentNilai"><?php echo $TalentNilai; ?></textarea>
        	</div>
			<input type="hidden" name="idtalenttr" value="<?php echo $idtalenttr; ?>" />
			<button type="submit" class="btn btn-primary"><?php echo $button ?></button>
			<a href="<?php echo site_url('t31_talent') ?>" class="btn btn-secondary">Batal</a>
		</form>
    <!-- </body>
</html> -->
