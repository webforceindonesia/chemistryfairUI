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
        		<table class="table table-bordered" id="participants" style="color:#000; font-size:14px;"">
        		<thead>
	        		<tr>
	        			<td>Id</td>
	        			<td>Account Id</td>
	        			<td>Phone</td>
	        			<td>Full Name</td>
	        			<td>Nama Institusi</td>
	        			<td>Address</td>
	        			<td>Photo</td>
	        			<td>Email</td>
	        			<td>Photo KTP</td>
	        			<td>Bukti Transfer</td>
	        			<td>Foto Karya</td>
	        			<td>Sudah Membayar</td>
	        			<td>Waktu Pendaftaran</td>
	        			<td>Action</td>
	        		</tr>
	        	</thead>
	        	<tbody>
	        		<?php $total = 0;
	        		foreach ($participants as $row) { ?>
	        			<tr>
	        				<td><?php echo $row->id; ?></td>
	        				<td><?php echo $row->account_id; ?></td>
	        				<td><?php echo $row->phone_number; ?></td>
	        				<td><?php echo $row->fullname; ?></td>
	        				<td><?php echo $row->institution_name; ?></td>
	        				<td><?php echo $row->address; ?></td>
	        				<td><?php echo $row->phone; ?></td>
	        				<td><?php echo $row->email; ?></td>
	        				<td>
	        					<a href="<?php echo base_url() . $row->identity_link ?>">
	        						<img src="<?php echo base_url() . $row->identity_link ?>" style="width:75px">
	        					</a>
	        				</td>
	        				<td>
	        				<?php if($row->payment_proof_link != NULL): ?>
	        					<a href="<?php echo base_url() . $row->payment_proof_link ?>">
	        						<img src="<?php echo base_url() . $row->payment_proof_link ?>" style="width:75px">
	        					</a>
	        				<?php endif; ?>
	        				</td>
	        				<td>
	        				<?php if($row->instagram_photo_link != NULL): ?>
	        					<a href="<?php echo base_url() . $row->instagram_photo_link ?>">
	        						<img src="<?php echo base_url() . $row->instagram_photo_link ?>" style="width:75px">
	        					</a><br><br><strong>Deskripsi Foto</strong>
	        					<p><a href="<?php echo base_url() . $row->photo_description ?>">Download Photo Description</a></p>
	        				<?php endif; ?>
	        				</td>
	        				<td>
								<?php if($row->is_paid > 0)
	        					{
	        						echo 'Yes';
	        					}else
	        					{
	        						echo 'No';
	        					} 
	        					?>
	        				</td>
	        				<td><?php echo dateReverse($row->time_registered); ?></td>
	        				<td style="font-size:18px;">
	        				<?php if($row->payment_proof_link != NULL): ?>
	        					<a href="<?php echo base_url('admin/konfirmasi/pembayaran/cp/'.$row->account_id) ?>">
	        						<i class="fa fa-money" aria-hidden="true"></i>
	        					</a><br>
	        					<a href="<?php echo base_url('admin/konfirmasi/pembayaran/cp/'.$row->account_id.'/invalid') ?>">
	        						<i class="fa fa-times" aria-hidden="true"></i>
	        					</a><br>
	        				<?php endif; ?>
		        				<a href="<?php echo base_url('admin/winner/cp/'.$row->account_id.'/winner') ?>">
		        					<i class="fa fa-trophy" aria-hidden="true"></i>
		        				</a>
	        				</td>
	        			</tr>
	        		<?php $total++;
	        		} ?>
	        	</tbody>
        		</table>
        	</div>
        </div>
  </div>
</section>

<?php if($this->session->flashdata('success')): ?>
	<script>
		swal("Success!", "<?php echo $this->session->flashdata('success') ?>", "success");
	</script>
<?php endif; ?>