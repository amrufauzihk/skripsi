
			<script type="text/javascript">
				let val  = [];
				let type = [];

				<?php
				  for ($i=0; $i < count($column['value']); $i++) { 
				  	echo 'val.push("'.$column['value'][$i].'");';
				  }
				?>


				<?php
				  for ($i=0; $i < count($column['value']); $i++) { 
				  	echo 'type.push("'.$column['type'][$i].'");';
				  }
				?>

				$('select.select-column-paginasi').on('change', function (e) {
					paggg();
				});


				$(document).ready(function () {
					paggg();
				});

				function paggg() {
					let scp  = $('select.select-column-paginasi').children("option:selected").val();
				    let icp  = $('#input-column-paginasi');
					
				<?php
				  for ($i=0; $i < count($column['value']); $i++) { 
				  	echo 'if(scp=="'.$column['value'][$i].'"){ 
				  			icp.attr("type", "'.$column['type'][$i].'"); 
				  		  }';
				  }
				?>
				}

			</script>