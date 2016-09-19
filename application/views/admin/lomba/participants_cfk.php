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
    $('#participants').DataTable({
      responsive:true
    });
} );

</script>

<script src="https://use.fontawesome.com/e72fe59750.js"></script>
<section id="contentAll">
<div class="container">
        <div class="row">
        	<div class="col-md-12" id="table-participants" style="overflow-x:scroll; max-width:120%">
        		<table class="table table-bordered" id="participants" style="color:#000; font-size:18px;"">
        		<thead>
	        		<tr>
	        			<td>Id</td>
	        			<td>Account Id</td>
	        			<td>Type</td>
	        			<td>Full Name</td>
	        			<td>Nama Pendamping</td>
	        			<td>Nama Institusi</td>
	        			<td>Lomba Diikuti</td>
	        			<td>Bukti Transfer</td>
	        			<td>Waktu Pendaftaran</td>
	        			<td>Action</td>
	        		</tr>
	        		</thead>
	        		<tbody>
	        		<?php foreach ($participants as $row) { ?>
	        			<tr>
	        				<td><?php echo $row->id; ?></td>
	        				<td><?php echo $row->account_id; ?></td>
	        				<td><?php echo ($row->is_tk == 1)? 'TK' : 'SD'; ?></td>
	        				<td><?php echo $row->fullname; ?></td>
	        				<td><?php echo $row->fullname_parent; ?></td>
	        				<td><?php echo $row->institution_name; ?></td>
	        				<td>
	        					<?php
	        						switch($row->competition)
	        						{
	        							case 1:
	        							{
	        								echo 'Drawing';
	        							}break;

	        							case 2:
	        							{
	        								echo 'Menghias Kue';
	        							}break;

	        							case 3:
	        							{
	        								echo 'Drawing and Menghias Kue';
	        							}break;
	        						}
	        					?>
	        				</td>
	        				<td>
	        					<?php if($row->payment_proof_link != NULL): ?>
		        					<a href="<?php echo base_url() . $row->payment_proof_link ?>">
		        						<img src="<?php echo base_url() . $row->payment_proof_link ?>" width="50px">
		        					</a>
		        				<?php else: ?>
		        					Belum Membayar
		        				<?php endif; ?>
	        				</td>
	        				<td><?php echo dateReverse($row->time_registered); ?></td>
	        				<td>
		        				<a href="<?php echo base_url('admin/konfirmasi/pembayaran/cfk/'.$row->account_id) ?>">Conf Pembayaran</a>
		        				<a href="<?php echo base_url('admin/konfirmasi/pembayaran/cfk/'.$row->account_id.'/invalid') ?>">Pembayaran Gagal</a>
		        			</td>
	        			</tr>
	        		<?php } ?>
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