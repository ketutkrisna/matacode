<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Beranda extends CI_Controller {


	public function index()
	{
		$data['title']='beranda';
		// update visitor
		$oldvisitor=$this->db->get_where('visitor',['id_visitor' => 1])->row_array();
		$data['totalvisitor']=$oldvisitor['total_visitor'];
		$this->db->set('total_visitor', $oldvisitor['total_visitor']+1);
		$this->db->where('id_visitor', 1);
		$this->db->update('visitor');
		// pagination
		$countall=$this->db->get('posting')->num_rows();
		$config['base_url'] = 'http://localhost/matacode/beranda/index/';
		$config['total_rows'] = $countall;
		$config['per_page'] = 12;
		$jmldt=$config['per_page'];
		$config['full_tag_open'] = '<nav><ul class="pagination">';
		$config['full_tag_close'] = '</ul></nav>';

		$config['first_link'] = 'First';
		$config['first_tag_open'] = '<li class="page-item">';
		$config['first_tag_close'] = '</li>';
 
		$config['last_link'] = 'Last';
		$config['last_tag_open'] = '<li class="page-item">';
		$config['last_tag_close'] = '</li>';

		$config['next_link'] = '&raquo;';
		$config['next_tag_open'] = '<li class="page-item">';
		$config['next_tag_close'] = '</li>';

		$config['prev_link'] = '&laquo;';
		$config['prev_tag_open'] = '<li class="page-item">';
		$config['prev_tag_close'] = '</li>';

		$config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
		$config['cur_tag_close'] = '</a></li>';

		$config['num_tag_open'] = '<li class="page-item">';
		$config['num_tag_close'] = '</li>';

		$config['attributes'] = array('class' => 'page-link');
		$this->pagination->initialize($config);
		if($this->uri->segment(3)==''){
			$start=0;
		}else{
			$start=$this->uri->segment(3);
		}
		// loop postingan
		$querypost="SELECT posting.*,kategori.*, count(id_post) as jmlkomen from posting left join kategori on posting.kategori_posting=kategori.id_kategori left join komentar on posting.id_posting=komentar.id_post group by id_posting order by id_posting desc limit $start, $jmldt";
		$data['postings']=$this->db->query($querypost)->result_array();
		// loop post populer
		$postpopuler="SELECT posting.*,kategori.*, count(id_post) as jmlkomen from posting left join kategori on posting.kategori_posting=kategori.id_kategori left join komentar on posting.id_posting=komentar.id_post group by id_posting order by visitor_posting desc limit 6";
		$data['postpopuler']=$this->db->query($postpopuler)->result_array();
		// kategori tipe
		$querykategori="SELECT kategori.*, count(kategori_posting) as totalkategori from kategori left join posting on posting.kategori_posting=kategori.id_kategori group by id_kategori order by urutan_kategori";
		$data['kategories']=$this->db->query($querykategori)->result_array();
		// info notifikasi
		$querynotifikasi="SELECT * from posting join komentar on posting.id_posting=komentar.id_post order by id_komentar desc";
		$data['notifikasis']=$this->db->query($querynotifikasi)->result_array();
		// count notifikasi
		$data['countnotifikasi']=$this->db->get_where('komentar',['status_komentar' => 'belum'])->num_rows();
		// view beranda
		$this->load->view('templates/header',$data);
		$this->load->view('public/beranda',$data);
	}

	public function caridata()
	{
		$datainput=htmlspecialchars($this->input->post('cariberanda',true));
		$data['title']='pencarian data';
		$data['valuecari']=$datainput;
		// update visitor
		$oldvisitor=$this->db->get_where('visitor',['id_visitor' => 1])->row_array();
		$data['totalvisitor']=$oldvisitor['total_visitor'];
		$this->db->set('total_visitor', $oldvisitor['total_visitor']+1);
		$this->db->where('id_visitor', 1);
		$this->db->update('visitor');
		// loop postingan
		$querypost="SELECT posting.*,kategori.*, count(id_post) as jmlkomen from posting left join kategori on posting.kategori_posting=kategori.id_kategori left join komentar on posting.id_posting=komentar.id_post where judul_posting like '%$datainput%' or isi_posting like '%$datainput%' group by id_posting order by id_posting desc";
		$data['postings']=$this->db->query($querypost)->result_array();
		$data['countcari']=$this->db->query($querypost)->num_rows();
		// loop post populer
		$postpopuler="SELECT posting.*,kategori.*, count(id_post) as jmlkomen from posting left join kategori on posting.kategori_posting=kategori.id_kategori left join komentar on posting.id_posting=komentar.id_post group by id_posting order by visitor_posting desc limit 6";
		$data['postpopuler']=$this->db->query($postpopuler)->result_array();
		// kategori tipe
		$querykategori="SELECT kategori.*, count(kategori_posting) as totalkategori from kategori left join posting on posting.kategori_posting=kategori.id_kategori group by id_kategori order by urutan_kategori";
		$data['kategories']=$this->db->query($querykategori)->result_array();
		// view beranda
		$this->load->view('templates/header',$data);
		$this->load->view('public/caridata',$data);
	}

	public function tentang()
	{
		$data['title']='tentang mata code';
		// update visitor
		$oldvisitor=$this->db->get_where('visitor',['id_visitor' => 1])->row_array();
		$data['totalvisitor']=$oldvisitor['total_visitor'];
		$this->db->set('total_visitor', $oldvisitor['total_visitor']+1);
		$this->db->where('id_visitor', 1);
		$this->db->update('visitor');
		// kategori tipe
		$querykategori="SELECT kategori.*, count(kategori_posting) as totalkategori from kategori left join posting on posting.kategori_posting=kategori.id_kategori group by id_kategori order by urutan_kategori";
		$data['kategories']=$this->db->query($querykategori)->result_array();
		
		$this->load->view('templates/header',$data);
		$this->load->view('public/tentang',$data);

	}


}
