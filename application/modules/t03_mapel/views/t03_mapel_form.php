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
        <h2 style="margin-top:0px">T03_mapel <?php //echo $button ?></h2> -->
        <form action="<?php echo $action; ?>" method="post">
			<div class="form-group">
            	<label for="int">KELOMPOK <?php echo form_error('idkelompok') ?></label>
            	<!-- <input type="text" class="form-control" name="idkelompok" id="idkelompok" placeholder="KELOMPOK" value="<?php echo $idkelompok; ?>" /> -->
                <select class="form-control" name="idkelompok">
                    <?php
                    foreach($dataKelompok as $d) {
                        ?>
                        <option value="<?php echo $d->idkelompok ?>" <?php echo $d->idkelompok == $idkelompok ? "selected" : "" ?>><?php echo $d->Kelompok ?></option>
                        <?php
                    }
                    ?>
                </select>
        	</div>
			<div class="form-group">
            	<label for="varchar">MATA PELAJARAN <?php echo form_error('MataPelajaran') ?></label>
            	<input type="text" class="form-control" name="MataPelajaran" id="MataPelajaran" placeholder="MATA PELAJARAN" value="<?php echo $MataPelajaran; ?>" />
        	</div>
			<div class="form-group">
            	<label for="varchar">SKM <?php echo form_error('SKM') ?></label>
            	<input type="text" class="form-control" name="SKM" id="SKM" placeholder="SKM" value="<?php echo $SKM; ?>" />
        	</div>
			<input type="hidden" name="idmapel" value="<?php echo $idmapel; ?>" />
			<button type="submit" class="btn btn-primary"><?php echo $button ?></button>
			<a href="<?php echo site_url('t03_mapel') ?>" class="btn btn-secondary">Batal</a>
		</form>
    <!-- </body>
</html> -->
