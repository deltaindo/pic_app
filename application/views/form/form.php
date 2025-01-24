<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="shortcut icon" href="<?= base_url('assets/images/logo-delta.png'); ?>" />
    <title>Delta Indonesia | Kelengkapan Dokumen</title>
  </head>
  <body>

    <section class="form pt-5 pb-5 mb-5" style="margin-top: 150px;">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-6 col-sm-12">
            <div class="card card-pencarian">
              <div class="card-body">
                <h3 class="text-center judul mb-4">Cek Kelengkapan Dokumen</h3>
                <?= $this->session->flashdata('message'); ?>
                <form method="post" action="<?= base_url('dokumen/updatePeserta'); ?>" enctype="multipart/form-data">
                  <input type="hidden" value="<?= $id ?>" name="id">
                  <?php if (is_array($field) && !empty($field)) : ?>
                      <?php foreach ($field as $f) : ?>
                          <div class="mb-3">
                              <label for="<?= $f ?>" class="form-label"><?= custom_label($f) ?></label>
                              <input type="file" class="form-control" id="<?= $f ?>" name="<?= $f ?>">
                              <span id="<?= $f ?>Error" class="text-danger"></span>
                          </div>
                      <?php endforeach; ?>
                  <?php else : ?>
                      <p>No data available</p>
                  <?php endif; ?>
                  <button type="submit" id="submitBtn" class="btn btn-primary">Upload Dokumen</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
      $(document).ready(function () {
        $('input[type="file"]').change(function () {
          var fileInput = $(this);
          var file = fileInput[0].files[0];
          var allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'application/pdf'];
          var maxFileSize = 2 * 1024 * 1024; // 2MB
          var fieldName = fileInput.attr('name');
          var errorSpan = $('#' + fieldName + 'Error');
          var errorDetected = false;

          if (file) {
            var fileSize = file.size;
            var fileType = file.type;

            if ($.inArray(fileType, allowedTypes) === -1) {
              errorSpan.text('File harus berupa PDF, PNG, JPG, atau JPEG.');
              fileInput.val('');
              errorDetected = true;
            } else if (fileSize > maxFileSize) {
              errorSpan.text('Ukuran file tidak boleh lebih dari 2MB.');
              fileInput.val('');
              errorDetected = true;
            } else {
              errorSpan.text('');
            }
          } else {
            errorSpan.text('');
          }

          if (errorDetected) {
            $('#submitBtn').hide();
          } else {
            $('#submitBtn').show();
          }
        });
      });
    </script>
  </body>
</html>
