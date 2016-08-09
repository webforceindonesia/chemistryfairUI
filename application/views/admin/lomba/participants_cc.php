<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function dateReverse ($date)
            {
                $dateArray = explode('-',$date);
                $reversed = $dateArray['2'] . "-" . $reversed = $dateArray['1'] . "-" . $reversed = $dateArray['0'];
                return $reversed;
            }
?>

<!-- Data Tables Links -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/jqc-1.12.3/jszip-2.5.0/dt-1.10.12/af-2.1.2/b-1.2.2/b-colvis-1.2.2/b-html5-1.2.2/b-print-1.2.2/cr-1.3.2/fc-3.2.2/fh-3.1.2/kt-2.1.3/r-2.1.0/rr-1.1.2/sc-1.4.2/se-1.2.0/datatables.min.css"/>
 
<script type="text/javascript" src="https://cdn.datatables.net/v/bs/jqc-1.12.3/jszip-2.5.0/dt-1.10.12/af-2.1.2/b-1.2.2/b-colvis-1.2.2/b-html5-1.2.2/b-print-1.2.2/cr-1.3.2/fc-3.2.2/fh-3.1.2/kt-2.1.3/r-2.1.0/rr-1.1.2/sc-1.4.2/se-1.2.0/datatables.min.js"></script>
<script>

$(document).ready( function () {
    $('#participants').DataTable();
} );

</script>

<script src="https://use.fontawesome.com/e72fe59750.js"></script>
<section id="contentAll">
<div class="container">
        <div class="row">
        	<div class="col-md-12" id="table-participants" style="overflow-x:scroll; max-width:120%">
        		<table class="table table-bordered" id="participants" style="color:#000; font-size:12px;">
        		<thead>
	        		<tr>
	        			<td>No.</td>
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
	        	</thead>
	        	<tbody>
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
	        	</tbody>
        		</table>
        	</div>
        </div>
  </div>
</section>