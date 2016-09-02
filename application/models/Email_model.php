<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Email_model extends CI_Model {

	public function __construct ()
	{
		//Call Parent Constructor
		parent::__construct();
	}
	
	public function contactus ($data)
	{
		$subject  = "Kontak Peserta";

		$headers  = "From: kontak-kami@chemistryfair-ui.com \r\n";
		$headers .= "Reply-To: chemistryfair2016@gmail.com \r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

		$message  = "<html><body>";
		$message .= "<h2>".$data['name']."</h2>";
		$message .= '<table border="1px">';
		$message .= "<tr>";
		$message .= "<td>Nama</td><td>".$data['name']."</td>";
		$message .= "</tr>";
		$message .= "<tr>";
		$message .= "<td>Email</td><td>".$data['email']."</td>";
		$message .= "</tr>";
		$message .= "<tr>";
		$message .= "<td>Content</td><td>".$data['content']."</td>";
		$message .= "</tr>";
		$message .= "</table>";
		$message .= "</body></html>";


		if(mail("chemistryfair2016@gmail.com", $subject, $message, $headers))
		{
			return true;
		}else
		{
			return false;
		}
	}

	public function email_transportasi ()
	{
		$subject  = "Informasi Transportasi dan Penginapan Peserta";

		$headers  = "From: noreply@chemistryfair-ui.com \r\n";
		$headers .= "Reply-To: chemistryfair2016@gmail.com \r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

		$message  = 
<<<HHH
	<html>		
			<body>
				<table class="table table-bordered">
					<tr>
						<td>Nama Ketua</td>
						<td>$this->input->post('nama-ketua')</td>
					</tr>
					<tr>
						<td>Bersedia Datang Ke Campus UI</td>
						<td>$this->input->post('datang')</td>
					</tr>
					<tr>
						<td>Butuh penginapan selama rangkaian acara Chemistry Innovation Project</td>
						<td>$this->input->post('penginapan')</td>
					</tr>
					<tr>
						<td>. Jika Ya, berapakah anggota kelompok yang butuh penginapan</td>
						<td>$this->input->post('anggota-penginapan')</td>
					</tr>
					<tr>
						<td>Jenis Kelamin Ketua</td>
						<td>$this->input->post('gender_ketua')</td>
					</tr>
					<tr>
						<td>Jenis Kelamin Anggota</td>
						<td>$this->input->post('gender_anggota')</td>
					</tr>
					<tr>
						<td>Apakah guru pendamping juga memerlukan penginapan</td>
						<td>$this->input->post('guru-penginapan')</td>
					</tr>
					<tr>
						<td>Kapankah tanggal kedatangan Anda</td>
						<td>$this->input->post('tanggal-kedatangan')</td>
					</tr>
					<tr>
						<td>Transportasi apakah yang Anda gunakan</td>
						<td>$this->input->post('kendaraan')</td>
					</tr>
					<tr>
						<td>Maskapai apa yang Anda gunakan</td>
						<td>$this->input->post('maskapai')</td>
					</tr>
					<tr>
						<td>Pada pukul berapa pesawat Anda dijadwalkan berangkat</td>
						<td>$this->input->post('brangkat-pesawat')</td>
					</tr>
					<tr>
						<td>Pada pukul berapa pesawat Anda dijadwalkan tiba</td>
						<td>$this->input->post('tiba-pesawat')</td>
					</tr>
					<tr>
						<td>Di terminal berapa Anda akan turun</td>
						<td>$this->input->post('terminal-pesawat')</td>
					</tr>
					<tr>
						<td>Dari stasiun manakah Anda berangkat</td>
						<td>$this->input->post('stasiun-krl')</td>
					</tr>
					<tr>
						<td>Pada pukul berapakah kereta Anda dijadwalkan berangkat</td>
						<td>$this->input->post('brangkat-krl')</td>
					</tr>
					<tr>
						<td>Pada pukul berapakah kereta Anda dijadwalkan tiba</td>
						<td>$this->input->post('tiba-krl')</td>
					</tr>
					<tr>
						<td>Apa stasiun tujuan Anda</td>
						<td>$this->input->post('tiba-krl')</td>
					</tr>
					<tr>
						<td>Pada pukul berapakah estimasi Anda untuk tiba di St. UI</td>
						<td>$this->input->post('tujuan-krl')</td>
					</tr>
					<tr>
						<td>Dari terminal manakah Anda berangkat</td>
						<td>$this->input->post('stasiun-bus')</td>
					</tr>
					<tr>
						<td>Pada pukul berapa bus Anda dijadwalkan berangkat</td>
						<td>$this->input->post('brangkat-bus')</td>
					</tr>
					<tr>
						<td>Pada pukul berapa bus Anda dijadwalkan tiba</td>
						<td>$this->input->post('tiba-bus')</td>
					</tr>
					<tr>
						<td>Di terminal berapa Anda akan turun</td>
						<td>$this->input->post('terminal-bus')</td>
					</tr>
					<tr>
						<td>Kapankah tanggal kepulangan Anda</td>
						<td>$this->input->post('pulang')</td>
					</tr>
					<tr>
						<td>Transportasi apa yang Anda gunakan</td>
						<td>$this->input->post('kendaraan-pulang')</td>
					</tr>
					<tr>
						<td>Maskapai apa yang Anda gunakan</td>
						<td>$this->input->post('maskapai-pulang')</td>
					</tr>
					<tr>
						<td>Pada pukul berapa pesawat Anda dijadwalkan berangkat</td>
						<td>$this->input->post('brangkat-pesawat-pulang')</td>
					</tr>
				</table>
			</body>
	</html>
HHH;


		if(mail("chemistryfair2016@gmail.com", $subject, $message, $headers))
		{
			return true;
		}else
		{
			return false;
		}
	}
}
?>