<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();

		$this->load->library(array('form_validation','ion_auth','upload'));
		$this->load->helper(array('url','language'));
		$this->load->model('user_model');
		$this->load->model('branch_model');
		$this->load->model('warehouse_model');
		$this->load->model('user_model');
		$this->load->model('category_model');
		$this->load->model('subcategory_model');
		$this->load->model('brand_model');
		$this->load->model('product_model');
		$this->load->model('payment_method_model');
		$this->load->model('expense_category_model');
		$this->load->model('discount_model');
		$this->load->model('email_setup_model');
		$this->load->model('sms_setting_model');
		$this->load->model('user_fragment');
		
		
		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

		$this->lang->load('auth');

		
	}

	// redirect if needed, otherwise display the user list
	public function index()
	{
		if (!$this->ion_auth->logged_in())
		{
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		}
		/*elseif (!$this->ion_auth->is_admin()) // remove this elseif if you want to enable this for non-admins
		{
			// redirect them to the home page because they must be an administrator to view this
			return show_error('You must be an administrator to view this page.');
		}*/
		else
		{
			// set the flash data error message if there is one
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

			//list the users
			$this->data['users'] = $this->ion_auth->users()->result();
			foreach ($this->data['users'] as $k => $user)
			{
				$this->data['users'][$k]->groups = $this->ion_auth->get_users_groups($user->id)->result();
			}
			
			$this->_render_page('auth/index', $this->data);
		}
	}

	// log the user in
	public function login()
	{
		$this->data['title'] = $this->lang->line('login_heading');

		//validate form input
		$this->form_validation->set_rules('identity', str_replace(':', '', $this->lang->line('login_identity_label')), 'required');
		$this->form_validation->set_rules('password', str_replace(':', '', $this->lang->line('login_password_label')), 'required');

		if ($this->form_validation->run() == true)
		{
			// check to see if the user is logging in
			// check for "remember me"
			$remember = (bool) $this->input->post('remember');

			if ($this->ion_auth->login($this->input->post('identity'), $this->input->post('password'), $remember))
			{
				//if the login is successful
				//redirect them back to the home page
				$data 		= $this->ion_auth_model->set_data_in_session($this->input->post('identity'));
				$group_id 	= $this->user_model->get_single_user_record($data['user_id'])->group_id;
				
				// $permission = $this->user_model->get_permission_records_by_role($group_id);
				$permission = $this->user_model->get_permission_records_by_user($data['user_id']);

				// echo '<pre>';
				// echo 'group';
				// print_r($permission);
				// echo 'user';
				// print_r($permission1);
				
				$currency 	= $this->ion_auth_model->set_currency_in_session();
				
				$perm = array();
				foreach ($permission as $row) {
					array_push($perm, $row->name);
				}

				$perm_m = array();
				foreach ($permission as $row) {
					array_push($perm_m, $row->module);
				}


				$this->session->set_userdata($data);
				$this->session->set_userdata('permission',$perm);
				$this->session->set_userdata('permission_m',array_values(array_unique($perm_m)));
				$this->session->set_userdata($currency);



				// echo '<pre>';
				// print_r(array_values($this->session->userdata('permission')));
				// print_r($this->session->userdata('permission'));
				// exit;


				$this->session->set_flashdata('message', $this->ion_auth->messages());
				$data = $this->ion_auth_model->allReports();

				$this->load->view('dashboard',$data);
			}
			else
			{
				// if the login was un-successful
				// redirect them back to the login page
				$this->session->set_flashdata('message', $this->ion_auth->errors());
				redirect('auth/login', 'refresh'); // use redirects instead of loading views for compatibility with MY_Controller libraries
			}
		}
		else
		{
			// the user is not logging in so display the login page
			// set the flash data error message if there is one
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

			$this->data['identity'] = array('name' => 'identity',
				'id'    => 'identity',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('identity'),
			);
			$this->data['password'] = array('name' => 'password',
				'id'   => 'password',
				'type' => 'password',
			);

			$this->_render_page('auth/login', $this->data);
		}
	}

	// log the user out
	public function logout()
	{
		$this->data['title'] = "Logout";

		// log the user out
		$logout = $this->ion_auth->logout();

		// redirect them to the login page
		$this->session->set_flashdata('message', $this->ion_auth->messages());
		redirect('auth/login', 'refresh');
	}

	public function dashboard(){
		$data = $this->ion_auth_model->allReports();
		$this->load->view('dashboard',$data);
	}

	// change password
	public function change_password()
	{
		$this->form_validation->set_rules('old', $this->lang->line('change_password_validation_old_password_label'), 'required');
		$this->form_validation->set_rules('new', $this->lang->line('change_password_validation_new_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_confirm]');
		$this->form_validation->set_rules('new_confirm', $this->lang->line('change_password_validation_new_password_confirm_label'), 'required');

		if (!$this->ion_auth->logged_in())
		{
			redirect('auth/login', 'refresh');
		}

		$user = $this->ion_auth->user()->row();

		if ($this->form_validation->run() == false)
		{
			// display the form
			// set the flash data error message if there is one
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

			$this->data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');
			$this->data['old_password'] = array(
				'name' => 'old',
				'id'   => 'old',
				'type' => 'password',
			);
			$this->data['new_password'] = array(
				'name'    => 'new',
				'id'      => 'new',
				'type'    => 'password',
				'pattern' => '^.{'.$this->data['min_password_length'].'}.*$',
			);
			$this->data['new_password_confirm'] = array(
				'name'    => 'new_confirm',
				'id'      => 'new_confirm',
				'type'    => 'password',
				'pattern' => '^.{'.$this->data['min_password_length'].'}.*$',
			);
			$this->data['user_id'] = array(
				'name'  => 'user_id',
				'id'    => 'user_id',
				'type'  => 'hidden',
				'value' => $user->id,
			);

			// render
			$this->_render_page('auth/change_password', $this->data);
		}
		else
		{
			$identity = $this->session->userdata('identity');

			$change = $this->ion_auth->change_password($identity, $this->input->post('old'), $this->input->post('new'));

			if ($change)
			{
				//if the password was successfully changed
				$this->session->set_flashdata('message', $this->ion_auth->messages());
				$this->logout();
			}
			else
			{
				$this->session->set_flashdata('message', $this->ion_auth->errors());
				redirect('auth/change_password', 'refresh');
			}
		}
	}

	// forgot password
	public function forgot_password()
	{
		// setting validation rules by checking whether identity is username or email
		if($this->config->item('identity', 'ion_auth') != 'email' )
		{
		   $this->form_validation->set_rules('identity', $this->lang->line('forgot_password_identity_label'), 'required');
		}
		else
		{
		   $this->form_validation->set_rules('identity', $this->lang->line('forgot_password_validation_email_label'), 'required|valid_email');
		}


		if ($this->form_validation->run() == false)
		{
			$this->data['type'] = $this->config->item('identity','ion_auth');
			// setup the input
			$this->data['identity'] = array('name' => 'identity',
				'id' => 'identity',
			);

			if ( $this->config->item('identity', 'ion_auth') != 'email' ){
				$this->data['identity_label'] = $this->lang->line('forgot_password_identity_label');
			}
			else
			{
				$this->data['identity_label'] = $this->lang->line('forgot_password_email_identity_label');
			}

			// set any errors and display the form
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
			$this->_render_page('auth/forgot_password', $this->data);
		}
		else
		{
			$identity_column = $this->config->item('identity','ion_auth');
			$identity = $this->ion_auth->where($identity_column, $this->input->post('identity'))->users()->row();

			if(empty($identity)) {

	            		if($this->config->item('identity', 'ion_auth') != 'email')
		            	{
		            		$this->ion_auth->set_error('forgot_password_identity_not_found');
		            	}
		            	else
		            	{
		            	   $this->ion_auth->set_error('forgot_password_email_not_found');
		            	}

		                $this->session->set_flashdata('message', $this->ion_auth->errors());
                		redirect("auth/forgot_password", 'refresh');
            		}

			// run the forgotten password method to email an activation code to the user
			$forgotten = $this->ion_auth->forgotten_password($identity->{$this->config->item('identity', 'ion_auth')});

			if ($forgotten)
			{
				// if there were no errors
				$this->session->set_flashdata('message', $this->ion_auth->messages());
				redirect("auth/login", 'refresh'); //we should display a confirmation page here instead of the login page
			}
			else
			{
				$this->session->set_flashdata('message', $this->ion_auth->errors());
				redirect("auth/forgot_password", 'refresh');
			}
		}
	}

	// reset password - final step for forgotten password
	public function reset_password($code = NULL)
	{
		if (!$code)
		{
			show_404();
		}

		$user = $this->ion_auth->forgotten_password_check($code);

		if ($user)
		{
			// if the code is valid then display the password reset form

			$this->form_validation->set_rules('new', $this->lang->line('reset_password_validation_new_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_confirm]');
			$this->form_validation->set_rules('new_confirm', $this->lang->line('reset_password_validation_new_password_confirm_label'), 'required');

			if ($this->form_validation->run() == false)
			{
				// display the form

				// set the flash data error message if there is one
				$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

				$this->data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');
				$this->data['new_password'] = array(
					'name' => 'new',
					'id'   => 'new',
					'type' => 'password',
					'pattern' => '^.{'.$this->data['min_password_length'].'}.*$',
				);
				$this->data['new_password_confirm'] = array(
					'name'    => 'new_confirm',
					'id'      => 'new_confirm',
					'type'    => 'password',
					'pattern' => '^.{'.$this->data['min_password_length'].'}.*$',
				);
				$this->data['user_id'] = array(
					'name'  => 'user_id',
					'id'    => 'user_id',
					'type'  => 'hidden',
					'value' => $user->id,
				);
				$this->data['csrf'] = $this->_get_csrf_nonce();
				$this->data['code'] = $code;

				// render
				$this->_render_page('auth/reset_password', $this->data);
			}
			else
			{
				// do we have a valid request?
				if ($this->_valid_csrf_nonce() === FALSE || $user->id != $this->input->post('user_id'))
				{

					// something fishy might be up
					$this->ion_auth->clear_forgotten_password_code($code);

					show_error($this->lang->line('error_csrf'));

				}
				else
				{
					// finally change the password
					$identity = $user->{$this->config->item('identity', 'ion_auth')};

					$change = $this->ion_auth->reset_password($identity, $this->input->post('new'));

					if ($change)
					{
						// if the password was successfully changed
						$this->session->set_flashdata('message', $this->ion_auth->messages());
						redirect("auth/login", 'refresh');
					}
					else
					{
						$this->session->set_flashdata('message', $this->ion_auth->errors());
						redirect('auth/reset_password/' . $code, 'refresh');
					}
				}
			}
		}
		else
		{
			// if the code is invalid then send them back to the forgot password page
			$this->session->set_flashdata('message', $this->ion_auth->errors());
			redirect("auth/forgot_password", 'refresh');
		}
	}


	// activate the user
	public function activate($id, $code=false)
	{
		if ($code !== false)
		{
			$activation = $this->ion_auth->activate($id, $code);
		}
		else if ($this->ion_auth->is_admin())
		{
			$activation = $this->ion_auth->activate($id);
		}

		if ($activation)
		{
			// redirect them to the auth page
			$this->session->set_flashdata('message', $this->ion_auth->messages());
			redirect("auth", 'refresh');
		}
		else
		{
			// redirect them to the forgot password page
			$this->session->set_flashdata('message', $this->ion_auth->errors());
			redirect("auth/forgot_password", 'refresh');
		}
	}

	// deactivate the user
	public function deactivate($id = NULL)
	{
		if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
		{
			// redirect them to the home page because they must be an administrator to view this
			return show_error('You must be an administrator to view this page.');
		}

		$id = (int) $id;

		$this->load->library('form_validation');
		$this->form_validation->set_rules('confirm', $this->lang->line('deactivate_validation_confirm_label'), 'required');
		$this->form_validation->set_rules('id', $this->lang->line('deactivate_validation_user_id_label'), 'required|alpha_numeric');

		if ($this->form_validation->run() == FALSE)
		{
			// insert csrf check
			$this->data['csrf'] = $this->_get_csrf_nonce();
			$this->data['user'] = $this->ion_auth->user($id)->row();

			$this->_render_page('auth/deactivate_user', $this->data);
		}
		else
		{
			// do we really want to deactivate?
			if ($this->input->post('confirm') == 'yes')
			{
				// do we have a valid request?
				if ($this->_valid_csrf_nonce() === FALSE || $id != $this->input->post('id'))
				{
					show_error($this->lang->line('error_csrf'));
				}

				// do we have the right userlevel?
				if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin())
				{
					$this->ion_auth->deactivate($id);
				}
			}

			// redirect them back to the auth page
			redirect('auth', 'refresh');
		}
	}

	// create a new user
	public function create_user()
    {

        $this->data['title'] = $this->lang->line('create_user_heading');

        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
        {
            redirect('auth', 'refresh');
        }

        $tables = $this->config->item('tables','ion_auth');
        $identity_column = $this->config->item('identity','ion_auth');
        $groups=$this->ion_auth->groups()->result_array();

        $this->data['identity_column'] = $identity_column;

        // validate form input
        $this->form_validation->set_rules('first_name', $this->lang->line('create_user_validation_fname_label'), 'required');
        $this->form_validation->set_rules('last_name', $this->lang->line('create_user_validation_lname_label'), 'required');
        if($identity_column!=='email')
        {
            $this->form_validation->set_rules('identity',$this->lang->line('create_user_validation_identity_label'),'required|is_unique['.$tables['users'].'.'.$identity_column.']');
            $this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'required|valid_email');
        }
        else
        {
            $this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'required|valid_email|is_unique[' . $tables['users'] . '.email]');
        }
        $this->form_validation->set_rules('phone', $this->lang->line('create_user_validation_phone_label'), 'trim');
        $this->form_validation->set_rules('company', $this->lang->line('create_user_validation_company_label'), 'trim');
        $this->form_validation->set_rules('password', $this->lang->line('create_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
        $this->form_validation->set_rules('password_confirm', $this->lang->line('create_user_validation_password_confirm_label'), 'required');

        if ($this->form_validation->run() == true)
        {
            $email    	= strtolower($this->input->post('email'));
            $identity 	= ($identity_column==='email') ? $email : $this->input->post('identity');
            $password 	= $this->input->post('password');
            $groupData 	= $this->input->post('groups');

            $additional_data = array(
                'first_name' => $this->input->post('first_name'),
                'last_name'  => $this->input->post('last_name'),
                'company'    => $this->input->post('company'),
                'phone'      => $this->input->post('phone'),
                'api_key'    => md5(uniqid(rand(), true))
            );
        }
        if ($this->form_validation->run() == true && $this->ion_auth->register($identity, $password, $email, $additional_data,$groupData))
        {
            // check to see if we are creating the user
            // redirect them back to the admin page
            $this->session->set_flashdata('message', $this->ion_auth->messages());
            // redirect('biller', 'refresh');
            redirect("auth/dashboard", 'refresh');
        }
        else
        {
            // display the create user form
            // set the flash data error message if there is one
            $this->data['groups'] = $groups;
            $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

            $this->data['first_name'] = array(
                'name'  => 'first_name',
                'id'    => 'first_name',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('first_name'),
            );
            $this->data['last_name'] = array(
                'name'  => 'last_name',
                'id'    => 'last_name',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('last_name'),
            );
            $this->data['identity'] = array(
                'name'  => 'identity',
                'id'    => 'identity',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('identity'),
            );
            $this->data['email'] = array(
                'name'  => 'email',
                'id'    => 'email',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('email'),
            );
            $this->data['company'] = array(
                'name'  => 'company',
                'id'    => 'company',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('company'),
            );
            $this->data['phone'] = array(
                'name'  => 'phone',
                'id'    => 'phone',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('phone'),
            );
            $this->data['password'] = array(
                'name'  => 'password',
                'id'    => 'password',
                'type'  => 'password',
                'value' => $this->form_validation->set_value('password'),
            );
            $this->data['password_confirm'] = array(
                'name'  => 'password_confirm',
                'id'    => 'password_confirm',
                'type'  => 'password',
                'value' => $this->form_validation->set_value('password_confirm'),
            );

            $this->data['image1'] = array(
                'name'  => 'images',
                'id'    => 'images',
                'type'  => 'file',
                'value' => $this->form_validation->set_value('images'),
            );

            
            $this->_render_page('auth/create_user', $this->data);
        }
    }


    private function do_upload($image){
		if(!empty($image)){
		
			$type = explode('.',$_FILES["images"]["name"]);
			$type = $type[count($type)-1];
			$name = uniqid(rand()).'.'.$type;
			$url = './assets/images/'.$name;//uniqid(rand()).'.'.$type;

			if(in_array($type,array("jpg","jpeg","gif","png"))){
				
				if(is_uploaded_file($_FILES["images"]["tmp_name"])){
					
					if(move_uploaded_file($_FILES["images"]["tmp_name"],$url)){

						return $name;
					}
				}	
			}
			return  "";		
		}
	}

	// edit a user
	public function edit_user($id)
	{		
		$this->data['title'] = $this->lang->line('edit_user_heading');

		if (!$this->ion_auth->logged_in() || (!$this->ion_auth->is_admin() && !($this->ion_auth->user()->row()->id == $id)))
		{
			redirect('auth', 'refresh');
		}

		$user = $this->ion_auth->user($id)->row();
		$groups=$this->ion_auth->groups()->result_array();
		$currentGroups = $this->ion_auth->get_users_groups($id)->result();

		// validate form input
		$this->form_validation->set_rules('first_name', $this->lang->line('edit_user_validation_fname_label'), 'required');
		$this->form_validation->set_rules('last_name', $this->lang->line('edit_user_validation_lname_label'), 'required');
		$this->form_validation->set_rules('phone', $this->lang->line('edit_user_validation_phone_label'), 'required');
		$this->form_validation->set_rules('company', $this->lang->line('edit_user_validation_company_label'), 'required');
		$this->form_validation->set_rules('email', $this->lang->line('edit_user_validation_email_label'), 'required');

		if (isset($_POST) && !empty($_POST))
		{
			// do we have a valid request?
			/*if ($this->_valid_csrf_nonce() === FALSE || $id != $this->input->post('id'))
			{
				show_error($this->lang->line('error_csrf'));
			}*/

			// update the password if it was posted
			if ($this->input->post('password'))
			{
				$this->form_validation->set_rules('password', $this->lang->line('edit_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
				$this->form_validation->set_rules('password_confirm', $this->lang->line('edit_user_validation_password_confirm_label'), 'required');
			}

			if ($this->form_validation->run() === TRUE)
			{
				$data = array(
					'first_name' => $this->input->post('first_name'),
					'last_name'  => $this->input->post('last_name'),
					'company'    => $this->input->post('company'),
					'phone'      => $this->input->post('phone'),
					'email'		 =>$this->input->post('email'),
				);

				// update the password if it was posted
				if ($this->input->post('password'))
				{
					$data['password'] = $this->input->post('password');
				}

				// Only allow updating groups if user is admin
				if ($this->ion_auth->is_admin())
				{
					//Update the groups user belongs to
					$groupData = $this->input->post('groups');

					if (isset($groupData) && !empty($groupData)) {

						$this->ion_auth->remove_from_group('', $id);

						foreach ($groupData as $grp) {
							$this->ion_auth->add_to_group($grp, $id);
						}

					}
				}

			// check to see if we are updating the user
			   if($this->ion_auth->update($user->id, $data))
			    {
			    	// redirect them back to the admin page if admin, or to the base url if non admin
				    $this->session->set_flashdata('message', $this->ion_auth->messages() );
				    if ($this->ion_auth->is_admin())
					{
						redirect('auth', 'refresh');
					}
					else
					{
						redirect('/', 'refresh');
					}

			    }
			    else
			    {
			    	// redirect them back to the admin page if admin, or to the base url if non admin
				    $this->session->set_flashdata('message', $this->ion_auth->errors() );
				    if ($this->ion_auth->is_admin())
					{
						redirect('auth', 'refresh');
					}
					else
					{
						redirect('/', 'refresh');
					}

			    }

			}
		}

		// display the edit user form
		$this->data['csrf'] = $this->_get_csrf_nonce();

		// set the flash data error message if there is one
		$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

		// pass the user to the view
		$this->data['user'] = $user;
		$this->data['groups'] = $groups;
		$this->data['currentGroups'] = $currentGroups;

		$this->data['first_name'] = array(
			'name'  => 'first_name',
			'id'    => 'first_name',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('first_name', $user->first_name),
		);
		$this->data['last_name'] = array(
			'name'  => 'last_name',
			'id'    => 'last_name',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('last_name', $user->last_name),
		);
		$this->data['company'] = array(
			'name'  => 'company',
			'id'    => 'company',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('company', $user->company),
		);
		$this->data['phone'] = array(
			'name'  => 'phone',
			'id'    => 'phone',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('phone', $user->phone),
		);

		$this->data['email'] = array(
			'name'  => 'email',
			'id'    => 'email',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('email', $user->email),
		);

		$this->data['password'] = array(
			'name' => 'password',
			'id'   => 'password',
			'type' => 'password'
		);
		$this->data['password_confirm'] = array(
			'name' => 'password_confirm',
			'id'   => 'password_confirm',
			'type' => 'password'
		);

		$this->_render_page('auth/edit_user', $this->data);
	}

	// create a new group
	public function create_group()
	{
		$this->data['title'] = $this->lang->line('create_group_title');

		if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
		{
			redirect('auth', 'refresh');
		}

		// validate form input
		$this->form_validation->set_rules('group_name', $this->lang->line('create_group_validation_name_label'), 'required|alpha_dash');

		if ($this->form_validation->run() == TRUE)
		{
			$new_group_id = $this->ion_auth->create_group($this->input->post('group_name'), $this->input->post('description'));
			if($new_group_id)
			{
				// check to see if we are creating the group
				// redirect them back to the admin page
				$this->session->set_flashdata('message', $this->ion_auth->messages());
				redirect("auth", 'refresh');
			}
		}
		else
		{
			// display the create group form
			// set the flash data error message if there is one
			$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

			$this->data['group_name'] = array(
				'name'  => 'group_name',
				'id'    => 'group_name',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('group_name'),
			);
			$this->data['description'] = array(
				'name'  => 'description',
				'id'    => 'description',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('description'),
			);

			$this->_render_page('auth/create_group', $this->data);
		}
	}

	// edit a group
	public function edit_group($id)
	{
		// bail if no group id given
		if(!$id || empty($id))
		{
			redirect('auth', 'refresh');
		}

		$this->data['title'] = $this->lang->line('edit_group_title');

		if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
		{
			redirect('auth', 'refresh');
		}

		$group = $this->ion_auth->group($id)->row();

		// validate form input
		$this->form_validation->set_rules('group_name', $this->lang->line('edit_group_validation_name_label'), 'required|alpha_dash');

		if (isset($_POST) && !empty($_POST))
		{
			if ($this->form_validation->run() === TRUE)
			{
				$group_update = $this->ion_auth->update_group($id, $_POST['group_name'], $_POST['group_description']);

				if($group_update)
				{
					$this->session->set_flashdata('message', $this->lang->line('edit_group_saved'));
				}
				else
				{
					$this->session->set_flashdata('message', $this->ion_auth->errors());
				}
				redirect("auth", 'refresh');
			}
		}

		// set the flash data error message if there is one
		$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

		// pass the user to the view
		$this->data['group'] = $group;

		$readonly = $this->config->item('admin_group', 'ion_auth') === $group->name ? 'readonly' : '';

		$this->data['group_name'] = array(
			'name'    => 'group_name',
			'id'      => 'group_name',
			'type'    => 'text',
			'value'   => $this->form_validation->set_value('group_name', $group->name),
			$readonly => $readonly,
		);
		$this->data['group_description'] = array(
			'name'  => 'group_description',
			'id'    => 'group_description',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('group_description', $group->description),
		);

		$this->_render_page('auth/edit_group', $this->data);
	}


	public function _get_csrf_nonce()
	{
		$this->load->helper('string');
		$key   = random_string('alnum', 8);
		$value = random_string('alnum', 20);
		$this->session->set_flashdata('csrfkey', $key);
		$this->session->set_flashdata('csrfvalue', $value);

		return array($key => $value);
	}

	public function _valid_csrf_nonce()
	{
		$csrfkey = $this->input->post($this->session->flashdata('csrfkey'));
		if ($csrfkey && $csrfkey == $this->session->flashdata('csrfvalue'))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	public function _render_page($view, $data=null, $returnhtml=false)//I think this makes more sense
	{

		$this->viewdata = (empty($data)) ? $this->data: $data;

		$view_html = $this->load->view($view, $this->viewdata, $returnhtml);

		if ($returnhtml) return $view_html;//This will return html on 3rd argument being true
	}
	public function product_profit(){
		$this->load->model('sales_model');

		$data =  $this->db->select('s.*')
							->from('sales s')
							->where('s.delete_status',0)
							->get()->result();
							
		// $purchase = $this->db->get('purchases')->result();

		$purchase =  $this->db->select('p.*')
							->from('purchases p')
							->where('p.delete_status',0)
							->get()->result();
							
		$jan = $feb = $mar = $apr = $may = $jun = $jul = $aug = $sep = $oct = $nov = $dec =  0;
		$jan1 = array("month"=>"Jan","sales"=>0,"purchase"=>0);
		$feb1 = array("month"=>"Feb","sales"=>0,"purchase"=>0);
		$mar1 = array("month"=>"Mar","sales"=>0,"purchase"=>0);
		$apr1 = array("month"=>"Apr","sales"=>0,"purchase"=>0);
		$may1 = array("month"=>"May","sales"=>0,"purchase"=>0);
		$jun1 = array("month"=>"Jun","sales"=>0,"purchase"=>0);
		$jul1 = array("month"=>"Jul","sales"=>0,"purchase"=>0);
		$aug1 = array("month"=>"Aug","sales"=>0,"purchase"=>0);
		$sep1 = array("month"=>"Sep","sales"=>0,"purchase"=>0);
		$oct1 = array("month"=>"Oct","sales"=>0,"purchase"=>0);
		$nov1 = array("month"=>"Nov","sales"=>0,"purchase"=>0);
		$dec1 = array("month"=>"Dec","sales"=>0,"purchase"=>0);
		foreach ($data as $value) {
			$date = date_parse_from_format("Y-m-d", $value->date);
			if($date["month"]==1){ $jan = $jan + $value->total; $jan1["sales"] = $jan;}
			else if($date["month"]==2){$feb = $feb + $value->total; $feb1["sales"] = $feb;}
			else if($date["month"]==3){$mar = $mar + $value->total; $mar1["sales"] = $mar;}
			else if($date["month"]==4){$apr = $apr + $value->total; $apr1["sales"] = $apr;}
			else if($date["month"]==5){$may = $may + $value->total; $may1["sales"] = $may;}
			else if($date["month"]==6){$jun = $jun + $value->total; $jun1["sales"] = $jun;}
			else if($date["month"]==7){$jul = $jul + $value->total; $jul1["sales"] = $jul;}
			else if($date["month"]==8){$aug = $aug + $value->total; $aug1["sales"] = $aug;}
			else if($date["month"]==9){$sep = $sep + $value->total; $sep1["sales"] = $sep;}
			else if($date["month"]==10){$oct = $oct + $value->total; $oct1["sales"] = $oct;}
			else if($date["month"]==11){$nov = $nov + $value->total; $nov1["sales"] = $nov;}
			else if($date["month"]==12){$dec = $dec + $value->total; $dec1["sales"] = $dec;}
		}	
		$jan = $feb = $mar = $apr = $may = $jun = $jul = $aug = $sep = $oct = $nov = $dec =  0;
		foreach ($purchase as $value) {
			$date = date_parse_from_format("Y-m-d", $value->date);
			if($date["month"]==1){ $jan = $jan + $value->total; $jan1["purchase"] = $jan;}
			else if($date["month"]==2){$feb = $feb + $value->total; $feb1["purchase"] = $feb;}
			else if($date["month"]==3){$mar = $mar + $value->total; $mar1["purchase"] = $mar;}
			else if($date["month"]==4){$apr = $apr + $value->total; $apr1["purchase"] = $apr;}
			else if($date["month"]==5){$may = $may + $value->total; $may1["purchase"] = $may;}
			else if($date["month"]==6){$jun = $jun + $value->total; $jun1["purchase"] = $jun;}
			else if($date["month"]==7){$jul = $jul + $value->total; $jul1["purchase"] = $jul;}
			else if($date["month"]==8){$aug = $aug + $value->total; $aug1["purchase"] = $aug;}
			else if($date["month"]==9){$sep = $sep + $value->total; $sep1["purchase"] = $sep;}
			else if($date["month"]==10){$oct = $oct + $value->total; $oct1["purchase"] = $oct;}
			else if($date["month"]==11){$nov = $nov + $value->total; $nov1["purchase"] = $nov;}
			else if($date["month"]==12){$dec = $dec + $value->total; $dec1["purchase"] = $dec;}
		}
		$salesData = array();
		array_push($salesData, $jan1);
		array_push($salesData, $feb1);
		array_push($salesData, $mar1);
		array_push($salesData, $apr1);
		array_push($salesData, $may1);
		array_push($salesData, $jun1);
		array_push($salesData, $jul1);
		array_push($salesData, $aug1);
		array_push($salesData, $sep1);
		array_push($salesData, $oct1);
		array_push($salesData, $nov1);
		array_push($salesData, $dec1);
		echo json_encode($salesData, true);
	}
	public function getWarehouseData($id){
		$data = $this->ion_auth_model->getWarehouseData($id);
		echo json_encode($data);
	}
	public function clearDemoData(){
		$this->ion_auth_model->clearDemoData();
		$this->dashboard();	}

	public function signup()
	{
		$data = null;

		if ($this->input->post('submit') == 'submit') {

			$data['salesperson_code'] = $_POST['salesperson_code'];
			$data['salesperson_agency_code'] = $_POST['salesperson_agency_code'];

			$this->form_validation->set_rules('first_name','first name','required');
			$this->form_validation->set_rules('last_name','last name','required');
			$this->form_validation->set_rules('mobile', 'mobile', 'trim|required|numeric');
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]',array('is_unique' => 'The %s is already taken'));
			$this->form_validation->set_rules('bank_account_number','Bank Account Name','required');
			$this->form_validation->set_rules('bank_account_name','Bank Account Number','required');

			$this->form_validation->set_rules('salesperson_name','Salesperson Name','required');
			$this->form_validation->set_rules('salesperson_code','Salesperson Name','required');
			$this->form_validation->set_rules('salesperson_agency_name','Salesperson Agency Name','required');
			$this->form_validation->set_rules('salesperson_agency_code','Salesperson Agency Code','required');
			
			$this->form_validation->set_rules('password', 'password', 'required');
			$this->form_validation->set_rules('password_confirmation', 'password Confirmation','required|matches[password]');

			$config['upload_path'] = APPPATH.'public';
		    $this->load->library('upload',$config);


			$bank_statement_path = null;
			$ssm_path = null;
			$ic_path = null;

			$bank_statement_file = $_FILES['bank_statement'];
			$ssm_file = $_FILES['ssm'];
			$ic_file = $_FILES['ic'];

			if ($bank_statement_file['tmp_name'] != null) {
				$bank_upload_status = $this->upload->do_upload('bank_statement');
				$bank_statement_path = $this->upload->data()['full_path'];
			} else {
			   $this->form_validation->set_rules('bank_statement','Bank Statement','required');
			}

			if ($ssm_file['tmp_name'] != null) {
				$ssm_upload_status = $this->upload->do_upload('ssm');
				$ssm_path = $this->upload->data()['full_path'];
			} else {
			   $this->form_validation->set_rules('ssm','SSM','required');
			}

			if ($ic_file['tmp_name'] != null) {
				$ic_upload_status = $this->upload->do_upload('ic');
				$ic_path = $this->upload->data()['full_path'];
			} else {
			   $this->form_validation->set_rules('ic','Identity Card','required');
			}

			if ($this->form_validation->run() == true && ($bank_upload_status && $ssm_upload_status && $ic_upload_status)) {
				$user_fragment_data = array(
					'bank_statement' => $bank_statement_path,
					'bank_account_name' => $this->input->post('bank_account_name'),
					'salesperson_code' => $this->input->post('salesperson_code'),
					'salesperson_agency_code' => $this->input->post('salesperson_agency_code'),
					'salesperson_name' => $this->input->post('salesperson_name'),
					'salesperson_agency_name' => $this->input->post('salesperson_agency_name'),
					'ssm' => $ssm_path,
					'ic' => $ic_path,
				);
	
				$user_data = array(
					'username' => $this->input->post('first_name') . $this->input->post('last_name'),
					'password' => $this->input->post('password'),
					'api_key' => md5(uniqid(rand(), true)),
					'email' => $this->input->post('email'),
					'created_on' => now(),
					'first_name' => $this->input->post('first_name'),
					'last_name' => $this->input->post('last_name'),
					'phone' => $this->input->post('mobile'),
					'birth_date' => now(),
					'active' => TRUE
				);
	
				$identity = $this->input->post('email');
				$email = $this->input->post('email');
				$password = $this->input->post('password');
				$additional_data = $user_data;
				$groupData = array();
				$customer_group = $this->db->get_where('groups',array('name' => 'customer'))->row();
	
				array_push(
					$groupData,
					$customer_group->id
				);
	
				if($this->ion_auth->register($identity, $password, $email, $additional_data, $groupData)) {
					$this->user_fragment->add_record($user_fragment_data);
					$data['return_status'] = true;
				}
			}

		} else {
			$data['salesperson_code'] = $_GET['agent_code'];
			$data['salesperson_agency_code'] = $_GET['agency_code'];
		}

		$this->load->view('signup',$data);
	}
	
}
