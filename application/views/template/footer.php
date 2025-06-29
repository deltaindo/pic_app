<footer class="footer">
  <div class="d-sm-flex justify-content-center justify-content-sm-between">
    <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Copyright © 2021. All rights reserved.</span>
  </div>
</footer>
<!-- partial -->
</div>
<!-- main-panel ends -->
</div>
<!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->

<!-- plugins:js -->
<script src="<?= base_url('assets/vendors/js/vendor.bundle.base.js'); ?>"></script>
<!-- endinject -->
<!-- Plugin js for this page -->

<!-- End plugin js for this page -->
<!-- inject:js -->
<!-- endinject -->
<!-- Custom js for this page-->

<script src="<?= base_url('assets/js/dashboard.js'); ?>"></script>
<script src="<?= base_url('assets/js/Chart.roundedBarCharts.js'); ?>"></script>
<!-- End custom js for this page-->
<!-- databael -->

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<!-- ckeditor -->

<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="
https://cdn.jsdelivr.net/npm/sweetalert2@11.11.0/dist/sweetalert2.all.min.js
"></script>
<script src="<?= base_url('assets/script.js'); ?>"></script>

<script>
  ClassicEditor
    .create(document.querySelector('#editor'))
    .then(editor => {
      console.log(editor);
    })
    .catch(error => {
      console.error(error);
    });
</script>
<script>
  $(document).ready(function() {
    var table = $('#example').DataTable({
      "scrollX": true, // Aktifkan scroll horizontal
      "paging": true, // Aktifkan pagination
      // ... konfigurasi DataTables lainnya
    });

    // Inisialisasi FixedColumns

    new $.fn.dataTable.FixedColumns(table, {
      leftColumns: 1, // Jumlah kolom yang akan di-frozen dari kiri
    });
  });
</script>
<script>
  $(document).ready(function() {
    // Menambahkan event click pada ikon copy
    $(".mdi-content-copy").on("click", function() {
      // Mengambil teks dari atribut data-link pada elemen <td> terkait
      var linkText = $(this).closest("td").data("link");

      // Membuat elemen textarea sementara untuk menyalin teks
      var tempTextArea = $("<textarea>");
      $("body").append(tempTextArea);

      // Menyalin teks ke textarea sementara
      tempTextArea.val(linkText).select();

      // Menyalin teks ke clipboard
      document.execCommand("copy");

      // Menghapus textarea sementara
      tempTextArea.remove();
      alert('berhasil di copy');
    });
  });
</script>
<script>
  $(document).ready(function() {
// Initialize an array to track selected dates
let selectedDates = [];

// Function to add a new date to the selectedDates array
document.getElementById("addDateButton")?.addEventListener("click", function () {
  const dateInput = document.getElementById("tanggal").value.trim();

  // Check if the date is not empty and not already in the list
  if (dateInput && !selectedDates.includes(dateInput)) {
    selectedDates.push(dateInput); // Add to the array
    updateTextarea(); // Update the textarea with the new list
    document.getElementById("tanggal").value = ""; // Clear the input field
  }
});

// Function to update the textarea based on the selectedDates array
function updateTextarea() {
  const textarea = document.getElementById("tanggalDipilih");

  if (textarea) {
    textarea.value = selectedDates.join(", "); // Update the textarea content
  }
}

// Allow manual editing of the textarea
document.getElementById("tanggalDipilih")?.addEventListener("input", function () {
  const textareaContent = document.getElementById("tanggalDipilih").value;

  // Update the selectedDates array to reflect the new content
  selectedDates = textareaContent
    .split(",")
    .map((date) => date.trim())
    .filter((date) => date !== ""); // Remove empty entries
});

// Initialize jQuery Datepicker
$(document).ready(function () {
  $("#tanggal").datepicker({
    dateFormat: "dd-mm-yy",
    showButtonPanel: true,
    beforeShow: function (input) {
      const buttonPane = $(this).datepicker("widget").find(".ui-datepicker-buttonpane");

      // Change button texts (Today -> Done, Clear -> Clear)
      buttonPane.find(".ui-datepicker-current").text("Clear");

      // Add custom Clear functionality
      $("<button class='ui-datepicker-clear ui-state-default ui-priority-primary ui-corner-all'>Clear</button>")
        .appendTo(buttonPane)
        .on("click", function () {
          $("#tanggal").datepicker("clearDate"); // Use built-in clear function
          selectedDates = []; // Clear the array
          $("#tanggalDipilih").val(""); // Clear the textarea
        });
    },
    onClose: function (dateText, inst) {
      if (dateText) {
        // Add the selected date to the array
        if (!selectedDates.includes(dateText)) {
          selectedDates.push(dateText);
          updateTextarea(); // Sync the textarea
        }
      }
    },
  });

  // Prevent datepicker close when clicking outside
  $(document).on("click", ".ui-datepicker-close", function (e) {
    e.stopPropagation(); // Prevent default behavior
  });

  // Set focus back to input element after clicking Done
  $(".ui-datepicker-close").on("mouseup", function () {
    $(this).closest(".ui-datepicker").find("input").focus();
  });
});

  }); 
