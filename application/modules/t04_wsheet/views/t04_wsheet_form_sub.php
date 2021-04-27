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
        <h2 style="margin-top:0px">T04_wsheet <?php //echo $button ?></h2> -->
        <form action="<?php echo $action; ?>" method="post">
            <input type="hidden" name="idmapel" value="<?php echo $idmapel; ?>" />
            <input type="hidden" name="induk" value="<?php echo $induk; ?>" />
			<div class="form-group">
            	<label for="int">MATA PELAJARAN <?php echo form_error('idmapel') ?></label>
            	<input type="text" class="form-control" name="" id="" placeholder="" value="<?php echo $MataPelajaran; ?>" readonly />
        	</div>
			<div class="form-group">
            	<label for="int">NO. URUT <small>KOMPETENSI DASAR</small> <?php echo form_error('NoUrut') ?></label>
            	<input type="text" class="form-control" name="NoUrutRO" id="NoUrut" placeholder="NOURUT" value="<?php echo $NoUrutRO; ?>" readonly />
        	</div>
			<div class="form-group">
            	<label for="Kdasar">KOMPETENSI DASAR <?php echo form_error('Kdasar') ?></label>
            	<textarea class="form-control" rows="3" name="KdasarRO" id="Kdasar" placeholder="KDASAR" readonly ><?php echo $KdasarRO; ?></textarea>
        	</div>
            <div class="form-group">
            	<label for="int">NO. URUT <small>SUB KOMPETENSI DASAR</small> <?php echo form_error('NoUrut') ?></label>
            	<input type="text" class="form-control" name="NoUrut" id="NoUrut" placeholder="NOURUT" value="<?php echo $NoUrut; ?>" />
        	</div>
			<div class="form-group">
            	<label for="Kdasar">SUB KOMPETENSI DASAR <?php echo form_error('Kdasar') ?></label>
            	<textarea class="form-control" rows="3" name="Kdasar" id="Kdasar" placeholder="KDASAR"><?php echo $Kdasar; ?></textarea>
        	</div>
			<input type="hidden" name="idwsheet" value="<?php echo $idwsheet; ?>" />
			<button type="submit" class="btn btn-primary"><?php echo $button ?></button>
			<a href="<?php echo site_url('t04_wsheet') ?>" class="btn btn-secondary">Batal</a>
		</form>
    <!-- </body>
</html> -->
