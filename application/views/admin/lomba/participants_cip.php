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
<script src="https://use.fontawesome.com/e72fe59750.js"></script>
<section id="contentAll">
<div class="container">
        <div class="row">
        	<div class="col-md-12">
        		<table class="table bordered" style="color:#000; font-size:11px; margin-left:-150px;"">
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
	        				<td><?php echo dateReverse($row->time_registered); ?></td>
	        				<td style="font-size:18px;"><?php if($row->payment_proof_link != NULL): ?><a href="<?php echo base_url('admin/konfirmasi/pembayaran/cip/'.$row->account_id) ?>"><i class="fa fa-money" aria-hidden="true"></i></a><?php endif; ?>
	        				<a href="<?php echo base_url('admin/konfirmasi/abstrak/cip/'.$row->account_id) ?>"><i class="fa fa-thumbs-up" aria-hidden="true"></i></a></td>
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