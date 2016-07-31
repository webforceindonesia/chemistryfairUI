<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function dateReverse ($date)
            {
                $dateArray = explode('-',$date);
                $reversed = $dateArray['2'] . "-" . $reversed = $dateArray['1'] . "-" . $reversed = $dateArray['0'];
                return $reversed;
            }
?>
<section id="contentAll">
<div class="container">
        <div class="row">
        	<div class="col-md-12">
        		<table class="table bordered" style="color:#000; font-size:12px; margin-left:-100px;">
	        		<tr>
	        			<td>Id</td>
	        			<td>Account Id</td>
	        			<td>Member 1</td>
	        			<td>Member 2</td>
	        			<td>Member Link 1</td>
	        			<td>Member Link 2</td>
	        			<td>Nama Institusi</td>
	        			<td>Provinsi</td>
	        			<td>Nama Pendamping</td>
	        			<td>No Telp Pendamping</td>
	        			<td>Hari Menginap</td>
	        			<td>Pendamping Menginap</td>
	        			<td>Butuh Transportasi</td>
	        			<td>Link Bukti Pembayaran</td>
	        			<td>Sudah Membayar</td>
	        			<td>Waktu Register</td>
	        			<td>Action</td>
	        		</tr>
	        		<?php 
	        			$total = 0;
	        			foreach ($participants as $row) { ?>
	        			<tr>
	        				<td><?php echo $row->id; ?></td>
	        				<td><?php echo $row->account_id; ?></td>
	        				<td><?php echo $row->fullname_member1; ?></td>
	        				<td><?php echo $row->fullname_member2; ?></td>
	        				<td><?php echo $row->identity_member1_link; ?></td>
	        				<td><?php echo $row->identity_member2_link; ?></td>
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
	        				<td><?php echo $row->teacher_name; ?></td>
	        				<td><?php echo $row->teacher_phone_number; ?></td>
	        				<td><?php echo $row->lodging_days; ?></td>
	        				<td>
	        					<?php if($row->teacher_needs_lodging == 1)
	        					{
	        						echo 'Yes';
	        					}else
	        					{
	        						echo 'No';
	        					} 
	        					?>
	        				</td>
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
	        				<td><?php echo $row->payment_proof_link; ?></td>
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
	        				<td><?php echo dateReverse($row->time_registered); ?></td>
	        				<td><a href="<?php echo base_url('admin/konfirmasi_pembayaran/cc/'.$row->account_id) ?>">Conf Pembayaran</a></td>
	        			</tr>
	        		<?php 
	        			$total++;
	        		} 
	        		?>
        		</table>
        	</div>
        </div>
        <div class="row">
        	<div class="col-md-8">
        		&nbsp
        	</div>
        	<div class="col-md-4">
        		<ul class="pagination">
        		<?php echo $pagination ?>
				</ul>
        	</div>
        </div>
  </div>
</section>