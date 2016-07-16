Seminar
<br>
Seminar is the bla bla bla bla bla <br>
Seminar is the bla bla bla bla bla <br>
Seminar is the bla bla bla bla bla <br>
Seminar is the bla bla bla bla bla <br>
Seminar is the bla bla bla bla bla <br>

<?php 
if (isset($user_participant_id['seminar'])) 
{
    echo 'Anda telah terdaftar dalam lomba ini!<br>';
    echo '<a href="' . site_url('test/dashboard/seminar') . '">Dashboard Peserta</a>';
}
else
{
    echo '<a href="' . site_url('test/register/seminar') . '">Daftar Acara</a>';
}
?>
