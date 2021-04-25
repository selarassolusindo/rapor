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
        <h2 style="margin-top:0px">T02_kelompok List</h2> -->
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <?php echo anchor(site_url('t02_kelompok/create'),'Tambah', 'class="btn btn-primary"'); ?>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                <form action="<?php echo site_url('t02_kelompok'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('t02_kelompok'); ?>" class="btn btn-secondary">Reset</a>
                                    <?php
                                }
                            ?>
                          <button class="btn btn-primary" type="submit">Cari</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
        <table class="table table-bordered" style="margin-bottom: 10px">
            <tr>
                <th class="text-right">NO.</th>
				<th>KELOMPOK</th>
				<th class="text-center">PROSES</th>
            </tr>
			<?php foreach ($t02_kelompok_data as $t02_kelompok) { ?>
            <tr>
				<td width="80px" class="text-right"><?php echo ++$start ?></td>
				<td><?php echo $t02_kelompok->Kelompok ?></td>
				<td style="text-align:center" width="200px">
				<?php
				//echo anchor(site_url('t02_kelompok/read/'.$t02_kelompok->idkelompok),'Read');
				//echo ' | ';
				echo anchor(site_url('t02_kelompok/update/'.$t02_kelompok->idkelompok),'Ubah');
				echo ' | ';
				echo anchor(site_url('t02_kelompok/delete/'.$t02_kelompok->idkelompok),'Hapus','onclick="javascript: return confirm(\'Are You Sure ?\')"');
				?>
				</td>
			</tr>
            <?php } ?>
        </table>
        <div class="row">
            <div class="col-md-6">
                <a href="#" class="btn btn-primary">Total Data : <?php echo $total_rows ?></a>
				<?php echo anchor(site_url('t02_kelompok/excel'), 'Excel', 'class="btn btn-primary"'); ?>
				<?php echo anchor(site_url('t02_kelompok/word'), 'Word', 'class="btn btn-primary"'); ?>
			</div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>
    <!-- </body>
</html> -->
