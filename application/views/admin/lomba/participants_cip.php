<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<section id="contentAll">
<div class="container">
        <div class="row">
        	<div class="col-md-12">
        		<table class="table bordered" style="color:#000; font-size:11px; margin-left:-70px;"">
	        		<tr>
	        			<td>Id</td>
	        			<td>Account Id</td>
	        			<td>Type</td>
	        			<td>Member 1</td>
	        			<td>Member 2</td>
	        			<td>Member 3</td>
	        			<td>Identitas 1</td>
	        			<td>Identitas 2</td>
	        			<td>Identitas 3</td>
	        			<td>Nama Institusi</td>
	        			<td>Provinsi</td>
	        			<td>Penginapan</td>
	        			<td>Transportasi</td>
	        			<td>Status Pembayaran</td>
	        			<td>File Abstrak</td>
	        			<td>Bukti Transfer</td>
	        			<td>Waktu Pendaftaran</td>
	        			<td>Action</td>
	        		</tr>
	        		<?php $total = 0;
	        		foreach ($participants as $row) { ?>
	        			<tr>
	        				<td><?php echo $row->id; ?></td>
	        				<td><?php echo $row->account_id; ?></td>
	        				<td><?php echo $row->type; ?></td>
	        				<td><?php echo $row->fullname_member1; ?></td>
	        				<td><?php echo $row->fullname_member2; ?></td>
	        				<td><?php echo $row->fullname_member3; ?></td>
	        				<td><?php echo $row->identity_member1_link; ?></td>
	        				<td><?php echo $row->identity_member2_link; ?></td>
	        				<td><?php echo $row->identity_member3_link; ?></td>
	        				<td><?php echo $row->institution_name; ?></td>
	        				<td>
	        					<?php
		        					switch($row->province_id)
		        					{
		        						case 1:
		        						{
		        							echo 'Jakarta';
		        						}break;

		        						case 2:
		        						{
		        							echo 'Bandung';
		        						}break;

		        						case 3:
		        						{
		        							echo 'Papua';
		        						}break;
		        					}
	        					?>
	        				</td>
	        				<td><?php echo $row->lodging_days; ?></td>
	        				<td>
	        					<?php if($row->need_transport == 1)
	        					{
	        						echo 'Yes';
	        					}else
	        					{
	        						echo 'No';
	        					} 
	        					?>
	        				</td>
	        				<td>
	        					<?php if($row->is_paid == 1)
	        					{
	        						echo 'Yes';
	        					}else
	        					{
	        						echo 'No';
	        					} 
	        					?>
	        				</td>
	        				<td><a href="<?php echo base_url() . $row->abstract_link ?>">Download</a></td>
	        				<td>
	        					<?php if($row->payment_proof_link != NULL): ?>
	        						<a href="<?php echo base_url() . $row->payment_proof_link ?>">
	        							<img src="<?php echo base_url() . $row->payment_proof_link ?>" style="max-width:50px">
	        						</a>
	        					<?php else: ?>
	        						Belum Membayar
	        					<?php endif; ?>
	        				</td>
	        				<td><?php echo $row->time_registered; ?></td>
	        				<td><?php if($row->payment_proof_link != NULL): ?><a href="<?php echo base_url('admin/konfirmasi/pembayaran/cip/'.$row->account_id) ?>">Conf Pembayaran</a><br><br><?php endif; ?>
	        				<a href="<?php echo base_url('admin/konfirmasi/abstrak/cip/'.$row->account_id) ?>">Approve Abstrak</a></td>
	        			</tr>
	        		<?php $total++; 
	        		} ?>
        		</table>
        	</div>
        </div>
        <div class="row">
        	<div class="col-md-8">
        		&nbsp
        	</div>
        	<div class="col-md-4">
        		<ul class="pagination">
        		<?php for($i=0; $i<$total; $i++)
        		{?>
				  <li><a href="<?php echo base_url('admin/lomba/cc/' . $i); ?>"><?php echo $i+1; ?></a></li>
        		<?php } ?>
				</ul>
        	</div>
        </div>
  </div>
</section>