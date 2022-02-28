<?php include('config/auth.php'); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8"/>
        <title>Sistem Verifikasi</title>
        <link href="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet">
        <link href="css/fileinput.css" media="all" rel="stylesheet" type="text/css" />
        
        <script src="js/jquery.js" type="text/javascript"></script>
        <script src="js/fileinput.js" type="text/javascript"></script>
        <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
        <link rel="icon" href="../css/logo.png">
        <script src="../sweetalert/sweetalert2.min.js"></script>
        <link rel="stylesheet" href="../sweetalert/sweetalert2.min.css">
        <style>
.card {
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
  transition: 0.3s;
  height: 500px;
  background: #ffffff;
  margin-right: 0px;
  margin-left: 0px;
}

.card:hover {
  box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
}

.container {
  padding: 2px 16px;
}
.center {
  display: block;
  margin-left: auto;
  margin-right: auto;
}
.one {
  border-style: double;
  border-color: red;
}

.two {
  border-style: double;
  border-color: green;
} 
body{
    background: #f5f5f5;
}
.mb-4{
    margin-bottom : 5px;
}
.d-flex{display:flex!important}
.justify-content-evenly{justify-content:space-evenly!important}
</style>

    </head>
    <body>
            <div class="container mb-4">
                <div class="text-center"><h1>Sistem Verifikasi Parkir</h1></div>
                <div class="text-right mb-4">
                    <a href="verifikasi.php" class="btn btn-primary">Verifikasi</a>
                    <a href="index.php" class="btn btn-danger disabled">Sistem Verifikasi</a>
                </div>
            </div>
        <div class="container-fluid mt-4">
            <div class="row center mt-4 d-flex justify-content-evenly">
                <div class="card col-md-4 one px-2">
                    <h2 class="text-center">Input Foto</h2>
                    <form enctype="multipart/form-data" id="input">
                        <div class="form-group">
                            <input id="file-3" id="fileupload" type="file" name="fileupload" accept="image/png, image/gif, image/jpeg">
                        </div>
                        <div class="form-group">
                            <!-- <button class="btn btn-warning" type="button">Disable Test</button> -->
                            <button type="submit" id="upload" class="btn btn-primary"><i class="glyphicon glyphicon-upload"></i> Upload</button>
                            <button id="proses_gambar" class="btn btn-danger"><i class="glyphicon glyphicon-cog"></i> Proses</button>
                            <!-- <button class="btn btn-default" type="reset"><i class="glyphicon glyphicon-retweet"></i> Reset</button> -->
                        </div>
                    </form>
                </div>
                <div class="card col-md-4 two">
                    <form id="input-ocr">
                    <h2 class="text-center">Hasil OCR</h2>
                        <div class="form-group">
                            <label for="">Hasil Text Gambar</label>
                            <input type="text" name="ocr_text" class="form-control" id="ocr_text" readonly="on">
                        </div>
                        <div class="form-group">
                            
                            <label for="">Output Gambar</label><br>
                            <img style="max-width: 500 !important; min-width: 500 !important;" id="base64img" >
                            <input type="hidden" name="ocr_image" id="ocr_image">
                            <input type="hidden" name="url_fileupload" id="url_fileupload">
                        </div>
                        <div class="form-group text-center">
                            <!-- <button class="btn btn-warning" type="button">Disable Test</button> -->
                            <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-download-alt"></i> Simpan Hasil</button>
                            <!-- <button class="btn btn-default" type="reset">Reset</button> -->
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
	<script>
    $("#file-1").fileinput({
        initialPreview: ["<img src='Desert.jpg' class='file-preview-image'>", "<img src='Jellyfish.jpg' class='file-preview-image'>"],
        overwriteInitial: false
	});
	$("#file-3").fileinput({
		showCaption: false,
		browseClass: "btn btn-primary btn-lg",
		fileType: "any"
	});
    $(".btn-warning").on('click', function() {
        $("#file-4").attr('disabled', 'disabled');
        $('#file-4').fileinput('refresh', {browseLabel: 'Kartik'});
    });
	</script>
</html>

<script type="text/javascript">
    $(document).ready(function() { 
        $("#input").submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: 'controller.php?page=upload&action=insert',
                type: 'post',
                enctype: 'multipart/form-data',
                cache: false,
                processData: false,
                contentType: false,
                data: new FormData(this),
                success: function(data) {    
                // document.getElementById("input").reset();
                // $('#modal-register').modal('toggle');  
                console.log(data);         
                    if (data == 'ok') {
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Data Sudah Terupload',
                            text: 'Silahkan Proses',
                            showConfirmButton: false,
                            timer: 2000
                        });    
                        
                    } else {
                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title: 'Terjadi Error',
                            showConfirmButton: false,
                            timer: 2000
                        });
                    }

                }
            });
        });
        $("#input-ocr").submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: 'controller.php?page=ocr&action=insert',
                type: 'post',
                enctype: 'multipart/form-data',
                cache: false,
                processData: false,
                contentType: false,
                data: new FormData(this),
                success: function(data) {    
                // document.getElementById("input").reset();
                // $('#modal-register').modal('toggle');  
                console.log(data);         
                    if (data == 'ok') {
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Data Sudah Tersimpan',
                            text: 'Silahkan Verifikasi',
                            showConfirmButton: false,
                            timer: 2000
                        });    
                        $("#input")[0].reset();
                        $("#input-ocr")[0].reset();
                        $('#base64img').prop('src', '');
                    } else {
                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title: 'Terjadi Error',
                            showConfirmButton: false,
                            timer: 2000
                        });
                    }

                }
            });
        });
    });



    $('#proses_gambar').on('click', function(){

      $('#proses_gambar').html("Mohon Tunggu..");
      $('#proses_gambar').prop('disabled', true);

      $.ajax({
        type: 'get',
        url: "http://localhost:8000",
        success: function(data){
           
            if(data[0].status == "Berhasil!")
            {
                Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'Gambar Telah Berhasil Diproses!',
                            showConfirmButton: false,
                            timer: 2000
                        }); 
                 
                $('#ocr_text').val(data[0].text_plat);
                $('#base64img').prop('src', "data:image/jpeg;base64, "+data[0].base64_segmentation);
                $('#ocr_image').val(data[0].base64_segmentation);
                $('#url_fileupload').val(data[0].url);

            }

           $('#proses_gambar').html('<i class="glyphicon glyphicon-cog"></i> Proses');
           $('#proses_gambar').prop('disabled', false);

        },  error: function(error){
           alert("Data Gagal Ditampilkan");
           $('#proses_gambar').html('<i class="glyphicon glyphicon-cog"></i> Proses');
           $('#proses_gambar').prop('disabled', false);
        }
      });

      event.preventDefault();

    });
</script>