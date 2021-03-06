<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function dateReverse ($date)
            {
                $dateArray = explode('-',$date);
                $reversed = $dateArray['2'] . "-" . $reversed = $dateArray['1'] . "-" . $reversed = $dateArray['0'];
                return $reversed;
            }

 $options = array(
                        '1' => 'aceh',
                        '2' => 'bali',
                        '3' => 'banten',
                        '4' => 'bengkulu',
                        '5' => 'gorontalo',
                        '6' => 'jakarta',
                        '7' => 'jambi',
                        '8' => 'jawa_barat',
                        '9' => 'jawa_tengah',
                        '10' => 'jawa_timur',
                        '11' => 'kalimantan_barat',
                        '12' => 'kalimantan_selatan',
                        '13' => 'kalimantan_tengah',
                        '14' => 'kalimantan_timur',
                        '15' => 'kalimantan_utara',
                        '16' => 'kepulauan_bangka_belitung',
                        '17' => 'kepulauan_riau',
                        '18' => 'lampung',
                        '19' => 'maluku',
                        '20' => 'maluku_utara',
                        '21' => 'nusa_tenggara_barat',
                        '22' => 'nusa_tenggara_timur',
                        '23' => 'papua',
                        '24' => 'papua_barat',
                        '25' => 'riau',
                        '26' => 'sulawesi_barat',
                        '27' => 'sulawesi_selatan',
                        '28' => 'sulawesi_tengah',
                        '29' => 'sulawesi_timur',
                        '30' => 'sulawesi_utara',
                        '31' => 'sumatera_barat',
                        '32' => 'sumatera_selatan',
                        '33' => 'sumatera_utara',
                        '34' => 'yogyakarta'
                    );
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
        		<table class="table table-bordered" id="participants" style="color:#000; font-size:16px;">
        		<thead>
	        		<tr>
	        			<td>No.</td>
	        			<td>Account Id</td>
	        			<td>Phone</td>
	        			<td>Account Email</td>
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
	        			<td>Nama Guru Pendamping</td>
	        			<td>Nomor Guru Pendamping</td>
	        			<td>Email Guru Pendamping</td>
	        			<td>Status Pembayaran</td>
	        			<td>File Abstrak</td>
	        			<td>File Makalah</td>
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
	        				<td><?php echo $row->phone_number; ?></td>
	        				<td><?php echo $emails[$total] ?></td>
	        				<td><?php echo $row->type; ?></td>
	        				<td><?php echo $row->fullname_member1; ?></td>
	        				<td><?php echo $row->fullname_member2; ?></td>
	        				<td><?php echo $row->fullname_member3; ?></td>
	        				<td><a href="<?php echo base_url() . $row->identity_member1_link; ?>"><img src="<?php echo base_url() . $row->identity_member1_link; ?>" style="max-width:50px;"></a></td>
	        				<td><a href="<?php echo base_url() . $row->identity_member2_link; ?>"><img src="<?php echo base_url() . $row->identity_member2_link; ?>" style="max-width:50px;"></a></td>
	        				<td><a href="<?php echo base_url() . $row->identity_member3_link; ?>"><img src="<?php echo base_url() . $row->identity_member3_link; ?>" style="max-width:50px;"></a></td>
	        				<td><?php echo $row->institution_name; ?></td>
	        				<td>
	        					<?php
		        						foreach ($options as $province => $name)
		        						{
		        							if($province == $row->province_id)
		        							{
		        								echo $name;
		        							}
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
	        				<td><?php echo $row->teacher_name; ?></td>
	        				<td><?php echo $row->teacher_phone; ?></td>
	        				<td><?php echo $row->teacher_email; ?></td>
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
	        				<td><a href="<?php echo base_url() . $row->abstract_link ?>">Download</a></td>
	        				<td><a href="<?php echo base_url() . $row->makalah_link ?>">Download</a></td>
	        				<td>
	        					<?php if($row->payment_proof_link != NULL): ?>
	        						<a href="<?php echo base_url() . $row->payment_proof_link ?>">
	        							<img src="<?php echo base_url() . $row->payment_proof_link ?>" style="max-width:50px">
	        						</a>
	        					<?php else: ?>
	        						Belum Membayar
	        					<?php endif; ?>
	        				</td>
	        				<td><?php echo dateReverse($row->time_registered); ?></td>
	        				<td style="font-size:18px;">
	        				<?php if($row->payment_proof_link != NULL): ?>
	        					<a href="<?php echo base_url('admin/konfirmasi/pembayaran/cip/'.$row->account_id) ?>">
	        						<i class="fa fa-money" aria-hidden="true"></i>
	        					</a><br>
	        					<a href="<?php echo base_url('admin/konfirmasi/pembayaran/cip/'.$row->account_id.'/invalid') ?>">
	        						<i class="fa fa-times" aria-hidden="true"></i>
	        					</a><br>
	        				<?php endif; ?>
		        				<a href="<?php echo base_url('admin/konfirmasi/abstrak/cip/'.$row->account_id) ?>">
		        					Abstrak<i class="fa fa-thumbs-up" aria-hidden="true"></i>
		        				</a><br>
		        				<a href="<?php echo base_url('admin/konfirmasi/abstrak/cip/'.$row->account_id.'/gagal') ?>">
		        					Abstrak<i class="fa fa-thumbs-down" aria-hidden="true"></i>
		        				</a><br>
		        				<a href="<?php echo base_url('admin/konfirmasi/makalah/cip/'.$row->account_id) ?>">
		        					Makalah<i class="fa fa-thumbs-up" aria-hidden="true"></i>
		        				</a><br>
		        				<a href="<?php echo base_url('admin/konfirmasi/makalah/cip/'.$row->account_id.'/gagal') ?>">
		        					Makalah<i class="fa fa-thumbs-down" aria-hidden="true"></i>
		        				</a><br>
		        				<a href="<?php echo base_url('admin/winner/cip/'.$row->account_id.'/winner') ?>">
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