<div class="row agenda">
	<!-- Agenda -->
	<div class="thumbnail">
		<div class="judul">
			<span>Agenda</span>&nbsp
			<h2>Terdekat</h2>
		</div>
		<div class="col-md-12">
			<?php  
			if (count($result)>0) {
				foreach ($result as $record) {
			?>
					<div class="row content">
						<div class="row">
							<div class="col-xs-1 col-lg-2 col-md-2 col-sm-1 omega"><span class="glyphicon glyphicon-time"></span></div>
							<div class="col-xs-11 col-lg-10 col-md-10 col-sm-11 alpha">
								<tgl><?php echo $this->indo_date->tgl_indo($record->date_start)." s/d ".$this->indo_date->tgl_indo($record->date_end);?></tgl>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-1 col-lg-2 col-md-2 col-sm-1 omega"><span class="glyphicon glyphicon-tasks"></span></div>
							<div class="col-xs-11 col-lg-10 col-md-10 col-sm-11 alpha">
								<?php echo anchor('agenda/detil/'.$record->id_agenda.'-'.$record->slug, $record->title);?>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-1 col-lg-2 col-md-2 col-sm-1 omega"><span class="glyphicon glyphicon-map-marker"></span></div>
							<div class="col-xs-11 col-lg-10 col-md-10 col-sm-11 alpha">
								<tgl><?php echo $record->place;?></tgl>
							</div>
						</div>
						<hr size='1px' width='90%'>
					</div>
			<?php
				}
			}
			?>
		</div>
		<div class="right">
			<?php echo anchor('agenda', 'More >>');?>
		</div>
	</div>
</div>