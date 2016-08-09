<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Daftar extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('accounts_model');
        $this->load->helper('titlecase');
    }

    public function index()
    {
        $this->show_content('lomba');
    }

    public function cip ($param1 = '')
    {
        // Set the title and load the header
        $data['title'] = titlecase('Dashboard');
        $data['import_captcha'] = TRUE;
        $this->load->view('templates/header.php', $data);

        if($param1 == 'edit')
        {
            $this->load->model('cip_participants_model');
            if (!array_key_exists('cip', $this->session->userdata('user_participations')))
            {
                redirect('akun/dashboard/cip');
                exit();
            }

            $this->form_validation->set_rules(  
                'participant_type', 'Kategori Peserta', 
                'required', 
                array(
                    'required'      => 'Form ini harus diisi!',
                )
            );
            $this->form_validation->set_rules(  
                'institution_name', 'Nama Institusi Pendidikan', 
                'required', 
                array(
                    'required'      => 'Form ini harus diisi!',
                )
            );
            $this->form_validation->set_rules(  
                'fullname_member1', 'Nama Lengkap Ketua Tim', 
                'required', 
                array(
                    'required'      => 'Form ini harus diisi!',
                )
            );
            $this->form_validation->set_rules(  
                'id_number_member1', 'Nomor Identitas Ketua Tim (KTP/Kartu Pelajar)', 
                'required', 
                array(
                    'required'      => 'Form ini harus diisi!',
                )
            );
            $this->form_validation->set_rules(  
                'fullname_member2', 'Nama Lengkap Peserta 2', 
                'required', 
                array(
                    'required'      => 'Form ini harus diisi!',
                )
            );
            $this->form_validation->set_rules(  
                'id_number_member2', 'Nama Lengkap Peserta 2 (KTP/Kartu Pelajar)', 
                'required', 
                array(
                    'required'      => 'Form ini harus diisi!',
                )
            );
             $this->form_validation->set_rules(  
                'fullname_member3', 'Nama Lengkap Peserta 3', 
                'required', 
                array(
                    'required'      => 'Form ini harus diisi!',
                )
            );
            $this->form_validation->set_rules(  
                'id_number_member3', 'Nama Lengkap Peserta 3 (KTP/Kartu Pelajar)', 
                'required', 
                array(
                    'required'      => 'Form ini harus diisi!',
                )
            );
            $this->form_validation->set_rules(  
                'province_id', 'Asal Provinsi', 
                'required', 
                array(
                    'required'      => 'Form ini harus diisi!',
                )
            );

            $cip_data = $this->cip_participants_model->get_details($this->session->userdata('user_id'));
            $data['mode']                       = 'edit';
            $data['user_category']              = $cip_data->type;
            $data['user_institution_name']      = $cip_data->institution_name;
            $data['user_fullname_member1']      = $cip_data->fullname_member1;
            $data['user_id_number_member1']     = $cip_data->id_number_member1;
            $data['user_identity_member1_link'] = $cip_data->identity_member1_link;
            $data['user_passphoto_link1']       = $cip_data->passphoto_link1;
            $data['user_fullname_member2']      = $cip_data->fullname_member2;
            $data['user_id_number_member2']     = $cip_data->id_number_member2;
            $data['user_identity_member2_link'] = $cip_data->identity_member2_link;
            $data['user_passphoto_link2']       = $cip_data->passphoto_link2;
            $data['user_fullname_member3']      = $cip_data->fullname_member3;
            $data['user_id_number_member3']     = $cip_data->id_number_member3;
            $data['user_identity_member3_link'] = $cip_data->identity_member3_link;
            $data['user_passphoto_link3']       = $cip_data->passphoto_link3;
            $data['user_province_id']          = $cip_data->province_id;
            $data['user_lodging_days']          = $cip_data->lodging_days;
            $data['user_need_transport']        = $cip_data->need_transport;
            $data['user_teacher_name']          = $cip_data->teacher_name;
            $data['user_teacher_phone']         = $cip_data->teacher_phone;
            $data['user_teacher_email']         = $cip_data->teacher_email;

            // If the form is validated
            if ($this->form_validation->run() === TRUE)
            {
                // Change the account details in the DB
                $this->cip_participants_model->change_details($this->session->userdata('user_id'), 'type', $this->input->post('participant_type'));
                $this->cip_participants_model->change_details($this->session->userdata('user_id'), 'institution_name', $this->input->post('institution_name'));
                $this->cip_participants_model->change_details($this->session->userdata('user_id'), 'fullname_member1', $this->input->post('fullname_member1'));
                $this->cip_participants_model->change_details($this->session->userdata('user_id'), 'id_number_member1', $this->input->post('id_number_member1'));
                $this->cip_participants_model->change_details($this->session->userdata('user_id'), 'fullname_member2', $this->input->post('fullname_member2'));
                $this->cip_participants_model->change_details($this->session->userdata('user_id'), 'id_number_member2', $this->input->post('id_number_member2'));
                $this->cip_participants_model->change_details($this->session->userdata('user_id'), 'fullname_member3', $this->input->post('fullname_member3'));
                $this->cip_participants_model->change_details($this->session->userdata('user_id'), 'id_number_member3', $this->input->post('id_number_member3'));
                $this->cip_participants_model->change_details($this->session->userdata('user_id'), 'province_id', $this->input->post('province_id'));
                $this->cip_participants_model->change_details($this->session->userdata('user_id'), 'lodging_days', $this->input->post('lodging_days'));
                $this->cip_participants_model->change_details($this->session->userdata('user_id'), 'need_transport', $this->input->post('need_transport') == 'true' ? 1 : 0);
                $this->cip_participants_model->change_details($this->session->userdata('user_id'), 'teacher_name', $this->input->post('teacher_name'));
                $this->cip_participants_model->change_details($this->session->userdata('user_id'), 'teacher_phone', $this->input->post('teacher_phone'));
                $this->cip_participants_model->change_details($this->session->userdata('user_id'), 'teacher_email', $this->input->post('teacher_email'));

                // Do the file uploading if found
                if (!empty($_FILES))
                {
                    $config['upload_path']          = 'uploads/cip/' . $this->session->user_id;
                    $config['allowed_types']        = 'jpg';
                    $config['max_size']             = 5000;
                    $config['overwrite']            = TRUE;

                    $this->load->library('upload', $config);

                    $link = "uploads/cip/" . $this->session->user_id;

                    if (!file_exists ($link))
                    {
                        if(!mkdir($link, 0777, TRUE))
                        {
                            $this->session->set_flashdata('make_failed', 'Error Membuat Folder');
                        }
                    }

                    $error = array();

                    if(is_uploaded_file($_FILES['identity_member1_link']['tmp_name']))
                    {
                        $config['file_name']            = 'identity_member1_link';
                        $this->upload->initialize($config);

                        if (!$this->upload->do_upload('identity_member1_link'))
                        {
                            array_push($error, $config['file_name']  . ' : '  . $this->upload->display_errors());
                        }
                        else
                        {
                            $this->cip_participants_model->change_details($this->session->userdata('user_id'), 'identity_member1_link', $link . '/identity_member1_link' . '.jpg');
                        }
                    }

                    if(is_uploaded_file($_FILES['identity_member2_link']['tmp_name']))
                    {
                        $config['file_name']            = 'identity_member2_link';
                        $this->upload->initialize($config);

                        if (!$this->upload->do_upload('identity_member2_link'))
                        {
                            array_push($error, $config['file_name']  . ' : '  . $this->upload->display_errors());
                        }
                        else
                        {
                            $this->cip_participants_model->change_details($this->session->userdata('user_id'), 'identity_member2_link', $link . '/identity_member2_link' . '.jpg');
                        }
                    }

                    if(is_uploaded_file($_FILES['identity_member3_link']['tmp_name']))
                    {
                        $config['file_name']            = 'identity_member3_link';
                        $this->upload->initialize($config);

                        if (!$this->upload->do_upload('identity_member3_link'))
                        {
                            array_push($error, $config['file_name']  . ' : '  . $this->upload->display_errors());
                        }
                        else
                        {
                            $this->cip_participants_model->change_details($this->session->userdata('user_id'), 'identity_member3_link', $link . '/identity_member3_link' . '.jpg');
                        }
                    }

                    if(is_uploaded_file($_FILES['passphoto_link1']['tmp_name']))
                    {
                        $config['file_name']            = 'passphoto_link1';
                        $this->upload->initialize($config);

                        if (!$this->upload->do_upload('passphoto_link1'))
                        {
                            array_push($error, $config['file_name']  . ' : '  . $this->upload->display_errors());
                        }
                        else
                        {
                            $this->cip_participants_model->change_details($this->session->userdata('user_id'), 'passphoto_link1', $link . '/passphoto_link1' . '.jpg');
                        }
                    }

                    if(is_uploaded_file($_FILES['passphoto_link2']['tmp_name']))
                    {
                        $config['file_name']            = 'passphoto_link2';
                        $this->upload->initialize($config);

                        if (!$this->upload->do_upload('passphoto_link2'))
                        {
                            array_push($error, $config['file_name']  . ' : '  . $this->upload->display_errors());
                        }
                        else
                        {
                            $this->cip_participants_model->change_details($this->session->userdata('user_id'), 'passphoto_link2', $link . '/passphoto_link2' . '.jpg');
                        }
                    }

                    if(is_uploaded_file($_FILES['passphoto_link3']['tmp_name']))
                    {
                        $config['file_name']            = 'passphoto_link3';
                        $this->upload->initialize($config);

                        if (!$this->upload->do_upload('passphoto_link3'))
                        {
                            array_push($error, $config['file_name']  . ' : '  . $this->upload->display_errors());
                        }
                        else
                        {
                            $this->cip_participants_model->change_details($this->session->userdata('user_id'), 'passphoto_link3', $link . '/passphoto_link3' . '.jpg');
                        }
                    }
                    $this->session->set_flashdata('upload_failed', $error);
                }

                // Redirect to the dashboard
                redirect('akun/dashboard/cip');
            }

            // Else, show the form
            else
            {
                $this->load->view('accounts/form_cip.php', $data);
            }
        }else
        {

            $this->load->model('cip_participants_model');
                if (array_key_exists('cip', $this->session->userdata('user_participations')))
                {
                    redirect('akun/dashboard/cip');
                    exit();
                }

                $this->form_validation->set_rules(  
                    'participant_type', 'Kategori Peserta', 
                    'required', 
                    array(
                        'required'      => 'Form ini harus diisi!',
                    )
                );
                $this->form_validation->set_rules(  
                    'institution_name', 'Nama Institusi Pendidikan', 
                    'required', 
                    array(
                        'required'      => 'Form ini harus diisi!',
                    )
                );
                $this->form_validation->set_rules(  
                    'fullname_member1', 'Nama Lengkap Ketua Tim', 
                    'required', 
                    array(
                        'required'      => 'Form ini harus diisi!',
                    )
                );
                $this->form_validation->set_rules(  
                    'id_number_member1', 'Nomor Identitas Ketua Tim (KTP/Kartu Pelajar)', 
                    'required', 
                    array(
                        'required'      => 'Form ini harus diisi!',
                    )
                );
                $this->form_validation->set_rules(  
                    'fullname_member2', 'Nama Lengkap Peserta 2', 
                    'required', 
                    array(
                        'required'      => 'Form ini harus diisi!',
                    )
                );
                $this->form_validation->set_rules(  
                    'id_number_member2', 'Nama Lengkap Peserta 2 (KTP/Kartu Pelajar)', 
                    'required', 
                    array(
                        'required'      => 'Form ini harus diisi!',
                    )
                );
                 $this->form_validation->set_rules(  
                    'fullname_member3', 'Nama Lengkap Peserta 3', 
                    'required', 
                    array(
                        'required'      => 'Form ini harus diisi!',
                    )
                );
                $this->form_validation->set_rules(  
                    'id_number_member3', 'Nama Lengkap Peserta 3 (KTP/Kartu Pelajar)', 
                    'required', 
                    array(
                        'required'      => 'Form ini harus diisi!',
                    )
                );
                $this->form_validation->set_rules(  
                    'province_id', 'Asal Provinsi', 
                    'required', 
                    array(
                        'required'      => 'Form ini harus diisi!',
                    )
                );
                
                $data['mode']                       = '';
                $data['user_category']              = '';
                $data['user_institution_name']      = '';
                $data['user_fullname_member1']      = '';
                $data['user_id_number_member1']     = '';
                $data['user_identity_member1_link'] = '';
                $data['user_passphoto_link1']       = '';
                $data['user_fullname_member2']      = '';
                $data['user_id_number_member2']     = '';
                $data['user_identity_member2_link'] = '';
                $data['user_passphoto_link2']       = '';
                $data['user_fullname_member3']      = '';
                $data['user_id_number_member3']     = '';
                $data['user_identity_member3_link'] = '';
                $data['user_passphoto_link3']       = '';
                $data['user_province_id']           = '';
                $data['user_lodging_days']          = '';
                $data['user_need_transport']        = '';
                $data['user_teacher_name']          = '';
                $data['user_teacher_phone']         = '';
                $data['user_teacher_email']         = '';

                // If the form is validated
                if ($this->form_validation->run() === TRUE)
                {
                    // Register the user to the DB
                    $this->cip_participants_model->register_participant(
                        $this->session->userdata('user_id'),
                        $this->input->post('participant_type'),
                        $this->input->post('fullname_member1'),
                        $this->input->post('fullname_member2'),
                        $this->input->post('fullname_member3'),
                        $this->input->post('id_number_member1'),
                        $this->input->post('id_number_member2'),
                        $this->input->post('id_number_member3'),
                        $this->input->post('institution_name'),
                        $this->input->post('province_id'),
                        $this->input->post('lodging_days'),
                        $this->input->post('need_transport') == 'true' ? 1 : 0,
                        $this->input->post('teacher_name'),
                        $this->input->post('teacher_phone'),
                        $this->input->post('teacher_email')
                    );

                    $this->session->set_userdata('user_participations', $this->accounts_model->get_account_participation($this->session->user_id));

                    // Do the file uploading if found
                    if (!empty($_FILES))
                    {
                        $config['upload_path']          = 'uploads/cip/' . $this->session->user_id;
                        $config['allowed_types']        = 'jpg';
                        $config['max_size']             = 5000;
                        $config['overwrite']            = TRUE;

                        $this->load->library('upload', $config);

                        $link = "uploads/cip/" . $this->session->user_id;

                        if (!file_exists ($link))
                        {
                            if(!mkdir($link, 0777, TRUE))
                            {
                                $this->session->set_flashdata('make_failed', 'Error Membuat Folder');
                            }
                        }

                        $error = array();

                        if(is_uploaded_file($_FILES['identity_member1_link']['tmp_name']))
                        {
                            $config['file_name']            = 'identity_member1_link';
                            $this->upload->initialize($config);

                            if (!$this->upload->do_upload('identity_member1_link'))
                            {
                                array_push($error, $config['file_name']  . ' : '  . $this->upload->display_errors());
                            }
                            else
                            {
                                $this->cip_participants_model->change_details($this->session->userdata('user_id'), 'identity_member1_link', $link . '/identity_member1_link' . '.jpg');
                            }
                        }

                        if(is_uploaded_file($_FILES['identity_member2_link']['tmp_name']))
                        {
                            $config['file_name']            = 'identity_member2_link';
                            $this->upload->initialize($config);

                            if (!$this->upload->do_upload('identity_member2_link'))
                            {
                                array_push($error, $config['file_name']  . ' : '  . $this->upload->display_errors());
                            }
                            else
                            {
                                $this->cip_participants_model->change_details($this->session->userdata('user_id'), 'identity_member2_link', $link . '/identity_member2_link' . '.jpg');
                            }
                        }

                        if(is_uploaded_file($_FILES['identity_member3_link']['tmp_name']))
                        {
                            $config['file_name']            = 'identity_member3_link';
                            $this->upload->initialize($config);

                            if (!$this->upload->do_upload('identity_member3_link'))
                            {
                                array_push($error, $config['file_name']  . ' : '  . $this->upload->display_errors());
                            }
                            else
                            {
                                $this->cip_participants_model->change_details($this->session->userdata('user_id'), 'identity_member3_link', $link . '/identity_member3_link' . '.jpg');
                            }
                        }

                        if(is_uploaded_file($_FILES['passphoto_link1']['tmp_name']))
                        {
                            $config['file_name']            = 'passphoto_link1';
                            $this->upload->initialize($config);

                            if (!$this->upload->do_upload('passphoto_link1'))
                            {
                                array_push($error, $config['file_name']  . ' : '  . $this->upload->display_errors());
                            }
                            else
                            {
                                $this->cip_participants_model->change_details($this->session->userdata('user_id'), 'passphoto_link1', $link . '/passphoto_link1' . '.jpg');
                            }
                        }

                        if(is_uploaded_file($_FILES['passphoto_link2']['tmp_name']))
                        {
                            $config['file_name']            = 'passphoto_link2';
                            $this->upload->initialize($config);

                            if (!$this->upload->do_upload('passphoto_link2'))
                            {
                                array_push($error, $config['file_name']  . ' : '  . $this->upload->display_errors());
                            }
                            else
                            {
                                $this->cip_participants_model->change_details($this->session->userdata('user_id'), 'passphoto_link2', $link . '/passphoto_link2' . '.jpg');
                            }
                        }

                        if(is_uploaded_file($_FILES['passphoto_link3']['tmp_name']))
                        {
                            $config['file_name']            = 'passphoto_link3';
                            $this->upload->initialize($config);

                            if (!$this->upload->do_upload('passphoto_link3'))
                            {
                                array_push($error, $config['file_name']  . ' : '  . $this->upload->display_errors());
                            }
                            else
                            {
                                $this->cip_participants_model->change_details($this->session->userdata('user_id'), 'passphoto_link3', $link . '/passphoto_link3' . '.jpg');
                            }
                        }
                        $this->session->set_flashdata('upload_failed', $error);
                    }

                    // Redirect to the dashboard
                    redirect('akun/dashboard/cip');
                }

                // Else, show the form
                else
                {
                    $this->load->view('accounts/form_cip.php', $data);
                }
            }
        
        $this->load->view('templates/footer.php');
    
    }

    public function cp ($param1 = '')
    {
        $data['title'] = titlecase('Dashboard');
        $data['import_captcha'] = TRUE;
        $this->load->view('templates/header.php', $data);

        //Check if already Registered
        $this->load->model('cp_participants_model');
        if (!array_key_exists('cp', $this->session->userdata('user_participations')))
        {
                redirect('akun/dashboard/cp');
           exit();
        }


        if($param1 == 'edit')
        {  
           $this->form_validation->set_rules(  
                    'institution_name', 'Nama Institusi Pendidikan', 
                    'required', 
                    array(
                        'required'      => 'Form ini harus diisi!',
                    )
                );
                $this->form_validation->set_rules(  
                    'fullname', 'Nama Lengkap', 
                    'required', 
                    array(
                        'required'      => 'Form ini harus diisi!',
                    )
                );
                $this->form_validation->set_rules(  
                    'id_number', 'Nomor Identitas (KTP/Kartu Pelajar)', 
                    'required', 
                    array(
                        'required'      => 'Form ini harus diisi!',
                    )
                );
                $this->form_validation->set_rules(  
                    'province_id', 'Asal Provinsi', 
                    'required', 
                    array(
                        'required'      => 'Form ini harus diisi!',
                    )
                );
                $this->form_validation->set_rules(  
                    'address', 'Alamat Lengkap', 
                    'required', 
                    array(
                        'required'      => 'Form ini harus diisi!',
                    )
                );
                $this->form_validation->set_rules(  
                    'phone', 'No Telpon', 
                    'required', 
                    array(
                        'required'      => 'Form ini harus diisi!',
                    )
                );
                $this->form_validation->set_rules(  
                    'email', 'E-Mail', 
                    'required', 
                    array(
                        'required'      => 'Form ini harus diisi!',
                    )
                );
                
                $cp_data = $this->cp_participants_model->get_details($this->session->userdata('user_id'));
                $data['mode']                       = 'edit';
                $data['user_institution_name']      = $cp_data->institution_name;
                $data['user_fullname']              = $cp_data->fullname;
                $data['user_id_number']             = $cp_data->id_number;
                $data['user_identity_link']         = $cp_data->identity_link;
                $data['user_province_id']           = $cp_data->province_id;
                $data['address']                    = $cp_data->address;
                $data['email']                      = $cp_data->email;
                $data['phone']                      = $cp_data->phone;

                // If the form is validated
                if ($this->form_validation->run() === TRUE)
                {
                    // Register the user to the DB
                    $this->cp_participants_model->change_details($this->session->userdata('user_id'), 'fullname', $this->input->post('fullname'));
                    $this->cp_participants_model->change_details($this->session->userdata('user_id'), 'institution_name', $this->input->post('institution_name'));
                    $this->cp_participants_model->change_details($this->session->userdata('user_id'), 'id_number', $this->input->post('id_number'));
                    $this->cp_participants_model->change_details($this->session->userdata('user_id'), 'province_id', $this->input->post('province_id'));
                    $this->cp_participants_model->change_details($this->session->userdata('user_id'), 'address', $this->input->post('address'));
                    $this->cp_participants_model->change_details($this->session->userdata('user_id'), 'email', $this->input->post('email'));
                    $this->cp_participants_model->change_details($this->session->userdata('user_id'), 'phone', $this->input->post('phone'));

                    $this->session->set_userdata('user_participations', $this->accounts_model->get_account_participation($this->session->user_id));

                    // Do the file uploading if found
                    if (!empty($_FILES))
                    {
                        $config['upload_path']          = 'uploads/cp/' . $this->session->user_id;
                        $config['allowed_types']        = 'jpg';
                        $config['max_size']             = 5000;
                        $config['overwrite']            = TRUE;

                        $this->load->library('upload', $config);

                        $link = "uploads/cp/" . $this->session->user_id;

                        if (!file_exists ($link))
                        {
                            if(!mkdir($link, 0777, TRUE))
                            {
                                $this->session->set_flashdata('make_failed', 'Error Membuat Folder');
                            }
                        }

                        $error = array();

                        if(is_uploaded_file($_FILES['identity_link']['tmp_name']))
                        {
                            $config['file_name']            = 'identity_link';
                            $this->upload->initialize($config);

                            if (!$this->upload->do_upload('identity_link'))
                            {
                                array_push($error, $config['file_name']  . ' : '  . $this->upload->display_errors());
                            }
                            else
                            {
                                $this->cp_participants_model->change_details($this->session->userdata('user_id'), 'identity_link', $link . '/identity_link' . '.jpg');
                            }
                        }

                        $this->session->set_flashdata('upload_failed', $error);
                    }

                    // Redirect to the dashboard
                    redirect('akun/dashboard/cp');
                }

                // Else, show the form
                else
                {
                    $this->load->view('accounts/form_cp.php', $data);
                } 
        }else
        {
            $this->form_validation->set_rules(  
                    'institution_name', 'Nama Institusi Pendidikan', 
                    'required', 
                    array(
                        'required'      => 'Form ini harus diisi!',
                    )
                );
                $this->form_validation->set_rules(  
                    'fullname', 'Nama Lengkap', 
                    'required', 
                    array(
                        'required'      => 'Form ini harus diisi!',
                    )
                );
                $this->form_validation->set_rules(  
                    'id_number', 'Nomor Identitas (KTP/Kartu Pelajar)', 
                    'required', 
                    array(
                        'required'      => 'Form ini harus diisi!',
                    )
                );
                $this->form_validation->set_rules(  
                    'province_id', 'Asal Provinsi', 
                    'required', 
                    array(
                        'required'      => 'Form ini harus diisi!',
                    )
                );
                $this->form_validation->set_rules(  
                    'address', 'Alamat Lengkap', 
                    'required', 
                    array(
                        'required'      => 'Form ini harus diisi!',
                    )
                );
                $this->form_validation->set_rules(  
                    'phone', 'No Telpon', 
                    'required', 
                    array(
                        'required'      => 'Form ini harus diisi!',
                    )
                );
                $this->form_validation->set_rules(  
                    'email', 'E-Mail', 
                    'required', 
                    array(
                        'required'      => 'Form ini harus diisi!',
                    )
                );
                
                $data['mode']                       = '';
                $data['user_institution_name']      = '';
                $data['user_fullname']              = '';
                $data['user_id_number']             = '';
                $data['user_identity_link']         = '';
                $data['user_province_id']           = '';
                $data['address']                    = '';
                $data['email']                      = '';
                $data['phone']                      = '';

                // If the form is validated
                if ($this->form_validation->run() === TRUE)
                {
                    // Register the user to the DB
                    $this->cp_participants_model->register_participant(
                        $this->session->userdata('user_id'),
                        $this->input->post('fullname'),
                        $this->input->post('id_number'),
                        $this->input->post('institution_name'),
                        $this->input->post('province_id'),
                        $this->input->post('address'),
                        $this->input->post('phone'),
                        $this->input->post('email')
                    );

                    $this->session->set_userdata('user_participations', $this->accounts_model->get_account_participation($this->session->user_id));

                    // Do the file uploading if found
                    if (!empty($_FILES))
                    {
                        $config['upload_path']          = 'uploads/cp/' . $this->session->user_id;
                        $config['allowed_types']        = 'jpg';
                        $config['max_size']             = 5000;
                        $config['overwrite']            = TRUE;

                        $this->load->library('upload', $config);

                        $link = "uploads/cp/" . $this->session->user_id;

                        if (!file_exists ($link))
                        {
                            if(!mkdir($link, 0777, TRUE))
                            {
                                $this->session->set_flashdata('make_failed', 'Error Membuat Folder');
                            }
                        }

                        $error = array();

                        if(is_uploaded_file($_FILES['identity_link']['tmp_name']))
                        {
                            $config['file_name']            = 'identity_link';
                            $this->upload->initialize($config);

                            if (!$this->upload->do_upload('identity_link'))
                            {
                                array_push($error, $config['file_name']  . ' : '  . $this->upload->display_errors());
                            }
                            else
                            {
                                $this->cp_participants_model->change_details($this->session->userdata('user_id'), 'identity_link', $link . '/identity_link' . '.jpg');
                            }
                        }

                        $this->session->set_flashdata('upload_failed', $error);
                    }

                    // Redirect to the dashboard
                    redirect('akun/dashboard/cp');
                }

                // Else, show the form
                else
                {
                    $this->load->view('accounts/form_cp.php', $data);
                }

        }

        $this->load->view('templates/footer.php');
    }
        
}