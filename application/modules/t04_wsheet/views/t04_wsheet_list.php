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
        <h2 style="margin-top:0px">T04_wsheet List</h2> -->
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <?php echo anchor(site_url('t04_wsheet/create'),'Tambah', 'class="btn btn-primary"'); ?>
                <?php echo anchor(site_url('t04_wsheet/sinkronisasi'),'Sinkronisasi', 'class="btn btn-primary"'); ?>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                <form action="<?php echo site_url('t04_wsheet'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('t04_wsheet'); ?>" class="btn btn-secondary">Reset</a>
                                    <?php
                                }
                            ?>
                          <button class="btn btn-primary" type="submit">Cari</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
        <div class="table-responsive">
            <?php
            $recordPertama = 1;
            $cetakHeader = 0;
            $header = $t04_wsheet_data;
            foreach ($t04_wsheet_data as $t04_wsheet) {
                if ($recordPertama == 1) {
                    // $tripNo = $t30_tamu->TripNo;
                    $MataPelajaran = $t04_wsheet->MataPelajaran;
                    $recordPertama = 0;
                    $cetakHeader = 1;
                } else {
                    if ($MataPelajaran != $t04_wsheet->MataPelajaran) {
                        $MataPelajaran = $t04_wsheet->MataPelajaran;

                        // close table pertama
                        echo '</table>';
                        echo '<p>&nbsp;</p>';

                        $cetakHeader = 1;
                    }
                }

                if ($cetakHeader == 1) {
                    $cetakHeader = 0;
                    echo '<h6>';
                    echo '<div class="text-center">' . 'WORKSHEET <b>' . $t04_wsheet->MataPelajaran . '</b>' . '</div>';
                    echo '</h6>';
                    echo '<table class="table table-bordered" style="margin-bottom: 10px; white-space: nowrap;">';
                    echo '   <tr>';
                    echo '		<th class="text-center">NO.</th>';
            		echo '		<th class="text-center">KOMPETENSI DASAR</th>';

                    foreach ($header as $d) {
                        if ($d->SiswaNilai == "") {
                            break;
                        }
                        $SiswaNilai = unserialize($d->SiswaNilai);
                        foreach($SiswaNilai as $data) {
                            ?>
                            <th><?php echo $data['Siswa'] ?></th>
                            <?php
                        }
                        break;
                    }

            		echo '		<th class="text-center">PROSES</th>';
                    echo '    </tr>';
                }
            ?>
                <tr>
    				<td class="text-right"><?php echo $t04_wsheet->induk == '0' ? $t04_wsheet->NoUrut : '' ?></td>
                    <td><?php echo formatNama($t04_wsheet) ?></td>
                    <?php
                    if ($t04_wsheet->SiswaNilai != "") {
                        $SiswaNilai = unserialize($t04_wsheet->SiswaNilai);
                        foreach($SiswaNilai as $data) {
                            ?>
                            <td><?php echo $data['Nilai'] ?></td>
                            <?php
                        }
                    }
                    ?>
    				<td style="text-align:center">
    				<?php
                    if ($t04_wsheet->induk == '0') {
                        echo anchor(site_url('t04_wsheet/createSub/'.$t04_wsheet->idwsheet),'Tambah');
        				echo ' | ';
                        echo anchor(site_url('t04_wsheet/update/'.$t04_wsheet->idwsheet),'Ubah');
        				echo ' | ';
                        echo anchor(site_url('t04_wsheet/delete/'.$t04_wsheet->idwsheet),'Hapus','onclick="javascript: return confirm(\'Are You Sure ?\')"');
                    } else {
                        echo anchor(site_url('t04_wsheet/updateSub/'.$t04_wsheet->idwsheet),'Ubah');
        				echo ' | ';
                        echo anchor(site_url('t04_wsheet/deleteSub/'.$t04_wsheet->idwsheet),'Hapus','onclick="javascript: return confirm(\'Are You Sure ?\')"');
                    }

    				?>
    				</td>
    			</tr>
            <?php } ?>
            </table>
        </div>
        <div class="row">
            <div class="col-md-6">
                <!-- <a href="#" class="btn btn-primary">Total Data : <?php echo $total_rows ?></a> -->
				<!-- <?php echo anchor(site_url('t04_wsheet/excel'), 'Excel', 'class="btn btn-primary"'); ?> -->
				<!-- <?php echo anchor(site_url('t04_wsheet/word'), 'Word', 'class="btn btn-primary"'); ?> -->
			</div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>
    <!-- </body>
</html> -->
