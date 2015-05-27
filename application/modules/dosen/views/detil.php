<div class="row">
	<div class="col-lg-8">
		<div class="row">
			<div class="col-lg-12">
				<h3>
					<?php echo $prodi ?>
				</h3>
				<hr>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-3">
				<img src="<?php echo base_url().'inventory/gambar/dosen/thumb/'.$img ?>" style="width:100%;height:180px">
			</div>
			<div class="col-lg-9">
				<h4><b><?php echo $nama ?></b></h4>
				<hr>
				<p>
					<b>Fokus Keahlian</b>
					<p>
						<?php echo $fokus ?>
					</p>
				</p>
				<p>
					<b>Telp/Hp.</b>
					<p>
						<?php echo $telp ?>
					</p>
				</p>
				<p>
					<b>Email</b>
					<p>
						<?php echo $email ?>
					</p>
				</p>
				<p>
					<b>Alamat</b>
					<p>
						<?php echo $alamat ?>
					</p>
				</p>
				<hr>
				<p>
					<b>Riwayat Pendidikan</b>
					<p>
						<?php echo $sekolah ?>
					</p>
				</p>
				<p>
					<b>Jurnal dan Publikasi Ilmiah</b>
					<p>
						<?php echo $jurnal ?>
					</p>
				</p>
				<p>
					<b>Pelatihan dan Seminar</b>
					<p>
						<?php echo $pelatihan ?>
					</p>
				</p>
				<p>
					<b>Organisasi dan Keanggotaan</b>
					<p>
						<?php echo $organisasi ?>
					</p>
				</p>
			</div>
		</div>
	</div>
	<div class="col-lg-4">
		<div class="col-lg-12 alpha">
			<br>
			<?php
				echo $widget_konsentrasi;
				echo "<br>";
				echo $widget_prodi;
				echo "<br>";
				echo $widget_agenda;
			?>
		</div>
	</div>
</div>