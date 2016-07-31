<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<section id="contentAll">
	<div id="aboutUs">
		<div class="container">
			<div class="col-md-3">&nbsp</div>
			<div class="col-md-6" >
			<?php echo form_open_multipart('admin/slider_upload'); ?>
				<table class="table tabel-hover">
					<tr>
						<td><h1 style="color:#000;">Slide 1</h1></td>
						<td><input type="file" name="file1" style="color:#000;"></td>
					</tr>
					<tr>
						<td><h1 style="color:#000;">Slide 2</h1></td>
						<td><input type="file" name="file2" style="color:#000;"></td>
					</tr>
					<tr>
						<td><h1 style="color:#000;">Slide 3</h1></td>
						<td><input type="file" name="file3" style="color:#000;"></td>
					</tr>
					<tr>
						<td><h1 style="color:#000;">Slide 4</h1></td>
						<td><input type="file" name="file4" style="color:#000;"></td>
					</tr>
					<tr>
						<td colspan="2">
							<input style="color:#000;" type = "submit" value="upload">
						</td>
					</tr>
				</table>
				</form>
			<?php echo form_open_multipart('admin/slider_upload/tran'); ?>
				<table class="table tabel-hover">
					<tr>
						<td><h3 style="color:#000;">Slide Transition</h1></td>
						<td>
							<select name="tran" style="color:#000;" class="form form-control">
								<option value="fade"tt>Fade</option>
								<option value="slide">Slide</option>
							</select>
						</td>
					</tr>
				</table>
				<tr>
						<td colspan="2">
							<input style="color:#000;" type = "submit" value="update">
						</td>
					</tr>
			</form>
			</div>
			<div class="col-md-3">&nbsp</div>
		</div>
	</div>
</section>