</script>

<script>
  $(document).ready(function() {
    $("#genrate").on("click", function() {
      var instrukturValue = $("#instruktur").val();
      var idValue = $("#id").val();
      var linkValue = "<?php echo base_url('evaluasi/cek'); ?>?instruktur=" + encodeURIComponent(instrukturValue) + "&id=" + encodeURIComponent(idValue);
      $("#linkResult").val(linkValue)
    });
  })
</script>
<script>
  $(document).ready(function() {
    $('#idn').change(function() {
      var idnValue = $(this).find(':selected').data('id');
      $.ajax({
        type: 'POST',
        url: '<?php echo site_url("dashboard/get_ing"); ?>',
        data: {
          idn: idnValue
        },
        success: function(response) {
          $('#ing').html(response);
        }
      });
    });
  });
</script>
<script>
  $(document).ready(function() {
    // Ketika tombol "Urutkan Angka" diklik
    $('#urutkanAngkaBtn').on('click', function() {
      // Ambil nilai sertifikat dari input pertama
      var sertifikatValue = $('.sertifikat').first().val();

      // Update nomor sertifikat pada setiap input
      $('.sertifikat').val(sertifikatValue);

      // Ambil nomor terakhir yang dimasukkan pengguna di input pertama
      var firstNoSertifikat = parseInt($('.no_sertifikat').first().val()) || 0;

      // Jika nomor terakhir yang dimasukkan pengguna valid
      if (!isNaN(firstNoSertifikat)) {
        // Update nomor sertifikat pada setiap input
        $('.no_sertifikat').each(function(i) {
          $(this).val(firstNoSertifikat + i);
        });
      }
    });

    // Ketika input sertifikat berubah
    $('.sertifikat').on('input', function() {
      // Cari input no_sertifikat berikutnya di dalam row saat ini
      var nextNoSertifikatInput = $(this).closest('.row').next().find('.no_sertifikat');

      // Jika input sertifikat diisi
      if ($(this).val().trim() !== '') {
        // Ambil nomor terakhir dari input no_sertifikat yang diisi
        var lastNumber = parseInt(nextNoSertifikatInput.val()) || 0;

        // Tambahkan 1 ke nomor terakhir dan isi ke input no_sertifikat berikutnya
        nextNoSertifikatInput.val(lastNumber + 1);
      }
    });
  });
</script>

<script>
  function deleteDataJenisAlat(id) {
    Swal.fire({
      title: "Are you sure?",
      text: "You won't be able to revert this!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, delete it!"
    }).then((result) => {
      if (result.isConfirmed) {
        Swal.fire({
          showConfirmButton: false,
          title: "Deleted!",
          text: "Your file has been deleted.",
          icon: "success",
          timer: 2000
        });
        window.location.href = `<?= base_url('/dashboard/delete_jenis_alat/') ?>${id}`;
      }
    });
  }
</script>

