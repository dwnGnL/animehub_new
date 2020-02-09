<!DOCTYPE html>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>AnimeHub.tj - Dashboard</title>

  <!-- Custom fonts for this template-->

  <link href="<?=$uri?>/templates/dashboard/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
    <link rel="stylesheet" href="<?=$uri?>/templates/dashboard/full/css/jquery.loadingModal.css">
  <link href="<?=$uri?>/templates/dashboard/css/sb-admin-2.min.css" rel="stylesheet">
  <link rel="stylesheet" href="<?=$uri?>/templates/dashboard/css/table.css?<?=filemtime('templates/dashboard/css/table.css')?>">
  <link rel="stylesheet" href="<?=$uri?>/templates/dashboard/css/add-post.css?<?=filemtime('templates/dashboard/css/add-post.css')?>">
  <link rel="stylesheet" href="<?=$uri?>/templates/dashboard/css/slider.css?<?=filemtime('templates/dashboard/css/slider.css')?>">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <?=$sidebar?>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <?=$nav?>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
          <?=$main?>
        <!-- /.container-fluid -->


      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; AnimeHub.tj 2019-2020</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
      <span id="token" style="display:none;"><?=$helper::generateToken()?></span>
  <!-- Remove Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Удаление</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Вы точно хотите удалить?</div>
        <div class="modal-footer">
          <button class="btn btn-danger" id="remove" type="button" data-dismiss="modal">Да</button>
          <button class="btn btn-success" type="button" data-dismiss="modal">Нет</button>

        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="<?=$uri?>/templates/dashboard/vendor/jquery/jquery.min.js"></script>
  <script src="<?=$uri?>/templates/dashboard/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
      <script src="<?=$uri?>/templates/dashboard/full/js/jquery.loadingModal.js?<?=filemtime('templates/dashboard/full/js/jquery.loadingModal.js')?>"></script>
  <!-- Core plugin JavaScript-->
  <script src="<?=$uri?>/templates/dashboard/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?=$uri?>/templates/dashboard/js/sb-admin-2.min.js"></script>
  <script src="<?=$uri?>/templates/dashboard/js/dash.js?<?=filemtime('templates/dashboard/js/dash.js')?>"></script>
  <script src="<?=$uri?>/templates/dashboard/js/chosen.jquery.js"></script>
<script src="<?=$uri?>/templates/dashboard/js/prism.js?<?=filemtime('templates/dashboard/js/prism.js')?>" type="text/javascript" charset="utf-8"></script>
  <script src="<?=$uri?>/templates/dashboard/js/init.js?<?=filemtime('templates/dashboard/js/init.js')?>" type="text/javascript" charset="utf-8"></script>
</body>

</html>
