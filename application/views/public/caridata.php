    <!-- navbar top -->
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark text-light shadow-sm" style="background-color:#32a89d">
      <div class="container-fluid">
        <a class="navbar-brand" href="<?= base_url(); ?>">
          <img src="<?= base_url('assets/img/matacode3.png'); ?>" alt="" width="40" height="34" class="d-inline-block align-text-top">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="<?= base_url(); ?>">Beranda</a>
            </li>
            <!-- <li class="nav-item">
              <a class="nav-link" href="#">Link</a>
            </li> -->
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Kategori
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <?php foreach($kategories as $kategori): ?>
                  <li style="background-color:<?php if($kategori['url_kategori']==$title){echo "#eee";} ?>;"><a class="dropdown-item d-flex align-items-center" href="<?= base_url('kategori/'.$kategori['url_kategori']); ?>"><img src="<?= base_url('assets/img/img-kategori/'.$kategori['img_kategori']); ?>" class="me-1" width="30px"> <?= '<span class="me-4">'.$kategori['nama_kategori'].'</span>'.'<span class="badge bg-primary ms-auto rounded-pill">'.$kategori['totalkategori'].' post</span>'; ?></a></li>
                <?php endforeach; ?>
              </ul>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Layanan
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <li><a target="_blank" class="dropdown-item d-flex justify-content-start align-items-center" href="https://api.whatsapp.com/send?phone=+6282179471533"><i class="bi bi-whatsapp me-1 text-success" style="font-size:27px"></i>Pembuatan Website & Web Aplikasi</a></li>
                  <li><a target="_blank" class="dropdown-item d-flex justify-content-start align-items-center" href="https://meinviteyou.com/"><img src="<?= base_url('assets/img/logomiy.png'); ?>" class="me-1" width="30px">Pembuatan Undangan Digital</a></li>
              </ul>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?= base_url('beranda/tentang'); ?>">Tentang</a>
            </li>
          </ul>
          <form class="d-flex" method="post" action="<?= base_url('caridata'); ?>">
            <input required class="form-control me-2" name="cariberanda" value="<?= set_value('cariberanda'); ?>" type="search" placeholder="Cari.." aria-label="Search">
            <button class="btn btn-outline-warning text-light" name="buttoncariberanda" type="submit">Cari</button>
          </form>
        </div>
      </div>
    </nav>
    <!-- tutup navbar top -->

    <!-- jumbotron -->
    <div class="jumbotron jumbotron-fluid text-dark text-center rounded p-4 shadow-sm" style="background-color:rgba(85, 217, 204,.8);margin-top:0px;">
    </div>
    <!-- tutup jumbotron -->

    <?=$this->session->flashdata('message'); ?>

    <!-- post terbaru -->
    <div class="alert mt-4 p-2 shadow-sm" role="alert" style="background-color:rgba(85, 217, 204,.8);">
      <span class="d-flex justify-content-between">
      <h3>Hasil Pencarian "<?= $valuecari; ?>" </h3>
      <?php if($this->session->userdata('level_user')){ ?>
      <button type="button" class="btn btn-warning btn-sm modal-dialog-centered" data-bs-toggle="modal" data-bs-target="#staticadd">Add Post</button>
      <?php } ?>
      </span>
    </div>
    <!-- tutup post -->

    <!-- isi post -->
    <div class="row ms-1 me-1">
      <?php if($countcari==0){ ?>
        <p class="text-center">Tidak ada hasil untuk kata kunci "<span class="text-danger"><?= set_value('cariberanda'); ?></span>"!</p>
      <?php }else{ ?>
      <?php foreach($postings as $posting): ?>
      <?php $linkp=base_url('detail/'.$posting['url_posting']); ?>
      <div class="col-md-6">
        <div class="card mb-3 shadow-sm" style="background-color:#f5f5f5;">
          <div class="row g-0">
            <div class="col-4">
              <img src="<?=base_url('assets/img/img-kategori/'.$posting['img_kategori']); ?>" alt="logo matacode" width="100%">
            </div>
            <div class="col-8">
              <div class="card-body">
                <a href="<?= base_url('detail/'.$posting['url_posting'].'/'); ?>" style="text-decoration:none;"><h5 class="card-title" style="line-height:20px;"><?= $posting['judul_posting']; ?></h5></a> 
                <?php if($this->session->userdata('level_user')){ ?>
                <span class="d-flex justify-content-start">
                <span class="badge bg-success modal-dialog-centered detailup" style="width:60px" data-bs-toggle="modal" data-bs-target="#staticupdate" data-idupdate="<?= $posting['id_posting']; ?>">update</span>|<span class="badge bg-danger" style="width:60px;"><a onclick="return confirm('Pilih Oke untuk hapus!');" style="color:white;text-decoration:none;" href="<?= base_url('admin/hapuspost/'.$posting['id_posting']); ?>">hapus</a></span>
                </span>
                <?php } ?>
                <p class="card-text" style="line-height:20px;"><?= substr($posting['isi_posting'],0,50).'...'; ?> <a href="<?= base_url('detail/'.$posting['url_posting'].'/'); ?>">selengkapnya</a> <br>
                  <div class="d-flex justify-content-start" style="margin-top:-15px;color:#aaa;">
                  <span class="fs-0 me-4"><i class="bi bi-clock-fill text-primary"></i> 
                    <?php 
                      $waktu=time()-$posting['tanggal_posting'];
                      if($waktu<60){
                        echo $waktu.' detik lalu';
                      }else if($waktu>=60&&$waktu<=3600){
                        $waktumenit=$waktu/60;
                        echo floor($waktumenit).' menit lalu';
                      }else if($waktu>=3600&&$waktu<=86400){
                        $waktujam=$waktu/3600;
                        echo floor($waktujam).' jam lalu';
                      }else if($waktu>=86400&&$waktu<=604800){
                        $waktuhari=$waktu/86400;
                        echo floor($waktuhari).' hari lalu';
                      }else if($waktu>=604800&&$waktu<=2592000){
                        $waktuminggu=$waktu/604800;
                        echo floor($waktuminggu).' minggu lalu';
                      }else if($waktu>=2592000&&$waktu<=31536000){
                        $waktubulan=$waktu/2592000;
                        echo floor($waktubulan).' bulan lalu';
                      }else{
                        $waktutahun=$waktu/31536000;
                        echo floor($waktubulan).' tahun lalu';
                      }
                    ?>
                  </span>
                  <span class="fs-0 me-4"><i class="bi bi-eye-fill text-primary"></i> <?= $posting['visitor_posting']; ?>x</span>
                  <span class="fs-0"><i class="bi bi-chat-left-text-fill text-primary"></i> <?= $posting['jmlkomen']; ?></span>
                  </div>
                </p>
                <p class="card-text" style="margin-top:-10px">
                  <span class="text-muted">Share: </span>
                  <a target="_blank" href="https://www.facebook.com/share.php?u=<?=$linkp; ?>" title="Share this post on Facebook"><button type="button" class="btn btn-sm btn-outline-primary"><i class="bi bi-facebook"></i> fb</button></a>
                  <a target="_blank" href="https://api.whatsapp.com/send?text=<?=$linkp; ?>" title="Share this post on Whatsapp"><button type="button" class="btn btn-sm btn-outline-success"><i class="bi bi-whatsapp"></i> wa</button></a>
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
      <?php } ?>
    </div>

    <!-- <nav aria-label="Page navigation example">
      <ul class="pagination justify-content-center">
        <li class="page-item disabled">
          <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
        </li>
        <li class="page-item"><a class="page-link" href="#">1</a></li>
        <li class="page-item"><a class="page-link" href="#">2</a></li>
        <li class="page-item"><a class="page-link" href="#">3</a></li>
        <li class="page-item">
          <a class="page-link" href="#">Next</a>
        </li>
      </ul>
    </nav> -->
    <div class="d-flex justify-content-center">
      <?= $this->pagination->create_links(); ?>
    </div>
    <!-- tutup isi post -->

    <!-- post populer -->
    <div class="alert mt-4 p-2 shadow-sm" role="alert" style="background-color:rgba(85, 217, 204,.8);">
      <h3>Post Populer</h3>
    </div>

    <!-- isi post -->
    <div class="row ms-1 me-1">
      <?php foreach($postpopuler as $ppopuler): ?>
      <?php $link=base_url('detail/'.$ppopuler['url_posting']); ?>
      <div class="col-md-6 col-lg-4">
        <div class="card mb-3 shadow-sm" style="background-color:#f5f5f5;">
          <div class="row g-0">
            <div class="col-4">
              <img src="<?=base_url('assets/img/img-kategori/'.$ppopuler['img_kategori']); ?>" alt="logo matacode" width="100%">
            </div>
            <div class="col-8">
              <div class="card-body">
                <a href="<?= base_url('detail/'.$ppopuler['url_posting'].'/'); ?>" style="text-decoration:none;"><h5 class="card-title" style="line-height:20px;font-size:15px"><?= $ppopuler['judul_posting']; ?></h5></a>
                <p class="card-text" style="line-height:20px;"><a href="#"></a>
                  <div class="d-flex justify-content-between" style="margin-top:-10px;color:#aaa;font-size:15px">
                  <span class="fs-0"><i class="bi bi-clock-fill text-primary"></i> 
                    <?php 
                      $waktu=time()-$ppopuler['tanggal_posting'];
                      if($waktu<60){
                        echo $waktu.' detik lalu';
                      }else if($waktu>=60&&$waktu<=3600){
                        $waktumenit=$waktu/60;
                        echo floor($waktumenit).' menit lalu';
                      }else if($waktu>=3600&&$waktu<=86400){
                        $waktujam=$waktu/3600;
                        echo floor($waktujam).' jam lalu';
                      }else if($waktu>=86400&&$waktu<=604800){
                        $waktuhari=$waktu/86400;
                        echo floor($waktuhari).' hari lalu';
                      }else if($waktu>=604800&&$waktu<=2592000){
                        $waktuminggu=$waktu/604800;
                        echo floor($waktuminggu).' minggu lalu';
                      }else if($waktu>=2592000&&$waktu<=31536000){
                        $waktubulan=$waktu/2592000;
                        echo floor($waktubulan).' bulan lalu';
                      }else{
                        $waktutahun=$waktu/31536000;
                        echo floor($waktubulan).' tahun lalu';
                      }
                    ?>
                  </span>
                  <span class="fs-0"><i class="bi bi-eye-fill text-primary"></i> <?= $ppopuler['visitor_posting']; ?>x</span>
                  <span class="fs-0"><i class="bi bi-chat-left-text-fill text-primary"></i> <?= $ppopuler['jmlkomen']; ?></span>
                  </div>
                </p>
                <p class="card-text" style="margin-top:-10px">
                  <span class="text-muted">Share: </span>
                  <a target="_blank" href="https://www.facebook.com/share.php?u=<?=$link; ?>" title="Share this post on Facebook"><button type="button" class="btn btn-sm btn-outline-primary"><i class="bi bi-facebook"></i> fb</button></a>
                  <a target="_blank" href="https://api.whatsapp.com/send?text=<?=$link; ?>" title="Share this post on Whatsapp"><button type="button" class="btn btn-sm btn-outline-success"><i class="bi bi-whatsapp"></i> wa</button></a>
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
    <!-- tutup isi post -->
    <!-- tutup post populer -->

    <!-- footer -->
    <div class="card-footer text-muted bg-dark d-flex justify-content-center align-items-center" style="height:100px">
      <span class="">
        <p>Diberdayakan oleh - mata code</p>
      </span>
    </div>
    <!-- tutup footer -->

