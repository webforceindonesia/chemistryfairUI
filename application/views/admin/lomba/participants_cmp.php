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
        		<table class="table table-bordered" id="participants" style="color:#000; font-size:18px;"">
        		<thead>
	        		<tr>
	        			<td>Id</td>
	        			<td>Account Id</td>
	        			<td>Type</td>
	        			<td>Full Name</td>
	        			<td>Nama Institusi</td>
	        			<td>Photo</td>
	        			<td>Bukti Transfer</td>
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
	        				<td><?php echo $row->type; ?></td>
	        				<td><?php echo $row->fullname; ?></td>
	        				<td><?php echo $row->institution_name; ?></td>
	        				<td><img src="<?php echo base_url() ?>uploads/cip/photo/<?php echo $row->photo_link ?>"></td>
	        				<td><img src="<?php echo base_url() ?>uploads/cip/transfer/<?php echo $row->payment_proof_link ?>"></td>
	        				<td><?php echo dateReverse($row->time_registered); ?></td>
	        				<td><a href="<?php echo base_url('admin/konfirmasi_pembayaran/cip/'.$row->account_id) ?>">Conf Pembayaran</a></td>
	        			</tr>
	        		<?php $total++;
	        		} ?>
	        	</tbody>
        		</table>
        	</div>
        </div>
  </div>
</section>