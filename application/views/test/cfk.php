Chemistry Fair Kids
<br>
Chemistry Fair Kids is the bla bla bla bla bla <br>
Chemistry Fair Kids is the bla bla bla bla bla <br>
Chemistry Fair Kids is the bla bla bla bla bla <br>
Chemistry Fair Kids is the bla bla bla bla bla <br>
Chemistry Fair Kids is the bla bla bla bla bla <br>

<?php 
if (isset($user_participant_id['cfk'])) 
{
    echo 'Anda telah terdaftar dalam lomba ini!<br>';
    echo '<a href="' . site_url('test/dashboard/cfk') . '">Dashboard Peserta</a>';
}
else
{
    echo '<a href="' . site_url('test/register/cfk') . '">Daftar Acara</a>';
}
?>
