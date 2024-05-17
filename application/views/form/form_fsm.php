<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Form Pendaftaran - Delta Indonesia</title>
    <link href="#" rel="stylesheet" />
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
      rel="stylesheet"
    />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="<?= base_url('pendaftaran/css/style.css'); ?>" />
    <style>
      /* CSS untuk efek loading */
      .loading-container {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(255, 255, 255, 0.8);
        z-index: 9999;
        display: flex;
        flex-direction: column; /* Baris baru ditambahkan untuk tata letak vertikal */
        justify-content: center;
        align-items: center;
      }

      .loading-spinner {
        border: 8px solid #f3f3f3;
        border-top: 8px solid #3498db;
        border-radius: 50%;
        width: 50px;
        height: 50px;
        animation: spin 1s linear infinite;
      }
      @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
      }

    </style>
  </head>
  <body className="snippet-body">
    <div class="container">
      <div class="card">
        <div class="form" id="form_id">
          <div class="left-side">
            <div class="left-heading">
              <h3></h3>
            </div>
          </div>
          <div class="right-side">
            <div class="main active">
             <img src="https://deltaindo.co.id/wp-content/uploads/2018/12/delta-logo-pelatihan-k3.png" alt=""
             style="width: 160px; height: 100px;">
              <div class="text">
                <h5>Form Pendaftaran Training <?= $form; ?></h5>
                <p>Masukan Informasi Anda ke Dalam Form di Bawah ini.</p>
              </div>
              <form action="" method="post" id="myForm" enctype="multipart/form-data">
              <div class="input-text">
                <div class="input-div">
                  <input type="text" id="user_name" name="nama" require />
                  <span>Nama Peserta</span>
                </div>
                <div class="input-div">
                  <input type="text" name="ktp"  required require />
                  <span>Nomor KTP</span>
                </div>
              </div>
              <div class="input-text">
                <div class="input-div">
                  
                  <input type="text" name="tempat_lahir" required require />
                  <span>Tempat Lahir</span>
                </div>
                
                <div class="input-div">
               
                  <input type="date" name="tanggal_lahir" required require />
                  <div class="text-danger">Tanggal Lahir</div>
                </div>
                
              </div>
              <div class="input-text">
                <div class="input-div">
                  <select name="pendidikan">
                    <option>Pendidikan Terakhir</option>
                   <?php foreach($pendidikan as $p) : ?>
                    <option value="<?= $p['pendidikan'] ?>"><?= $p['pendidikan'] ?></option>
                    <?php endforeach; ?>
                   
                  </select>
                </div>
                <div class="input-div">
                  <input type="text" name="nama_sekolah" required />
                  <span>Nama Sekolah</span>
                </div>
              </div>
              <div class="input-text">
                <div class="input-div">
                  <input type="number" name="no_ijazah" required require />
                  <span>No Ijazah</span>
                </div>
                <div class="input-div">
                  <input type="date" name="tgl_ijazah" required />
                  <div class="text-danger">Tanggal Ijazah</div>
                </div>
              </div>
              <div class="input-text">
              <div class="input-div">
                  <select name="provinsi" id="provinsi" data-url="<?= base_url('form/getKab'); ?>">
                    <option>Pilih Provinsi</option>
                    <?php foreach($provinsi as $p) : ?>
                    <option id-val="<?= $p->id; ?>" value="<?= $p->name; ?>"><?= $p->name; ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <div class="input-div">
                  <select name="kabupaten" id="kabupaten" data-url="<?= base_url('form/getKecamatan'); ?>">
                    <option id-val="">Pilih Kabupaten</option>
                  </select>
                </div>
              </div>
              <div class="input-text">
              <div class="input-div">
                  <select name="kecamatan" id="kecamatan" data-url="<?= base_url('form/getKelurahan'); ?>">
                    <option id-val="">Pilih Kecamatan</option>
                  </select>
              </div>
              <div class="input-div">
                  <select name="kelurahan" id="kelurahan">
                  <option id-val="">Pilih Kelurahan</option>
                  </select>
              </div>
              </div>
              <div class="input-text">
              <div class="input-div">
                  <input type="text" name="alamat_rumah" required require />
                  <span>Alamat Rumah</span>
                </div>
              <div class="input-div">
                  <select name="golongan">
                    <option>Golongan Darah</option>
                    <option value="none">--None--</option>
                    <option value="O+">O+</option>
                    <option value="A+">A+</option>
                    <option value="B+">B+</option>
                    <option value="AB+">AB+</option>
                    <option value="O-">O-</option>
                    <option value="A-">A-</option>
                    <option value="B-">B-</option>
                    <option value="AB-">AB-</option>
                  </select>
                </div>
          
              </div>
              <div class="input-text">
              <div class="input-div">
                  <input type="text" name="wa" required require />
                  <span>No WhatsApp</span>
                </div>
              <div class="input-div">
                  <input type="text" name="email" required require />
                  <span>Email</span>
                </div>
              </div>

              <div class="buttons">
                <button class="next_button" type="button">Next Step</button>
              </div>
            </div>
            <div class="main">
            <img src="https://deltaindo.co.id/wp-content/uploads/2018/12/delta-logo-pelatihan-k3.png" alt=""
             style="width: 80px; height: 50px;">
              <div class="text">
                <h2>Perusahaan</h2>
                <p>Informasi Perusahaan Anda.</p>
              </div>
              <div class="input-text">
                <div class="input-div">
                  <input type="text" id="companyName" name="instansi" required require />
                  <span>Instansi Perusahaan</span>
                </div>
              </div>
              <div class="input-text">
                <div class="input-div">
                  <input type="text" name="sektor" required />
                  <span>Sektor Usaha Perusahaan</span>
                </div>
              </div>
              <div class="input-text">
                <div class="input-div">
                  <input type="text" name="alamat_perusahaan" required require />
                  <span>Alamat Perusahaan</span>
                </div>
                <div class="input-div">
                  <input type="text" name="jabatan" required require />
                  <span>Jabatan</span>
                </div>
              </div>
              <div class="input-text">
                <div class="input-div">
                  <input type="text" name="tlp_kantor" required require />
                  <span>No Tlp/Fax/ Email Perusahaan</span>
                </div>
              </div>
              <div class="buttons button_space">
                <button class="back_button" type="button">Back</button>
                <button class="next_button" type="button">Next Step</button>
              </div>
            </div>
            <div class="main">
            <img src="https://deltaindo.co.id/wp-content/uploads/2018/12/delta-logo-pelatihan-k3.png" alt=""
             style="width: 80px; height: 50px;">
              <div class="text">
                <h2>Dokumen</h2>
                <p class="text-danger">
                  Format Dokumen yg di upload JPG | PNG | PDF Maksimum 2 Mb
                </p>
              </div>
              <div class="input-text">
                <div class="input-div">
                  <div id="emailHelp" class="form-text">
                    Surat Pernyataan Peserta
                  </div>
                  <input
                    type="file"
                    class="form-control form-control-sm"
                    id="surat"
                    aria-describedby="emailHelp"
                    name="surat"
                    
                  />
                  <div
                    id="surat-error"
                    class="text-danger"
                    style="display: none"
                  >
                   
                  </div>
                  <a href="https://docs.google.com/document/d/1M-W2FBJ2U_DDRMNXL4K1OXcdd4pH4sQU/edit?usp=sharing&ouid=102343809879775735104&rtpof=true&sd=true" target="_blank" class="text-danger"
                    >Contoh Format Surat Pernyataan
                  </a>
                </div>
              </div>
              <div class="input-text">
                <div class="input-div">
                  <div id="emailHelp" class="form-text">Ijazah Terakhir</div>
                  <input
                    type="file"
                    class="form-control form-control-sm"
                    id="exampleInputEmail1"
                    aria-describedby="emailHelp"
                    name="ijazah"
                    
                  />
                  <div id="ijazah-error" class="text-danger" style="display: none">
                   
                  </div>
                </div>
              </div>
              <div class="input-text">
                <div class="input-div">
                  <div id="emailHelp" class="form-text">KTP</div>
                  <input
                    type="file"
                    class="form-control form-control-sm"
                    id="ktp"
                    aria-describedby="emailHelp"
                    name="ktp"
                    
                  />
                  <div id="ktp-error" class="text-danger" style="display: none">
                   
                  </div>
                </div>
              </div>
              <div class="input-text">
                <div class="input-div">
                  <div id="emailHelp" class="form-text">
                    Surat Keterangan Sehat dari Dokter
                  </div>
                  <input
                    type="file"
                    class="form-control form-control-sm"
                    id="sk"
                    aria-describedby="emailHelp"
                    name="sk"
                    
                  />
                  <div id="sk-error" class="text-danger" style="display: none">
                   
                  </div>
                </div>
              </div>
              <div class="input-text">
                <div class="input-div">
                  <div id="emailHelp" class="form-text">Pas Foto Berwarna</div>
                  <input
                    type="file"
                    class="form-control form-control-sm"
                    id="foto"
                    aria-describedby="emailHelp"
                    name="foto"
                    
                  />
                  <div
                    id="foto-error"
                    class="text-danger"
                    style="display: none"
                    
                  >
                   
                  </div>
                </div>
              </div>
              <div class="input-text">
                <div class="input-div">
                  <div id="emailHelp" class="form-text">Curiculum Vitae</div>
                  <input
                    type="file"
                    class="form-control form-control-sm"
                    id="cv"
                    aria-describedby="emailHelp"
                    name="cv"
                    
                  />
                  <div
                    id="cv-error"
                    class="text-danger"
                    style="display: none"
                    
                  >
                   
                  </div>
                </div>
              </div>
              <?php if($this->session->userdata('id_program') == 2) : ?>
              <div class="input-text">
                <div class="input-div">
                  <div id="emailHelp" class="form-text">Bukti Transfer</div>
                  <input
                    type="file"
                    class="form-control form-control-sm"
                    id="bukti_tf"
                    aria-describedby="emailHelp"
                    name="bukti"
                    required require
                  />
                  <div
                    id="bukti_tf-error"
                    class="text-danger"
                    style="display: none"
                  >
                   
                  </div>
                </div>
              </div>
              <?php endif; ?>

              <div class="buttons button_space">
                <button class="back_button" type="button">Back</button>
                <button class="submit_button" id="submitForm" type="button">Submit</button>
              </div>
              </form>
            </div>
          </div>
        </div>
        <!-- Loading -->
        <div id="loading" class="d-none" style="text-align: center;">
        <div class="loading-container">
          <div class="loading-spinner"></div>
          <p>Mohon tunggu sebentar...</p>
        </div>
      </div>
      </div>
    </div>
  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="<?= base_url('pendaftaran/js/script.js'); ?>"></script>
    <script src="<?= base_url('pendaftaran/js/jquery.js'); ?>"></script>
           
    <script>
          $(document).ready(function () {

          $("#submitForm").on("click", function () {
            var fileInputs = $(".form-control[type='file']");
          
            $("#form_id").hide();

            // Tampilkan elemen loading
            $("#loading").show();
              var formData = new FormData($("#myForm")[0]);

              $.ajax({
                  type: "POST",
                  url: "<?= base_url('form/insertData_fsm') ?>",
                  data: formData,
                  dataType: "json",
                  contentType: false,
                  processData: false,
                  success: function (response) {
                    $("#loading").hide();
                      if (response.status === 'berhasil') {
                         
                          window.location.href = "<?= base_url('form/success') ?>";
                      } else {
                          // Tampilkan pesan kesalahan jika ada
                          $("#loading").hide();
                          alert("Gagal: " + response.message);
                          location.reload(true);
                      }
                  },
                  error: function (xhr, status, error) {
                    console.log(status);
                  },
              });
          });
      });

    </script>
  </body>
</html>
