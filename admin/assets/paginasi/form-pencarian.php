<div class="pencarian-paginasi">


			    <link href="assets/lib/paginasi/paginasi.css" rel="stylesheet"> 

				<form method="get">
					<table border="0">
						<tr>
							<td>				
								<select name="Kolom" class="form-control select-column-paginasi" id="select-column-paginasi">
									<option>--- PILIH KATA KUNCI ---</option>
									<?php 
									  for ($i=0; $i < count($column['value']); $i++) { 
									?>
									<option value="<?php echo $column['value'][$i]; ?>" <?php if(isset($_GET['Kolom']) AND $_GET['Kolom']==$column['value'][$i]){echo'selected';} ?>><?php echo $column['label'][$i]; ?></option>
							    	<?php } ?>
								</select>
							</td>
							<td>
							<input type="hidden" name="page" value="<?php echo $view;?>" >
								<input type="text" name="KataKunci" placeholder="Masukkan Kata Kunci..." class="form-control" value="<?php if(isset($_GET['KataKunci'])){echo $_GET['KataKunci'];} ?>" id="input-column-paginasi">
							</td>
							<td>
								<button type="submit" class="btn btn-primary"> 
								  <i class="glyphicon glyphicon-search"></i> Cari
								</button>				
							</td>
							<td>
								<?php 
									if(isset($_GET['Kolom'])|| isset($_GET['KataKunci'])){
								?>
								    <a href="<?php echo "?page=".$view; ?>" class="btn btn-danger">
								      <i class="glyphicon glyphicon-remove-circle"></i> Batal 
								    </a>
								<?php } ?>
							</td>
						</tr>
					</table>
				</form>
			</div>