<script>
  function deleteKelasPembina(id) {
    Swal.fire({
      title: "Are you sure?",
      text: "You won't be able to revert this!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, delete it!"
    }).then((result) => {
      if (result.isConfirmed) {
        Swal.fire({
          showConfirmButton: false,
          title: "Deleted!",
          text: "Your file has been deleted.",
          icon: "success",
          timer: 2000
        });
        window.location.href = `<?= base_url('/dashboard/delete_kelas_pembina/') ?>${id}`;
      }
    });
  }
</script>

<script>
  function deleteKelas(id) {
    Swal.fire({
      title: "Are you sure?",
      text: "You won't be able to revert this!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, delete it!"
    }).then((result) => {
      if (result.isConfirmed) {
        Swal.fire({
          showConfirmButton: false,
          title: "Deleted!",
          text: "Your file has been deleted.",
          icon: "success",
          timer: 2000
        });
        window.location.href = `<?= base_url('/dashboard/delete_kelas/') ?>${id}`;
      }
    });
  }
</script>

<script>
  function deleteTraining(id) {
    Swal.fire({
      title: "Are you sure?",
      text: "You won't be able to revert this!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, delete it!"
    }).then((result) => {
      if (result.isConfirmed) {
        Swal.fire({
          showConfirmButton: false,
          title: "Deleted!",
          text: "Your file has been deleted.",
          icon: "success",
          timer: 2000
        });
        window.location.href = `<?= base_url('/dashboard/delete_training/') ?>${id}`;
      }
    });
  }
</script>

<script>
  function deleteBidang(id) {
    Swal.fire({
      title: "Are you sure?",
      text: "You won't be able to revert this!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, delete it!"
    }).then((result) => {
      if (result.isConfirmed) {
        Swal.fire({
          showConfirmButton: false,
          title: "Deleted!",
          text: "Your file has been deleted.",
          icon: "success",
          timer: 2000
        });
        window.location.href = `<?= base_url('/dashboard/delete_bidang/') ?>${id}`;
      }
    });
  }
</script>

<script>
  function deleteSertIndo(id) {
    Swal.fire({
      title: "Are you sure?",
      text: "You won't be able to revert this!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, delete it!"
    }).then((result) => {
      if (result.isConfirmed) {
        Swal.fire({
          showConfirmButton: false,
          title: "Deleted!",
          text: "Your file has been deleted.",
          icon: "success",
          timer: 2000
        });
        window.location.href = `<?= base_url('/dashboard/delete_sertifikat_indonesia/') ?>${id}`;
      }
    });
  }
</script>

<script>
  function deleteJenisPersonil(id) {
    Swal.fire({
      title: "Are you sure?",
      text: "You won't be able to revert this!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, delete it!"
    }).then((result) => {
      if (result.isConfirmed) {
        Swal.fire({
          showConfirmButton: false,
          title: "Deleted!",
          text: "Your file has been deleted.",
          icon: "success",
          timer: 2000
        });
        window.location.href = `<?= base_url('/dashboard/delete_jenis_personil/') ?>${id}`;
      }
    });
  }
</script>

<script>
  function deleteBulkJenisPersonil() {
    Swal.fire({
      title: "Are you sure?",
      text: "You won't be able to revert this!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, delete it!"
    }).then((result) => {
      if (result.isConfirmed) {
        Swal.fire({
          showConfirmButton: false,
          title: "Deleted!",
          text: "Your file has been deleted.",
          icon: "success",
          timer: 2000
        });
        window.location.href = `<?= base_url('dashboard/hapus_bulk_jenis_personil') ?>`;
      }
    });
  }
</script>

<script>
  function deleteBulkJenisPersonil() {
    Swal.fire({
      title: "Are you sure?",
      text: "You won't be able to revert this!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, delete it!"
    }).then((result) => {
      if (result.isConfirmed) {
        document.getElementById('bulk-delete-form').submit();
      }
    });
  }

  document.getElementById('check-all').addEventListener('click', function() {
    let checkboxes = document.querySelectorAll('.form-check-input.check');
    for (let checkbox of checkboxes) {
      checkbox.checked = this.checked;
    }
  });
