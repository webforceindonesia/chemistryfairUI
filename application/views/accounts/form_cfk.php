    <div class="col-md-2"></div>
    <div class="dashboard-content-container col-md-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Data Peserta Chemistry Fair Kids</h3>
            </div>
            <div class="panel-body">
                <!-- The form -->
                <div class="login-form">

                    <?php
                        if($this->session->flashdata('upload_failed')): ?>
                        <?php foreach ($this->session->flashdata('upload_failed') as $error_msg) : ?>
                            <div class="alert alert-danger">
                                <?php echo $error_msg; ?>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>

                    <?php
                        if($this->session->flashdata('upload')): ?>
                        <div class="alert alert-success">
                            <?php echo $this->session->flashdata('upload'); ?>
                        </div>
                    <?php endif; ?>

                    <?php
                        if($this->session->flashdata('make_failed')): ?>
                        <div class="alert alert-danger">
                            <?php echo $this->session->flashdata('make_failed'); ?>
                        </div>
                    <?php endif; ?>

                    <!-- Show the form for account registration -->
                    <?php echo form_open_multipart('daftar/cfk/' . $mode);

                    // Nama Institusi
                    echo form_label('Nama Institusi Pendidikan', 'institution_name', array('class' => 'form-label'));
                    echo form_error('institution_name');
                    echo form_input(array(
                        'class'         => 'form-input-generic form-control', 
                        'name'          => 'institution_name',
                        'value'         => empty($user_institution_name) ? set_value('institution_name') : $user_institution_name
                    )); 
                    echo '<br/>';

                    // Fullname
                    echo form_label('Nama Lengkap', 'fullname', array('class' => 'form-label'));
                    echo form_error('fullname');
                    echo form_input(array(
                        'class'         => 'form-input-generic form-control', 
                        'name'          => 'fullname',
                        'value'         => empty($user_fullname) ? set_value('fullname') : $user_fullname
                    )); 
                    echo '<br/>';

                    // Fullname Parent
                    echo form_label('Nama Lengkap Pendamping', 'fullname_parent', array('class' => 'form-label'));
                    echo form_error('fullname_parent');
                    echo form_input(array(
                        'class'         => 'form-input-generic form-control', 
                        'name'          => 'fullname_parent',
                        'value'         => empty($user_fullname_parent) ? set_value('fullname_parent') : $user_fullname_parent
                    )); 
                    echo '<br/>';

                    // Age
                    echo form_label('Umur Peserta', 'age', array('class' => 'form-label'));
                    echo form_error('age');
                    echo form_input(array(
                        'class'         => 'form-input-generic form-control', 
                        'name'          => 'age',
                        'value'         => empty($user_age) ? set_value('age') : $user_age
                    )); 
                    echo '<br/>';

                    // Competitions
                    echo form_label('Kompetisi', 'competition', array('class' => 'form-label'));
                    echo form_error('competition');
                    if (($user_competition & 1) == 1) echo form_checkbox(array('name' => 'competition_draw', 'value' => 'true', 'checked' => 'checked'));
                    else echo form_checkbox('competition_draw', 'true', set_checkbox('competition_draw', 'true'), array('class' => 'form-control'));
                    echo '<p style="color:black">Mewarnai </p>';
                    if (($user_competition & 2) == 2) echo form_checkbox(array('name' => 'competition_cake', 'value' => 'true', 'checked' => 'checked'));
                    else echo form_checkbox('competition_cake', 'true', set_checkbox('competition_cake', 'true'), array('class' => 'form-control'));
                    echo '<p style="color:black">Menghias Kue </p> <br><br>';

                    // Tingkat lomba
                    echo form_label('Tingkat Lomba', 'is_tk', array('class' => 'form-label'));
                    echo form_error('is_tk');
                    echo form_radio(array(
                        'class'         => 'form-input-generic form-control', 
                        'name'          => 'is_tk',
                        'value'         => '0',
                        'style'         =>  'width:50px;margin-top:20px;'
                    ));
                    echo '<p style="color:black">SD </p>';
                    echo form_radio(array(
                        'class'         => 'form-input-generic form-control', 
                        'name'          => 'is_tk',
                        'value'         => '1',
                        'style'         =>  'width:50px;margin-top:20px;'
                    ));
                    echo '<p style="color:black">TK </p>';
                    echo '<br/>';

                    // Teachers
                    echo form_label('No. Telepon Pendamping', 'phone', array('class' => 'form-label', 'id' => 'phone'));
                    echo form_error('phone');
                    echo form_input(array(
                        'class'         => 'form-input-generic form-control', 
                        'name'          => 'phone',
                        'value'         => empty($user_phone) ? set_value('phone') : $user_phone
                    )); 
                    echo '<br/>';

                    echo '<br/>';

                    echo form_submit(array('class' => 'form-submit',  'submit', 'value' => 'Unggah'));

                    echo '<br/>';
                    echo '<br/>';

                    echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>