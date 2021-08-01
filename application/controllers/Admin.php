<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata('level_user')){
			redirect('beranda');
		}
	}

	public function index()
	{
		// data form post
		$urlpost=strtolower($this->input->post('urlpost',true));
		$judulpost=$this->input->post('judulpost',true);
		$isipost=$this->input->post('isipost',true);
		$tanggalpost=time();
		$kategoripost=$this->input->post('kategoripost',true);
		// data inserting
		$data = array(
        'id_posting' => null,
        'url_posting' => $urlpost,
        'judul_posting' => $judulpost,
        'isi_posting' => $isipost,
        'tanggal_posting' => $tanggalpost,
        'kategori_posting' => $kategoripost,
        'visitor_posting' => 0
		);
		// konfirm inserting
		$this->db->insert('posting', $data);
		$this->session->set_flashdata('message','<div class="alert mt-3 alert-warning alert-dismissible fade show" role="alert">
			  Post <strong>berhasil</strong> ditambah!
			  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
			  </button>
			</div>');
		redirect('beranda');
		return false;
	}

	public function ajaxpost()
	{
		$idupdate=htmlspecialchars($this->input->post('idupdate',true));
		$querypost="SELECT * from posting left join kategori on posting.kategori_posting=kategori.id_kategori where id_posting=$idupdate";
		$detail=$this->db->query($querypost)->row_array();
		echo json_encode($detail);
		return false;
	}

	public function updatepost()
	{
		$idpostu=$this->input->post('idpostu',true);
		$judulpostu=$this->input->post('judulpostu',true);
		$urlpostu=strtolower($this->input->post('urlpostu',true));
		$kategoripostu=$this->input->post('kategoripostu',true);
		$isipostu=$this->input->post('isipostu',true);

		$this->db->set('judul_posting', $judulpostu);
		$this->db->set('url_posting', $urlpostu);
		$this->db->set('kategori_posting', $kategoripostu);
		$this->db->set('isi_posting', $isipostu);
		$this->db->where('id_posting', $idpostu);
		$this->db->update('posting');

		$this->session->set_flashdata('message','<div class="alert mt-3 alert-warning alert-dismissible fade show" role="alert">
			  Post <strong>berhasil</strong> diupdate!
			  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
			  </button>
			</div>');
		redirect('beranda');
		return false;
	}

	public function hapuspost($idpost)
	{
		$this->db->delete('posting', ['id_posting' => $idpost]);
		$this->db->delete('komentar', ['id_post' => $idpost]);
		$this->session->set_flashdata('message','<div class="alert mt-3 alert-warning alert-dismissible fade show" role="alert">
			  Post <strong>berhasil</strong> dihapus!
			  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
			  </button>
			</div>');
		redirect('beranda');
		return false;
	}

	public function addkategori()
	{
		$namakategori=$this->input->post('namakategori',true);
		$urlkategori=strtolower($this->input->post('urlkategori',true));
		$urutankategori=$this->input->post('urutankategori',true);

		if($_FILES['imgkategori']['name']){
			if($_FILES['imgkategori']['name']==''){
				$fotobg=$cekfoto['img_kategori'];
			}else{
				$configl['upload_path']          = './assets/img/img-kategori/';
	            $configl['allowed_types']        = 'jpg|png|gif';
	            $configl['max_size']             = 2048;

	            $this->load->library('upload', $configl);

	            if($this->upload->do_upload('imgkategori')){
	            	$fotol=$this->upload->data('file_name');
	            }else{
	            	$errorl = $this->upload->display_errors('','');
	            	if($errorl=='The filetype you are attempting to upload is not allowed.'){
	            		$errorsl=['error'=>'Format file harus JPG,PNG'];
	            		$this->session->set_flashdata('message','<div class="alert mt-3 alert-warning alert-dismissible fade show" role="alert">
							  Format file harus <strong>JPG|PNG|GIF</strong>!
							  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
							  </button>
							</div>');
						redirect('beranda');
						return false;
	            	}else{
	            		$errorsl=['error'=>'Max gambar 2MB'];
	            		$this->session->set_flashdata('message','<div class="alert mt-3 alert-warning alert-dismissible fade show" role="alert">
							  Size img terlalu besar <strong>MAX 2MB</strong>!
							  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
							  </button>
							</div>');
						redirect('beranda');
						return false;
	            	}
	            }
			}
			
			// update to kategori
			$data = array(
	        'id_kategori' => null,
	        'url_kategori' => $urlkategori,
	        'nama_kategori' => $namakategori,
	        'img_kategori' => $fotol,
	        'urutan_kategori' => $urutankategori
			);
			// konfirm inserting
			$this->db->insert('kategori', $data);
			$this->session->set_flashdata('message','<div class="alert mt-3 alert-warning alert-dismissible fade show" role="alert">
				  kategori <strong>berhasil</strong> ditambah!
				  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
				  </button>
				</div>');
			redirect('beranda');
			return false;

		}
	}

	public function ajaxkategori()
	{
		$idkategori=htmlspecialchars($this->input->post('idkategori',true));
		$querykategori="SELECT * from kategori where id_kategori=$idkategori";
		$detail=$this->db->query($querykategori)->row_array();
		echo json_encode($detail);
		return false;
	}

	public function updatekategori()
	{
		$idkategoriu=htmlspecialchars($this->input->post('idkategoriu',true));
		$namakategoriu=$this->input->post('namakategoriu',true);
		$urlkategoriu=strtolower($this->input->post('urlkategoriu',true));
		$urutankategoriu=$this->input->post('urutankategoriu',true);
		$cekfoto=$this->db->get_where('kategori',['id_kategori'=>$idkategoriu])->row_array();

		if($_FILES['imgkategoriu']['name']){
			if($_FILES['imgkategoriu']['name']==''){
				$fotolama=$cekfoto['img_kategori'];
			}else{
				$configl['upload_path']          = './assets/img/img-kategori/';
	            $configl['allowed_types']        = 'jpg|png|gif';
	            $configl['max_size']             = 2048;

	            $this->load->library('upload', $configl);

	            if($this->upload->do_upload('imgkategoriu')){
		            unlink(FCPATH . '/assets/img/img-kategori/' .$cekfoto['img_kategori']);
	            	$fotol=$this->upload->data('file_name');
	            }else{
	            	$errorl = $this->upload->display_errors('','');
	            	if($errorl=='The filetype you are attempting to upload is not allowed.'){
	            		$errorsl=['error'=>'Format file harus JPG,PNG'];
	            		$this->session->set_flashdata('message','<div class="alert mt-3 alert-warning alert-dismissible fade show" role="alert">
							  Format file harus <strong>JPG|PNG|GIF</strong>!
							  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
							  </button>
							</div>');
						redirect('beranda');
						return false;
	            	}else{
	            		$errorsl=['error'=>'Max gambar 2MB'];
	            		$this->session->set_flashdata('message','<div class="alert mt-3 alert-warning alert-dismissible fade show" role="alert">
							  Size img terlalu besar <strong>MAX 2MB</strong>!
							  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
							  </button>
							</div>');
						redirect('beranda');
						return false;
	            	}
	            }
			}
			
			// update to mobils
			$this->db->set('url_kategori', $urlkategoriu);
			$this->db->set('nama_kategori', $namakategoriu);
			$this->db->set('img_kategori', $fotol);
			$this->db->set('urutan_kategori', $urutankategoriu);
			$this->db->where('id_kategori', $idkategoriu);
			$this->db->update('kategori');
			$this->session->set_flashdata('message','<div class="alert mt-3 alert-warning alert-dismissible fade show" role="alert">
				  kategori <strong>berhasil</strong> diupdate!
				  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
				  </button>
				</div>');
			redirect('beranda');
			return false;

		}else{
			$this->db->set('url_kategori', $urlkategoriu);
			$this->db->set('nama_kategori', $namakategoriu);
			$this->db->set('urutan_kategori', $urutankategoriu);
			$this->db->where('id_kategori', $idkategoriu);
			$this->db->update('kategori');
			$this->session->set_flashdata('message','<div class="alert mt-3 alert-warning alert-dismissible fade show" role="alert">
				  kategori <strong>berhasil</strong> diupdate!
				  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
				  </button>
				</div>');
			redirect('beranda');
			return false;
		}
	}

	public function hapuskategori($idkategori)
	{
		$countkategori=$this->db->get_where('posting',['kategori_posting'=>$idkategori])->num_rows();
		$cekfoto=$this->db->get_where('kategori',['id_kategori'=>$idkategori])->row_array();
		if($countkategori==0){
			unlink(FCPATH . '/assets/img/img-kategori/' .$cekfoto['img_kategori']);
			$this->db->delete('kategori', ['id_kategori' => $idkategori]);
			$this->session->set_flashdata('message','<div class="alert mt-3 alert-warning alert-dismissible fade show" role="alert">
				  Kategori <strong>berhasil</strong> dihapus!
				  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
				  </button>
				</div>');
			redirect('beranda');
			return false;
		}else{
			$this->session->set_flashdata('message','<div class="alert mt-3 alert-warning alert-dismissible fade show" role="alert">
				  <strong>Gagal</strong> masih ada posting pada ketegori!
				  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
				  </button>
				</div>');
			redirect('beranda');
			return false;
		}
	}

	public function ubahpassword()
	{
		$data['title']='Ubah Password';
		$data['profil']=$this->db->get_where('users',['id_user'=>$this->session->userdata('id_user')])->row_array();
		$userid=$this->session->userdata('id_user');
		$passwordlama=htmlspecialchars($this->input->post('passwordlama',true));
		$matchpassword=$this->db->get_where('users',['id_user'=>$userid])->row_array();
		// kategori tipe
		$querykategori="SELECT kategori.*, count(kategori_posting) as totalkategori from kategori left join posting on posting.kategori_posting=kategori.id_kategori group by id_kategori order by urutan_kategori";
		$data['kategories']=$this->db->query($querykategori)->result_array();

		$this->form_validation->set_rules('passwordlama','passwordlama','trim|required',
			[
				'required'=>'Password harus diisi'
			]);
		$this->form_validation->set_rules('passwordbaru','Password','trim|required|min_length[5]|matches[passwordconfirm]',[
				'required'=>'Password harus diisi',
				'min_length'=>'Panjang password min 5 karakter',
				'matches'=>'Confirm password tidak sama'
			]);
		$this->form_validation->set_rules('passwordconfirm','confirmpassword','trim|required|matches[passwordbaru]',
			[
				'required'=>'Password harus diisi',
				'matches'=>'Confirm password tidak sama'
			]);

		if ($this->form_validation->run() == FALSE){
			$this->load->view('templates/header',$data);
			$this->load->view('admin/ubahpassword',$data);
		}else{
			if(password_verify($passwordlama, $matchpassword['password_user'])){
				$passb=htmlspecialchars($this->input->post('passwordbaru',true));
				$hashpassb=password_hash($passb, PASSWORD_DEFAULT);
				$this->db->set('password_user', $hashpassb);
				$this->db->where('id_user', $userid);
				$this->db->update('users');
				$this->session->set_flashdata('message','<div class="alert mt-3 alert-warning alert-dismissible fade show" role="alert">
					  Password <strong>BERHASIL</strong> diubah!
					  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
					  </button>
					</div>');
				redirect('admin/ubahpassword');
				return false;
			}else{
				$this->session->set_flashdata('message','<div class="alert mt-3 alert-warning alert-dismissible fade show" role="alert">
					  Password lama <strong>SALAH</strong>!
					  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
					  </button>
					</div>');
				redirect('admin/ubahpassword');
				return false;
			}
		}
	}

	public function hapuskomentar($idkomen,$idpost)
	{
		$backtopost=$this->db->get_where('posting',['id_posting'=>$idpost])->row_array();
		$this->db->delete('komentar', ['id_komentar' => $idkomen]);
		$this->session->set_flashdata('message','<div class="position-fixed top-0 end-0" style="z-index: 5;padding-top:70px;padding-right:15px">
			  <div class="toast shadow-sm align-items-center show text-dark bg-warning border-0" role="alert" aria-live="assertive" aria-atomic="true">
			  <div class="d-flex">
			    <div class="toast-body">
			      Komentar <b>BERHASIL</b> ditambahkan!
			    </div>
			    <button type="button" class="btn-close btn-close-white me-2 m-auto toclose" data-bs-dismiss="toast" aria-label="Close"></button>
			  </div>
			</div>
			</div>');
		redirect('detail/'.$backtopost['url_posting']);
		return false;
	}


}