</script>

<script>
  function deleteJenisPendidikan(id) {
    Swal.fire({
      title: "Are you sure?",
      text: "You won't be able to revert this!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, delete it!"
    }).then((result) => {
      if (result.isConfirmed) {
        Swal.fire({
          showConfirmButton: false,
          title: "Deleted!",
          text: "Your file has been deleted.",
          icon: "success",
          timer: 2000
        });
        window.location.href = `<?= base_url('/dashboard/delete_jenis_pendidikan/') ?>${id}`;
      }
    });
  }
</script>

<script>
  function deleteBulkJenisPendidikan() {
    Swal.fire({
      title: "Are you sure?",
      text: "You won't be able to revert this!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, delete it!"
    }).then((result) => {
      if (result.isConfirmed) {
        document.getElementById('bulk-delete-form').submit();
      }
    });
  }

  document.getElementById('check-all').addEventListener('click', function() {
    let checkboxes = document.querySelectorAll('.form-check-input.check');
    for (let checkbox of checkboxes) {
      checkbox.checked = this.checked;
    }
  });
</script>

<script>
  function deleteBulkJenisAlat() {
    Swal.fire({
      title: "Are you sure?",
      text: "You won't be able to revert this!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, delete it!"
    }).then((result) => {
      if (result.isConfirmed) {
        document.getElementById('bulk-delete-form').submit();
      }
    });
  }

  document.getElementById('check-all').addEventListener('click', function() {
    let checkboxes = document.querySelectorAll('.form-check-input.check');
    for (let checkbox of checkboxes) {
      checkbox.checked = this.checked;
    }
  });
</script>

<script>
  function deleteBulkDaftarTraining() {
    Swal.fire({
      title: "Are you sure?",
      text: "You won't be able to revert this!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, delete it!"
    }).then((result) => {
      if (result.isConfirmed) {
        document.getElementById('bulk-delete-form').submit();
      }
    });
  }

  document.getElementById('check-all').addEventListener('click', function() {
    let checkboxes = document.querySelectorAll('.form-check-input.check');
    for (let checkbox of checkboxes) {
      checkbox.checked = this.checked;
    }
  });
</script>

<script>
  function deleteBulkKelasPembina() {
    Swal.fire({
      title: "Are you sure?",
      text: "You won't be able to revert this!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, delete it!"
    }).then((result) => {
      if (result.isConfirmed) {
        document.getElementById('bulk-delete-form').submit();
      }
    });
  }

  document.getElementById('check-all').addEventListener('click', function() {
    let checkboxes = document.querySelectorAll('.form-check-input.check');
    for (let checkbox of checkboxes) {
      checkbox.checked = this.checked;
    }
  });
</script>

<script>
  function deleteBulkDataKelas() {
    Swal.fire({
      title: "Are you sure?",
      text: "You won't be able to revert this!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, delete it!"
    }).then((result) => {
      if (result.isConfirmed) {
        document.getElementById('bulk-delete-form').submit();
      }
    });
  }

  document.getElementById('check-all').addEventListener('click', function() {
    let checkboxes = document.querySelectorAll('.form-check-input.check');
    for (let checkbox of checkboxes) {
      checkbox.checked = this.checked;
    }
  });
</script>

<script>
  function deleteBulkJenisBidang() {
    Swal.fire({
      title: "Are you sure?",
      text: "You won't be able to revert this!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, delete it!"
    }).then((result) => {
      if (result.isConfirmed) {
        document.getElementById('bulk-delete-form').submit();
      }
    });
  }

  document.getElementById('check-all').addEventListener('click', function() {
    let checkboxes = document.querySelectorAll('.form-check-input.check');
    for (let checkbox of checkboxes) {
      checkbox.checked = this.checked;
    }
  });
</script>

