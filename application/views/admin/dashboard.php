<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- Data Tables Links -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/jqc-1.12.3/jszip-2.5.0/dt-1.10.12/af-2.1.2/b-1.2.2/b-colvis-1.2.2/b-html5-1.2.2/b-print-1.2.2/cr-1.3.2/fc-3.2.2/fh-3.1.2/kt-2.1.3/r-2.1.0/rr-1.1.2/sc-1.4.2/se-1.2.0/datatables.min.css"/>
 
<script type="text/javascript" src="https://cdn.datatables.net/v/bs/jqc-1.12.3/jszip-2.5.0/dt-1.10.12/af-2.1.2/b-1.2.2/b-colvis-1.2.2/b-html5-1.2.2/b-print-1.2.2/cr-1.3.2/fc-3.2.2/fh-3.1.2/kt-2.1.3/r-2.1.0/rr-1.1.2/sc-1.4.2/se-1.2.0/datatables.min.js"></script>


<section id="contentAll">
   <div class="container">
        	<?php if($this->session->flashdata('success'))
        	{?>

        		<div class="alert alert-success">
					<?php echo $this->session->flashdata('success') ?>
				</div>

        	<?php }else if($this->session->flashdata('errors'))
        	{ ?>

        		<div class="alert alert-danger">
					<?php echo $this->session->flashdata('errors') ?>
				</div>

        	<?php } ?>


          <div class="container">
              <div class="row">
                <h1>Semua Akun Pendaftar</h1>
              </div>
              <div class="row" style="overflow-x:scroll;">
                <table class="table table-bordered" style="color:#000" id="akun">
                <thead>
                  <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>No Telpon</th>
                    <th>Pendaftaran Lomba</th>
                    <th>Akun Sudah Di Verifikasi</th>
                    <th>Waktu Pendaftaran</th>
                    <th>Override Verifikasi</th>
                    <th>Delete Akun</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($accounts as $account): ?>
                  <tr>
                    <td><?php echo $account['fullname'] ?></td>
                    <td><?php echo $account['email'] ?></td>
                    <td><?php echo $account['phone_number'] ?></td>
                    <td><?php echo $account['participations'] ?></td>
                    <td><?php if($account['is_verified'] > 0)
                    {
                      echo 'Sudah Di Verifikasi';
                    }else
                    {
                      echo '<p style="color: red">Belum Di Verifikasi</p>';
                    }
                    ?>
                    </td>
                    <td><?php echo $account['time_created'] ?></td>
                    <td><a href="<?php echo base_url(); ?>admin/verify_override/<?php echo $account['id']; ?>">Verifikasi Manual</a></td>
                    <td><a href="<?php echo base_url(); ?>admin/delete_account/<?php echo $account['id']; ?>">Delete Akun</a></td>
                  </tr>
                  <?php endforeach; ?>
                </tbody>
                </table>
              </div>
          </div>
   </div>
</section>
            
<script type="text/javascript" src="<?php echo base_url() ?>js/stacktable.min.js"></script>
<script>

$(document).ready( function () {
    $('#akun').DataTable({
      responsive:true
    });
} );

</script>
<?php if($this->session->flashdata('success')): ?>
  <script>
    swal("Success!", "<?php echo $this->session->flashdata('success') ?>", "success");
  </script>
<?php endif; ?>