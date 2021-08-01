<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Infopost extends CI_Controller {


	public function index($urlpost)
	{
		$data['title']='Info detail';
		// visitor postingan
		$querydetail="SELECT posting.*,kategori.*, count(id_post) as jmlkomen from posting left join kategori on posting.kategori_posting=kategori.id_kategori left join komentar on posting.id_posting=komentar.id_post where url_posting = '$urlpost' group by id_posting";
		$data['detailposting']=$this->db->query($querydetail)->row_array();
		$idpost=$data['detailposting']['id_posting'];
		$data['visitorpost']=$data['detailposting']['visitor_posting'];
		$this->db->set('visitor_posting', $data['visitorpost']+1);
		$this->db->where('id_posting', $idpost);
		$this->db->update('posting');
		// baca komentar
		if($this->session->userdata('level_user')){
			$this->db->set('status_komentar', 'dibaca');
			$this->db->where('id_post', $idpost);
			$this->db->update('komentar');
		}
		// loop komen
		$data['komentars']=$this->db->get_where('komentar',['id_post' => $idpost])->result_array();
		// visitor total
		$oldvisitor=$this->db->get_where('visitor',['id_visitor' => 1])->row_array();
		$data['totalvisitor']=$oldvisitor['total_visitor'];
		$this->db->set('total_visitor', $oldvisitor['total_visitor']+1);
		$this->db->where('id_visitor', 1);
		$this->db->update('visitor');
		// loop post populer
		$postpopuler="SELECT posting.*,kategori.*, count(id_post) as jmlkomen from posting left join kategori on posting.kategori_posting=kategori.id_kategori left join komentar on posting.id_posting=komentar.id_post group by id_posting order by visitor_posting desc limit 6";
		$data['postpopuler']=$this->db->query($postpopuler)->result_array();
		// kategori tipe
		$querykategori="SELECT kategori.*, count(kategori_posting) as totalkategori from kategori left join posting on posting.kategori_posting=kategori.id_kategori group by id_kategori order by urutan_kategori";
		$data['kategories']=$this->db->query($querykategori)->result_array();
		// view infopost
		$this->load->view('templates/header',$data);
		$this->load->view('public/detailpost',$data);
	}

	public function tambahkomen()
	{
		$urlanda=htmlspecialchars($this->input->post('urlanda',true));
		$ipanda=htmlspecialchars($this->input->post('ipanda',true));
		$idpostanda=htmlspecialchars($this->input->post('idpostanda',true));
		$komentaranda=htmlspecialchars($this->input->post('komentaranda',true));
		$tglkomenanda=time();
		if($this->session->userdata('level_user')){
			$namaanda='Admin';
			$statusanda='dibaca';
			$levelanda='admin';
		}else{
			$namaanda=htmlspecialchars($this->input->post('namaanda',true));
			$statusanda='belum';
			$levelanda='users';
		}
		$data = array(
        'id_komentar' => null,
        'id_post' => $idpostanda,
        'nama_komentar' => $namaanda,
        'isi_komentar' => $komentaranda,
        'tanggal_komentar' => $tglkomenanda,
        'ip_komentar' => $ipanda,
        'status_komentar' => $statusanda,
        'level_komentar' => $levelanda
		);
		// konfirm inserting
		$this->db->insert('komentar', $data);
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
		redirect('detail/'.$urlanda);
		return false;
	}


}