<script>
  function deleteBulkSertifikatIndonesia() {
    Swal.fire({
      title: "Are you sure?",
      text: "You won't be able to revert this!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, delete it!"
    }).then((result) => {
      if (result.isConfirmed) {
        document.getElementById('bulk-delete-form').submit();
      }
    });
  }

  document.getElementById('check-all').addEventListener('click', function() {
    let checkboxes = document.querySelectorAll('.form-check-input.check');
    for (let checkbox of checkboxes) {
      checkbox.checked = this.checked;
    }
  });
</script>

<script>
  function deleteAdmin(id) {
    Swal.fire({
      title: "Are you sure?",
      text: "You won't be able to revert this!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, delete it!"
    }).then((result) => {
      if (result.isConfirmed) {
        Swal.fire({
          showConfirmButton: false,
          title: "Deleted!",
          text: "Your file has been deleted.",
          icon: "success",
          timer: 2000
        });
        window.location.href = `<?= base_url('/dashboard/delete_admin/') ?>${id}`;
      }
    });
  }
</script>

<script>
  function deleteBulkDataAdmin() {
    Swal.fire({
      title: "Are you sure?",
      text: "You won't be able to revert this!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, delete it!"
    }).then((result) => {
      if (result.isConfirmed) {
        document.getElementById('bulk-delete-form').submit();
      }
    });
  }

  document.getElementById('check-all').addEventListener('click', function() {
    let checkboxes = document.querySelectorAll('.form-check-input.check');
    for (let checkbox of checkboxes) {
      checkbox.checked = this.checked;
    }
  });
</script>

<script>
  function deleteSertifikatIng(id) {
    Swal.fire({
      title: "Are you sure?",
      text: "You won't be able to revert this!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, delete it!"
    }).then((result) => {
      if (result.isConfirmed) {
        Swal.fire({
          showConfirmButton: false,
          title: "Deleted!",
          text: "Your file has been deleted.",
          icon: "success",
          timer: 2000
        });
        window.location.href = `<?= base_url('/dashboard/delete_sertifikat_ing/') ?>${id}`;
      }
    });
  }
</script>

<script>
  function deleteKelasTraining(id) {
    Swal.fire({
      title: "Are you sure?",
      text: "You won't be able to revert this!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, delete it!"
    }).then((result) => {
      if (result.isConfirmed) {
        Swal.fire({
          showConfirmButton: false,
          title: "Deleted!",
          text: "Your file has been deleted.",
          icon: "success",
          timer: 2000
        });
        window.location.href = `<?= base_url('/dashboard/delete_kelas_training/') ?>${id}`;
      }
    });
  }
</script>

<script>
  function deleteBulkDataKelasTraining() {
    Swal.fire({
      title: "Are you sure?",
      text: "You won't be able to revert this!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, delete it!"
    }).then((result) => {
      if (result.isConfirmed) {
        document.getElementById('bulk-delete-form').submit();
      }
    });
  }

  document.getElementById('check-all').addEventListener('click', function() {
    let checkboxes = document.querySelectorAll('.form-check-input.check');
    for (let checkbox of checkboxes) {
      checkbox.checked = this.checked;
    }
  });
</script>

<script>
  function deleteKelompokPembinaan(id) {
    Swal.fire({
      title: "Are you sure?",
      text: "You won't be able to revert this!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, delete it!"
    }).then((result) => {
      if (result.isConfirmed) {
        Swal.fire({
          showConfirmButton: false,
          title: "Deleted!",
          text: "Your file has been deleted.",
          icon: "success",
          timer: 2000
        });
        window.location.href = `<?= base_url('/dashboard/delete_kelompok_pembinan/') ?>${id}`;
      }
    });
  }
</script>

<script>
  function deleteMasterKelompokPembinaan(id) {
    Swal.fire({
      title: "Are you sure?",
      text: "You won't be able to revert this!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, delete it!"
    }).then((result) => {
      if (result.isConfirmed) {
        Swal.fire({
          showConfirmButton: false,
          title: "Deleted!",
          text: "Your file has been deleted.",
          icon: "success",
          timer: 2000
        });
        window.location.href = `<?= base_url('/dashboard/delete_master_kelompok_pembinaan/') ?>${id}`;
      }
    });
  }