<?php if($this->session->userdata('level_user')){ ?>
    <!-- daftar modal -->
    <!-- Modal add -->
    <div class="modal fade" id="staticadd" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Add post</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
          <button class="btn-sm btn btn-info mb-3 btntoggleadd">Add kategori</button>
          <div class="togglekategori">
            <form action="<?= base_url('admin/addkategori'); ?>" method="post" enctype="multipart/form-data">
              <div class="input-group mb-3">
                <span class="input-group-text" id="namakategori">Nama</span>
                <input type="text" class="form-control namakategori" placeholder="Nama kategori" aria-label="namakategori" name="namakategori" aria-describedby="namakategori" required>
              </div>
              <div class="input-group mb-3">
                <span class="input-group-text" id="urlkategori">Url</span>
                <input type="text" class="form-control urlkategori" placeholder="Url kategori" aria-label="urlkategori" name="urlkategori" aria-describedby="urlkategori" required>
              </div>
              <div class="input-group mb-3">
                <input type="file" class="form-control" id="inputGroupFile02" name="imgkategori" required>
              </div>
              <div class="input-group mb-3">
                <span class="input-group-text" id="urutankategori">Urutan kategori</span>
                <input type="number" class="form-control urutankategori" placeholder="Urutan kategori" aria-label="urutankategori" name="urutankategori" aria-describedby="urutankategori" required>
              </div>
              <button class="btn-sm btn btn-primary" type="submit" name="addkat" style="height:30px">Add</button>
            </form>
              <span>
                <span style="text-align:center;">Daftar kategori</span> <br>
                <?php foreach($kategories as $kategori): ?>
                  <span><?=$kategori['urutan_kategori']; ?>. <?=$kategori['nama_kategori']; ?></span> <span class="text-success ajaxkategori" data-idkategori="<?= $kategori['id_kategori']; ?>" data-bs-toggle="modal" data-bs-target="#modalupkategori" style="text-decoration:underline;cursor:pointer;">edit</span> <a onclick="return confirm('Pilih Oke untuk hapus!');" href="<?= base_url('admin/hapuskategori/'.$kategori['id_kategori']); ?>" class="text-danger">hapus</a> |
                <?php endforeach; ?>
              </span>
            <hr>
          </div>

            <form action="<?= base_url('admin/index'); ?>" method="post">
              <div class="input-group mb-3">
                <span class="input-group-text" id="judulpost">Judul</span>
                <input type="text" class="form-control judulpost" placeholder="Judul postingan" aria-label="judulpostingan" name="judulpost" aria-describedby="judulpost" required>
              </div>
              <div class="input-group mb-3">
                <span class="input-group-text" id="urlpost">Url Post</span>
                <input type="text" class="form-control urlpost" placeholder="Url postingan" aria-label="urlpostingan" name="urlpost" aria-describedby="urlpost" required>
              </div>
              <div class="input-group mb-3">
                <label class="input-group-text" for="inputkategori">Kategori</label>
                <select class="form-select" id="inputkategori" name="kategoripost" required>
                  <option selected>Pilih...</option>
                  <?php foreach($kategories as $kategori): ?>
                  <option value="<?= $kategori['id_kategori']; ?>"><?= $kategori['nama_kategori']; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="input-group">
                <textarea style="min-height:400px" class="form-control" aria-label="With textarea" placeholder="Isi postingan" name="isipost" required></textarea>
              </div>
          </div>
          <div class="modal-footer">
            <button type="submit" name="addpost" class="btn btn-primary">Add</button>
          </div>
          </form>
        </div>
      </div>
    </div>
    <!-- tutup modal add -->
    <!-- Modal update -->
    <div class="modal fade" id="staticupdate" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Update post</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="<?= base_url('admin/updatepost'); ?>" method="post">
              <input type="hidden" name="idpostu" class="idpostu">
              <div class="input-group mb-3">
                <span class="input-group-text" id="judulpostu">Judul</span>
                <input type="text" class="form-control judulpostu" placeholder="Judul postingan" aria-label="judulpostinganu" name="judulpostu" aria-describedby="judulpostu" required>
              </div>
              <div class="input-group mb-3">
                <span class="input-group-text" id="urlpost">Url Post</span>
                <input type="text" class="form-control urlpostu" placeholder="Url postingan" aria-label="urlpostinganu" name="urlpostu" aria-describedby="urlpostu" required>
              </div>
              <div class="input-group mb-3">
                <label class="input-group-text" for="inputkategori">Kategori</label>
                <select class="form-select kategoripostu" id="inputkategori" name="kategoripostu" required>
                  <?php foreach($kategories as $kategori): ?>
                  <option value="<?= $kategori['id_kategori']; ?>"><?= $kategori['nama_kategori']; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="input-group">
                <textarea style="min-height:450px" class="form-control isipostu" aria-label="With textarea" placeholder="Isi postingan" name="isipostu" required></textarea>
              </div>
          </div>
          <div class="modal-footer">
            <button type="submit" name="addpostu" class="btn btn-primary">Add</button>
          </div>
          </form>
        </div>
      </div>
    </div>
    <!-- tutup modal update -->
    <!-- Modal update kategori -->
    <div class="modal fade" id="modalupkategori" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Update kategori</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
              <div class="modal-body">
                <form action="<?= base_url('admin/updatekategori'); ?>" method="post" enctype="multipart/form-data">
                  <input type="hidden" class="idkategoriu" name="idkategoriu">
                  <div class="input-group mb-3">
                    <span class="input-group-text" id="namakategoriu">Nama</span>
                    <input type="text" class="form-control namakategoriu" placeholder="Nama kategori" aria-label="namakategoriu" name="namakategoriu" aria-describedby="namakategoriu" required>
                  </div>
                  <div class="input-group mb-3">
                    <span class="input-group-text" id="urlkategoriu">Url</span>
                    <input type="text" class="form-control urlkategoriu" placeholder="Url kategori" aria-label="urlkategoriu" name="urlkategoriu" aria-describedby="urlkategoriu" required>
                  </div>
                  <div class="input-group mb-3">
                    <label class="input-group-text p-0 imglamakategori" for="inputGroupFile01">
                      ...
                    </label>
                    <input type="file" class="form-control imgkategoriu" id="inputGroupFile02" name="imgkategoriu">
                  </div>
                  <div class="input-group mb-3">
                    <span class="input-group-text" id="urutankategoriu">Urutan kategori</span>
                    <input type="number" class="form-control urutankategoriu" placeholder="Urutan kategori" aria-label="urutankategoriu" name="urutankategoriu" aria-describedby="urutankategoriu" required>
                  </div>
                  <button class="btn-sm btn btn-primary" type="submit" name="addkat" style="height:30px">Update</button>
                </form>
              </div>
        </div>
      </div>
    </div>
    <!-- tutup modal up kategori -->
    <!-- tutup daftar modal -->
<?php } ?>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <!-- jdc jquery -->
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<?php if($this->session->userdata('level_user')){ ?>
    <script>
      $(document).ready(function(){

        $('.judulpost').on('keyup',function(){
          var judulpost=$('.judulpost').val();
          $('.urlpost').val(judulpost.replace(/\s/g,'-'));
        });

        $('.namakategori').on('keyup',function(){
          var judulpost=$('.namakategori').val();
          $('.urlkategori').val(judulpost.replace(/\s/g,'-'));
        });

        $('.togglekategori').hide();
        $('.btntoggleadd').on('click',function(){
          $('.togglekategori').slideToggle();
        });

        $('.detailup').on('click',function(){
          var idupdate=$(this).data('idupdate');
          $.ajax({
            url: '<?=base_url('admin/ajaxpost'); ?>',
            method: "POST",
            data: {idupdate:idupdate},
            dataType: "json",
            success:function(data){
              $('.idpostu').val(data.id_posting);
              $('.judulpostu').val(data.judul_posting);
              $('.urlpostu').val(data.url_posting);
              $('.kategoripostu').val(data.id_kategori);
              $('.isipostu').val(data.isi_posting);
            }
          });
        });

        $('.ajaxkategori').on('click',function(){
          var idkategori=$(this).data('idkategori');
          $.ajax({
            url: '<?=base_url('admin/ajaxkategori'); ?>',
            method: "POST",
            data: {idkategori:idkategori},
            dataType: "json",
            success:function(data){
              $('.idkategoriu').val(data.id_kategori);
              $('.namakategoriu').val(data.nama_kategori);
              $('.urlkategoriu').val(data.url_kategori);
              $('.imglamakategori').html('<img src="<?= base_url('assets/img/img-kategori/'); ?>'+data.img_kategori+'" width="40" height="100%">');
              $('.urutankategoriu').val(data.urutan_kategori);
            }
          });
        });

      });
    </script>
<?php } ?>
    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
    -->
  </body>
</html>