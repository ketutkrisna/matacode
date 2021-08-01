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

    <?php  
      function IPpengunjung() {
          $ipaddress = '';
          if (getenv('HTTP_CLIENT_IP'))
              $ipaddress = getenv('HTTP_CLIENT_IP');
          else if(getenv('HTTP_X_FORWARDED_FOR'))
              $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
          else if(getenv('HTTP_X_FORWARDED'))
              $ipaddress = getenv('HTTP_X_FORWARDED');
          else if(getenv('HTTP_FORWARDED_FOR'))
              $ipaddress = getenv('HTTP_FORWARDED_FOR');
          else if(getenv('HTTP_FORWARDED'))
              $ipaddress = getenv('HTTP_FORWARDED');
          else if(getenv('REMOTE_ADDR'))
              $ipaddress = getenv('REMOTE_ADDR');
          else
              $ipaddress = 'IP Tidak Dikenali';
       
          return $ipaddress;
      }
    ?>

    <!-- isi post -->
    <div class="clearfix p-3" style="background-color:#f5f5f5;;margin:80px 15px 0px 15px;border-radius:5px;border:1px solid #ddd">

      <img src="<?= base_url('assets/img/img-kategori/'.$detailposting['img_kategori']); ?>" class="col-sm-4 float-sm-start mb-2 me-3 ms-sm-0 col-12"  alt="logo">

      <a href="#!" style="text-decoration:none;"><h5 class="card-title" style="line-height:20px;"><?= $detailposting['judul_posting']; ?></h5></a>
      <p class="card-text" style="line-height:20px;"><?= $detailposting['isi_posting']; ?></p>
      <div class="d-flex justify-content-start" style="margin-top:-10px;color:#aaa;">
        <span class="fs-0 me-4"><i class="bi bi-clock-fill text-primary"></i> 
          <?php 
            $waktu=time()-$detailposting['tanggal_posting'];
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
        <span class="fs-0 me-4"><i class="bi bi-eye-fill text-primary"></i> <?=$detailposting['visitor_posting']+1; ?>x</span>
        <span class="fs-0"><i class="bi bi-chat-left-text-fill text-primary"></i> <?= $detailposting['jmlkomen']; ?></span>
      </div>
      <?php $link=base_url('detail/'.$detailposting['url_posting']); ?>

      <p class="card-text" style="margin-top:0px">
        <span class="text-muted">Share: </span>
        <a target="_blank" href="https://www.facebook.com/share.php?u=<?=$link; ?>" title="Share this post on Facebook"><button type="button" class="btn btn-sm btn-outline-primary"><i class="bi bi-facebook"></i> fb</button></a>
        <a target="_blank" href="https://api.whatsapp.com/send?text=<?=$link; ?>" title="Share this post on Whatsapp"><button type="button" class="btn btn-sm btn-outline-success"><i class="bi bi-whatsapp"></i> wa</button></a>
      </p>

      <span>Komentar:</span>
      <?php foreach($komentars as $komentar): ?>
      <div class="d-flex justify-content-start mt-2">
        <?php if($komentar['level_komentar']=='admin'){ ?>
          <img class="rounded-circle" width="30" height="30" src="<?=base_url('assets/img/komenadmin.png');?>">
        <?php }else{ ?>
          <img class="rounded-circle" width="30" height="30" src="<?=base_url('assets/img/komenuser.jpg');?>">
        <?php } ?>
        <span style="margin-left:5px;border:1px solid #ddd;padding:7px;border-radius:0 15px 15px 15px;background-color:#ddd;">
          <span class="d-flex justify-content-between">
            <span class="me-2"><b><?=$komentar['nama_komentar']; ?></b></span> 
            <span style="font-size:12px;"> 
              <?php 
                $waktu=time()-$komentar['tanggal_komentar'];
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
          </span>
          <span> <?=$komentar['isi_komentar']; ?></span>
          <?php if($this->session->userdata('level_user')){ ?>
          <a onclick="return confirm('Pilih Oke untuk hapus!');" href="<?= base_url('admin/hapuskomentar/'.$komentar['id_komentar'].'/'.$komentar['id_post']); ?>"><span class="text-danger">Hapus</span></a>
          <?php } ?>
        </span>
      </div>
      <?php endforeach; ?>

      <div class=" row mt-4">
        <div class="col-lg-8">
        <form class="form-control" action="<?=base_url('infopost/tambahkomen'); ?>" method="post">
        <input type="hidden" class="ipanda" name="ipanda" value="<?= IPpengunjung(); ?>">
        <input type="hidden" class="idpostanda" name="idpostanda" value="<?= $detailposting['id_posting']; ?>">
        <input type="hidden" class="urlanda" name="urlanda" value="<?= $detailposting['url_posting']; ?>">
        <?php if(!$this->session->userdata('level_user')){ ?>
        <div class="input-group input-group mb-1">
          <input type="text" class="form-control kosong1 namaanda" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" name="namaanda" placeholder="Masukan nama anda.."  required>
        </div>
        <?php } ?>
        <div class="d-flex justify-content-start">
          <textarea class="form-control h-5 komentaranda" style="height:100px" aria-label="With textarea" placeholder="Ketik komentar..." name="komentaranda" required></textarea>
          <button type="submit" style="border-radius:0 5px 5px 0;z-index:0" class="input-group-text btn btn-primary bg-primary text-white aturkomen tambahkomentar">OK</button>
        </div>
        </form>
        </div>
      </div>

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

    <!-- notifikai toast -->
    <?=$this->session->flashdata('message'); ?>
    <!-- tutup notifikai toast -->

    <!-- footer -->
    <div class="card-footer text-muted bg-dark d-flex justify-content-center align-items-center" style="height:100px">
      <span class="">
        <p>Diberdayakan oleh - mata code</p>
      </span>
    </div>
    <!-- tutup footer -->

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script async src="https://cpwebassets.codepen.io/assets/embed/ei.js"></script>

    <script>
      $(document).ready(function(){

        $('.namaanda').val(localStorage.getItem('NAMAANDA'));
        $('.namaanda').on('keyup',function(){
          localStorage.setItem('NAMAANDA',$('.namaanda').val());
        });

        $('.toclose').on('click',function(){
          $('.toast').hide();
        });

      });
    </script>

    <!-- <script>
      $('body .code-box').css('background-color','red');
    </script> -->

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
    -->
  </body>
</html>