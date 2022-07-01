<!DOCTYPE html>
<html lang="en">
  
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Ujian Online</title>
    <link rel="stylesheet" href="Web/assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="Web/assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="Web/assets/css/style.css">
    <link rel="icon" type="image/png" href="web/assets/images/favicon.png"/>
  </head>
  
  <body>
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth">
          <div class="row flex-grow">
            <div class="col-lg-4 mx-auto">
              <div class="auth-form-light text-left p-5">
                <h1><center>Hello! Let's get started</center></h1>
                <form class="pt-3" id="formlogin">
                  <div class="form-group">
                    <input type="text" class="form-control form-control-lg" id="username" name="username" placeholder="Username">
                  </div>
                  <div class="form-group">
                    <input type="password" class="form-control form-control-lg" id="password" name="password" placeholder="Password">
                  </div>
                  <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">SIGN IN</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <script src="Web/assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="Web/assets/js/off-canvas.js"></script>
    <script src="Web/assets/js/hoverable-collapse.js"></script>
    <script src="Web/assets/js/misc.js"></script>
    <script src="Web/bootstrap/js/bootstrap.min.js"> </script>
    <script src="Web/bootbox/bootbox.min.js"> </script>
    <script type="text/javascript">
      $(document).ready(function(){
        $("#formlogin").submit(function(e){
          e.preventDefault();
          $.ajax({
            type: "POST",
            url: "ceklogin.php",
            data: $("#formlogin").serialize()
          })
          .done(function(hasilProses){
            if (hasilProses != ""){
              bootbox.alert({
                title: 'Login berhasil',
                message: 'Selamat datang ' + hasilProses,
                callback: function(result){
                  window.location.href = "?kode=dashboard";
                }
              });
            } else {
              bootbox.alert({
                title: 'Login gagal',
                message: 'Isikan username dan password dengan benar!'
              });
            }
          })
          .fail(function(jqXHR, textStatus){
            alert("Request gagal: " + textStatus);
          });
        });
      });
    </script>
  </body>
</html>
