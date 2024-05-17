function validateFileSizeAndFormat(inputId, maxSizeInBytes, allowedFormats) {
	const input = document.getElementById(inputId);
	const files = input.files;

	if (files.length > 0) {
		const fileSize = files[0].size;
		const fileName = files[0].name;
		const fileExtension = fileName.split(".").pop().toLowerCase();

		if (fileSize > maxSizeInBytes) {
			$(".submit_button").hide();
			$(`#${inputId}-error`).text("File lebih dari 2 MB.").show();
		} else if (!allowedFormats.includes(fileExtension)) {
			$(".submit_button").hide();
			$(`#${inputId}-error`).text("Format file tidak diizinkan.").show();
		} else {
			$(".submit_button").show();
			$(`#${inputId}-error`).hide();
		}
	}
}

$(".form-control").change(function () {
	const id = $(this).attr("id");
	validateFileSizeAndFormat(id, 2 * 1024 * 1024, ["jpg", "jpeg", "png", "pdf"]); // Hanya format yang diizinkan
});

$(document).ready(function () {
	// Deteksi perubahan pada dropdown provinsi
	$("#provinsi").change(function () {
		var selectedProvinsi = $(this).find("option:selected").attr("id-val");
		var url = $(this).data("url");
		// Lakukan permintaan AJAX ke server Anda untuk mendapatkan kabupaten
		$.ajax({
			url: url + "/" + selectedProvinsi, // Sesuaikan dengan URL controller Anda
			type: "GET",
			success: function (data) {
				// Hapus semua opsi kabupaten sebelumnya
				$("#kabupaten").empty();

				// Tambahkan opsi kabupaten berdasarkan data yang diterima
				$.each(data, function (key, value) {
					$("#kabupaten").append(
						'<option value="' +
							value.name +
							'" id-val="' +
							value.id +
							'">' +
							value.name +
							"</option>"
					);
				});
			},
			error: function () {
				console.log("Gagal mengambil data kabupaten.");
			},
		});
	});

	// get kabupaten
	$("#kabupaten").change(function () {
		var selectedKec = $(this).find("option:selected").attr("id-val");
		var url = $(this).data("url");
		// Lakukan permintaan AJAX ke server Anda untuk mendapatkan kabupaten
		$.ajax({
			url: url + "/" + selectedKec, // Sesuaikan dengan URL controller Anda
			type: "GET",
			success: function (data) {
				// Hapus semua opsi kabupaten sebelumnya
				$("#kecamatan").empty();

				// Tambahkan opsi kabupaten berdasarkan data yang diterima
				$.each(data, function (key, value) {
					$("#kecamatan").append(
						'<option value="' +
							value.name +
							'" id-val="' +
							value.id +
							'">' +
							value.name +
							"</option>"
					);
				});
			},
			error: function () {
				console.log("Gagal mengambil data kabupaten.");
			},
		});
	});

	// get Kecamatan
	$("#kecamatan").change(function () {
		var selectedKec = $(this).find("option:selected").attr("id-val");
		var url = $(this).data("url");
		// Lakukan permintaan AJAX ke server Anda untuk mendapatkan kabupaten
		$.ajax({
			url: url + "/" + selectedKec, // Sesuaikan dengan URL controller Anda
			type: "GET",
			success: function (data) {
				// Hapus semua opsi kabupaten sebelumnya
				$("#kelurahan").empty();

				// Tambahkan opsi kabupaten berdasarkan data yang diterima
				$.each(data, function (key, value) {
					$("#kelurahan").append(
						'<option value="' +
							value.name +
							'" id-val="' +
							value.id +
							'">' +
							value.name +
							"</option>"
					);
				});
			},
			error: function () {
				console.log("Gagal mengambil data kabupaten.");
			},
		});
	});
});

// $("#ktp").on("keypress", function (e) {
// 	var value = $(this).val();
// 	if (value.length >= 17) {
// 		// Jika panjang input sudah mencapai 13 karakter, mencegah penambahan karakter
// 		e.preventDefault();
// 	}
// });
