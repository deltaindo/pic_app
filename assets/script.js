$(".js-example-basic-single").select2();
$("#check-all").click(function () {
	if ($(this).is(":checked")) {
		$(".check").prop("checked", true);
	} else {
		$(".check").prop("checked", false);
	}
});
// Ambil elemen tombol "Tambah"
$("#sertifikat").click(function () {
	var url = $(this).data("url");
	var call = $(this).data("call");
	var id = [];
	$('input[name="id[]"]:checked').each(function () {
		id.push($(this).val());
	});

	kirim_sertifikat(id, url, call);
});

$("#ulasan").click(function () {
	var url = $(this).data("url");

	var id = [];
	$('input[name="id[]"]:checked').each(function () {
		id.push($(this).val());
	});

	ulasan(id, url);
});

$("#hapus-form").click(function (e) {
	e.preventDefault();
	var url = $(this).data("url");
	var id = [];
	$('input[name="id[]"]:checked').each(function () {
		id.push($(this).val());
	});
	deleteData(id, url);
});

$("#hapus-data").click(function (e) {
	e.preventDefault();
	var url = $(this).data("url");
	var id = [];
	$('input[name="id[]"]:checked').each(function () {
		id.push($(this).val());
	});
	deleteData(id, url);
});

$("#hapus-pembina").click(function (e) {
	e.preventDefault();
	var url = $(this).data("url");
	var id = [];
	$('input[name="id[]"]:checked').each(function () {
		id.push($(this).val());
	});
	deleteData(id, url);
});

function deleteData(id, url) {
	if (id.length > 0) {
		$.ajax({
			url: url,
			method: "post",
			data: { id: id },
			success: function (response) {
				alert("Data Berhasil Di Hapus");
				location.reload();
			},
		});
	}
}

function kirim_sertifikat(id, url, call) {
	if (id.length > 0) {
		$.ajax({
			url: url,
			method: "post",
			data: { id: id },
			success: function (response) {
				console.log(response);
				// Arahkan pengguna ke halaman dashboard/cetak
				window.location.href = call; // Jika 'url' sesuai dengan rute dashboard/cetak
			},
			error: function (xhr, status, error) {
				console.error(error);
			},
		});
	} else {
		alert("Pilih Dulu Orangnya Yak🤭");
	}
}

function ulasan(id, url) {
	if (id.length > 0) {
		$.ajax({
			url: url,
			method: "post",
			data: { id: id },
			success: function (response) {
				alert(response);
			},
			error: function (xhr, status, error) {
				console.error(error);
			},
		});
	} else {
		alert("Pilih Dulu Orangnya Yak🤭");
	}
}

$(document).ready(function () {
	// Menampilkan modal saat tombol ditekan
	$("#showModal").click(function () {
		$("#pesan").modal("show");
	});

	// Mengirim pesan ketika tombol "Kirim" di modal ditekan
	$("#kirimPesan").click(function () {
		var pesan = $("#notif").val();
		var url = $(this).data("url");
		var checkedIds = [];

		// Mengumpulkan semua ID yang dicentang
		$("input[name='id[]']:checked").each(function () {
			checkedIds.push($(this).val());
		});

		// Kirim data pesan dan ID yang dicentang ke server menggunakan AJAX
		$.ajax({
			type: "POST",
			url: url, // Ganti dengan URL aksi CI3 Anda
			data: { pesan: pesan, ids: checkedIds },
			success: function (response) {
				// Handle respons dari server jika diperlukan
				alert(response);
				$("#pesan").modal("hide");
			},
			error: function (xhr, textStatus, errorThrown) {
				// Handle error jika ada
				alert("Terjadi kesalahan: " + errorThrown);
			},
		});
	});
});

$(document).ready(function () {
	$("#training").change(function () {
		var selectKel = $(this).find("option:selected").attr("id-val");

		var url = $(this).data("url");

		$.ajax({
			url: url + "/" + selectKel, // Sesuaikan dengan URL controller Anda
			type: "GET",
			success: function (data) {
				// Hapus semua opsi kabupaten sebelumnya
				$("#kelas").empty();
				// Tambahkan opsi kabupaten berdasarkan data yang diterima
				$.each(data, function (key, value) {
					$("#kelas").append(
						'<option value="' +
							value.jenis_personil +
							'" id-kel="' +
							value.id +
							'">' +
							value.jenis_personil +
							"</option>"
					);
				});
			},
			error: function () {
				console.log("Gagal mengambil data Kelas.");
			},
		});
	});
});

$(document).ready(function () {
	$("#kelas").change(function () {
		var selectKel = $("#training option:selected").attr("id-val");
		var kelas = $(this).find("option:selected").attr("id-kel");
		var url = $(this).data("url");

		$.ajax({
			url: url + "/" + selectKel + "/" + kelas, // Sesuaikan dengan URL controller Anda
			type: "GET",
			success: function (data) {
				// Hapus semua opsi kabupaten sebelumnya
				$("#pembinaan").empty();
				// Tambahkan opsi kabupaten berdasarkan data yang diterima
				$.each(data, function (key, value) {
					$("#pembinaan").append(
						'<option value="' +
							value.kelompok_pembinaan +
							'" id-val="' +
							value.id +
							'">' +
							value.kelompok_pembinaan +
							"</option>"
					);
				});
			},
			error: function () {
				console.log("Gagal mengambil data Kelas.");
			},
		});
	});
});

$(document).ready(function () {
	$("#pembinaan").change(function () {
		var selectKel = $(this).find("option:selected").attr("id-val");
		var url = $(this).data("url");

		$.ajax({
			url: url + "/" + selectKel, // Sesuaikan dengan URL controller Anda
			type: "GET",
			success: function (data) {
				// Hapus semua opsi kabupaten sebelumnya
				$("#alat").empty();
				// Tambahkan opsi kabupaten berdasarkan data yang diterima
				$.each(data, function (key, value) {
					$("#alat").append(
						'<option value="' +
							value.jenis_alat +
							'" id-kel="' +
							value.id +
							'">' +
							value.jenis_alat +
							"</option>"
					);
				});
			},
			error: function () {
				console.log("Gagal mengambil data Kelas.");
			},
		});
	});
});

$(document).ready(function () {
	$("#buat").click(function () {
		var form = $("#form").serialize();
		var url = $("#form").attr("action");
		var checkedIds = [];

		var noSertifikat = $("#no_sertifikat").val();
		var idProgram = $("#id_program").val();
		var idProgramIng = $("#id_program_ing").val();
		var tanggalPelaksanaan = $("#tanggal_pelaksanaan").val();
		var tanggalPelaksanaanIng = $("#tanggal_pelaksanaan_ing").val();
		var tanggalIjazah = $("#tanggal_ijazah").val();
		var tanggalIjazahIng = $("#tanggal_ijazah_ing").val();

		// Mengumpulkan semua ID yang dicentang
		$("input[name='id[]']:checked").each(function () {
			checkedIds.push($(this).val());
		});

		$.ajax({
			url: url,
			type: "POST",
			data: {
				id: checkedIds,
				no_sertifikat: noSertifikat,
				id_program: idProgram,
				id_program_ing: idProgramIng,
				tanggal_pelaksanaan: tanggalPelaksanaan,
				tanggal_pelaksanaan_ing: tanggalPelaksanaanIng,
				tanggal_ijazah: tanggalIjazah,
				tanggal_ijazah_ing: tanggalIjazahIng,
			},
			success: function (response) {
				console.log(response);
			},
			error: function (xhr, textStatus, errorThrown) {
				// Handle error jika ada
				alert("Terjadi kesalahan: " + errorThrown);
			},
		});
	});
});
