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
              <a class="nav-link" aria-current="page" href="<?= base_url(); ?>">Beranda</a>
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
              <a class="nav-link active" href="<?= base_url('beranda/tentang'); ?>">Tentang</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- tutup navbar top -->

    <!-- tentang -->
    <div class="justify-content-center d-flex">
        <div class="card shadow" style="width: 22rem;margin-top:80px;">
          <div class="d-flex justify-content-center">
          <img style="width:150px" src="<?= base_url('assets/img/matacode1.png'); ?>" class="card-img-top" alt="mata code">
          </div>
          <div class="card-body text-center">
            <h5 class="card-title">MATA CODE</h5>
            <p style="text-align: justify;" class="card-text">
              Mata Code adalah sebuah website yang digunakan untuk mencari solusi dari masalah code program website anda.<br>
              Website Mata Code dikembangkan oleh <a href="https://www.facebook.com/ketut.k.ii/">Ketut Krisna</a>, sebagai media untuk membantu para programmer website untuk mencari solusi dari masalah program yang sedang dikerjakan.
            </p>
          </div>
        </div>
    </div>
    <!-- tutup tentang -->

    <!-- footer -->
    <div class="card-footer text-muted bg-dark" style="height:100px;position:absolute;bottom:0;width:100%">
      <span class="d-flex justify-content-center align-items-center">
        <p style="margin-top:25px;">Diberdayakan oleh - mata code</p>
      </span>
    </div>
    <!-- tutup footer -->

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <script async src="https://cpwebassets.codepen.io/assets/embed/ei.js"></script>

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