</script>

<script>
  function deleteBulkMasterKelompokPembinaan() {
    Swal.fire({
      title: "Are you sure?",
      text: "You won't be able to revert this!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, delete it!"
    }).then((result) => {
      if (result.isConfirmed) {
        document.getElementById('bulk-delete-form').submit();
      }
    });
  }

  document.getElementById('check-all').addEventListener('click', function() {
    let checkboxes = document.querySelectorAll('.form-check-input.check');
    for (let checkbox of checkboxes) {
      checkbox.checked = this.checked;
    }
  });
</script>

<script>
  function deleteKelompokAlatPembinaan(id) {
    Swal.fire({
      title: "Are you sure?",
      text: "You won't be able to revert this!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, delete it!"
    }).then((result) => {
      if (result.isConfirmed) {
        Swal.fire({
          showConfirmButton: false,
          title: "Deleted!",
          text: "Your file has been deleted.",
          icon: "success",
          timer: 2000
        });
        window.location.href = `<?= base_url('/dashboard/delete_kelompok_alat_pembinan/') ?>${id}`;
      }
    });
  }
</script>

<script>
  function deleteBulkAlatKelompokPembinaan() {
    Swal.fire({
      title: "Are you sure?",
      text: "You won't be able to revert this!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, delete it!"
    }).then((result) => {
      if (result.isConfirmed) {
        document.getElementById('bulk-delete-form').submit();
      }
    });
  }

  document.getElementById('check-all').addEventListener('click', function() {
    let checkboxes = document.querySelectorAll('.form-check-input.check');
    for (let checkbox of checkboxes) {
      checkbox.checked = this.checked;
    }
  });
</script>

<script>
  function deleteBidangPersonil(id) {
    Swal.fire({
      title: "Are you sure?",
      text: "You won't be able to revert this!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, delete it!"
    }).then((result) => {
      if (result.isConfirmed) {
        Swal.fire({
          showConfirmButton: false,
          title: "Deleted!",
          text: "Your file has been deleted.",
          icon: "success",
          timer: 2000
        });
        window.location.href = `<?= base_url('/dashboard/delete_bidang_personil/') ?>${id}`;
      }
    });
  }
</script>

<script>
  function deleteBulkBidangPersonil() {
    Swal.fire({
      title: "Are you sure?",
      text: "You won't be able to revert this!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, delete it!"
    }).then((result) => {
      if (result.isConfirmed) {
        document.getElementById('bulk-delete-form').submit();
      }
    });
  }

  document.getElementById('check-all').addEventListener('click', function() {
    let checkboxes = document.querySelectorAll('.form-check-input.check');
    for (let checkbox of checkboxes) {
      checkbox.checked = this.checked;
    }
  });
</script>

<script>
  function deleteKelasPendidikanTerakhir(id) {
    Swal.fire({
      title: "Are you sure?",
      text: "You won't be able to revert this!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, delete it!"
    }).then((result) => {
      if (result.isConfirmed) {
        Swal.fire({
          showConfirmButton: false,
          title: "Deleted!",
          text: "Your file has been deleted.",
          icon: "success",
          timer: 2000
        });
        window.location.href = `<?= base_url('/dashboard/delete_kelas_pendidikan_terakhir/') ?>${id}`;
      }
    });
  }
</script>

<script>
  function deleteBulkKelasPendidikanTerakhir() {
    Swal.fire({
      title: "Are you sure?",
      text: "You won't be able to revert this!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, delete it!"
    }).then((result) => {
      if (result.isConfirmed) {
        document.getElementById('bulk-delete-form').submit();
      }
    });
  }

  document.getElementById('check-all').addEventListener('click', function() {
    let checkboxes = document.querySelectorAll('.form-check-input.check');
    for (let checkbox of checkboxes) {
      checkbox.checked = this.checked;
    }
  });
</script>
</body>

</html>