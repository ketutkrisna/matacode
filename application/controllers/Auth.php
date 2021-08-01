<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		if($this->session->userdata('level_user')){
			redirect('beranda');
		}
		// $this->load->library('form_validation');
		$data['title']='Login';
		// update visitor
		$oldvisitor=$this->db->get_where('visitor',['id_visitor' => 1])->row_array();
		$data['totalvisitor']=$oldvisitor['total_visitor'];
		$this->db->set('total_visitor', $oldvisitor['total_visitor']+1);
		$this->db->where('id_visitor', 1);
		$this->db->update('visitor');
		// kategori tipe
		$querykategori="SELECT kategori.*, count(kategori_posting) as totalkategori from kategori left join posting on posting.kategori_posting=kategori.id_kategori group by id_kategori order by urutan_kategori";
		$data['kategories']=$this->db->query($querykategori)->result_array();
		// form validation
		$this->form_validation->set_rules('username','Username','trim|required',['required'=>'Username harus diisi']);
		$this->form_validation->set_rules('password','Password','trim|required',['required'=>'Password harus diisi']);
		if ($this->form_validation->run() == FALSE){
			// view beranda
			$this->load->view('templates/header',$data);
			$this->load->view('auth/login',$data);
		}else{
			$this->_login();
		}
	}

	private function _login()
	{
		$data['title']='Login';
		$username=htmlspecialchars(strtolower($this->input->post('username',true)));
		$password=htmlspecialchars($this->input->post('password',true));
		// kategori tipe
		$querykategori="SELECT kategori.*, count(kategori_posting) as totalkategori from kategori left join posting on posting.kategori_posting=kategori.id_kategori group by id_kategori order by urutan_kategori";
		$data['kategories']=$this->db->query($querykategori)->result_array();

		$users=$this->db->get_where('users',['username_user'=>$username])->row_array();
		if($users){
			if($username != $users['username_user']){
				$this->session->set_flashdata('message','<div class="alert mt-3 alert-warning alert-dismissible fade show" role="alert">
				  Username <strong>SALAH</strong>!
				  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
				  </button>
				</div>');
				// view beranda
				$this->load->view('templates/header',$data);
				$this->load->view('auth/login',$data);
			}else{
				if(password_verify($password, $users['password_user'])){
					$data=[
						'id_user'=>$users['id_user'],
						'level_user'=>$users['level_user']
					];
					$this->session->set_userdata($data);
					redirect('beranda');
				}else{
					$this->session->set_flashdata('message','<div class="alert mt-3 alert-warning alert-dismissible fade show" role="alert">
					  Password <strong>SALAH</strong>!
					  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
					  </button>
					</div>');
					// view beranda
					$this->load->view('templates/header',$data);
					$this->load->view('auth/login',$data);
				}
			}
		}else{
			$this->session->set_flashdata('message','<div class="alert mt-3 alert-warning alert-dismissible fade show" role="alert">
			  Username <strong>SALAH</strong>!
			  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
			  </button>
			</div>');
			// view beranda
			$this->load->view('templates/header',$data);
			$this->load->view('auth/login',$data);
		}
	}

	public function logout()
	{
		$this->session->unset_userdata('id_user');
		$this->session->unset_userdata('level_user');
		redirect('beranda');
	}


}