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
        		<table class="table bordered" style="color:#000; font-size:18px;"">
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