<?php

class Database extends CI_Model
{

  /**
   * Retrieves data from the 'pendaftaran' and 'dokumen_pendaftaran' tables based on the given ID.
   *
   * @param int $id The ID used to filter the data.
   * @return array An array containing the retrieved data.
   */
  public function getDataPeserta($id)
  {
    $this->db->select('*');
    $this->db->from('pendaftaran');
    $this->db->join('dokumen_pendaftaran', 'pendaftaran.id = dokumen_pendaftaran.id_user', 'left'); // Menggunakan left join
    $this->db->where('pendaftaran.id_form', $id); // Filter berdasarkan id_pendaftaran
    $query = $this->db->get();
    return $query->result_array();
  }

  /**
   * Retrieves data from the 'form' and 'user' tables, joining them on the 'id_user' column.
   *
   * @return array An array of the retrieved data.
   */
  public function getForm()
  {
    $this->db->select('form.*, user.nama AS nama');
    $this->db->from('form');
    $this->db->join('user', 'form.id_user = user.id', 'left'); // Sesuaikan dengan nama kolom yang sesuai di tabel form dan user
    $this->db->order_by('form.tanggal_pembuatan', 'desc');
    $data = $this->db->get()->result_array();
    return $data;
  }

  /**
   * Retrieves data from the 'jenis_alat' table based on the given ID.
   *
   * @param int $id The ID used to filter the data.
   * @return array An array containing the retrieved data.
   */
  public function getDataJenisAlat($id)
  {
    $this->db->select('jenis_alat.*');
    $this->db->from('jenis_alat');
    $this->db->where('id', $id);
    return $this->db->get()->result_array();
  }

  /**
   * Retrieves data from the 'kelas_pembina' table based on the given ID.
   *
   * @param int $id The ID used to filter the data.
   * @return array An array containing the retrieved data from the 'kelas_pembina' table.
   */
  public function getDataKelas($id)
  {
    $this->db->select('kelas_pembina.*');
    $this->db->from('kelas_pembina');
    $this->db->where('id', $id);
    return $this->db->get()->result_array();
  }

  /**
   * Retrieves data from the 'kelas' table based on the given ID.
   *
   * @param int $id The ID used to filter the data.
   * @return array An array containing the retrieved data from the 'kelas' table.
   */
  public function dataKelas($id)
  {
    $this->db->select('kelas.*');
    $this->db->from('kelas');
    $this->db->where('id', $id);
    return $this->db->get()->result_array();
  }

  /**
   * Retrieves data from the 'training' table based on the given ID.
   *
   * @param int $id The ID used to filter the data.
   * @return array An array containing the retrieved data from the 'training' table.
   */
  public function dataTraining($id)
  {
    $this->db->select('training.*');
    $this->db->from('training');
    $this->db->where('id', $id);
    return $this->db->get()->result_array();
  }

  /**
   * Retrieves all data from the 'training' table.
   *
   * This function selects all columns from the 'training' table and retrieves
   * the data in descending order based on the 'id' column. The retrieved data
   * is returned as an array.
   *
   * @return array An array containing all the data from the 'training' table.
   */
  public function semuaDataTraining()
  {
    $this->db->select('training.*');
    $this->db->from('training');
    $this->db->order_by('id', 'DESC');
    return $this->db->get()->result_array();
  }

  /**
   * Retrieves all data from the 'kelas' table.
   *
   * This function selects all columns from the 'kelas' table and retrieves
   * the data in descending order based on the 'id' column. The retrieved data
   * is returned as an array.
   *
   * @return array An array containing all the data from the 'kelas' table.
   */
  public function semuaDataKelas()
  {
    $this->db->select('kelas.*');
    $this->db->from('kelas');
    $this->db->order_by('id', 'DESC');
    return $this->db->get()->result_array();
  }

  /**
   * Retrieves all data from the 'kelompok_pembinaan' table.
   *
   * This function selects all columns from the 'kelompok_pembinaan' table and retrieves
   * the data in descending order based on the 'id' column. The retrieved data
   * is returned as an array.
   *
   * @return array An array containing all the data from the 'kelompok_pembinaan' table.
   */
  public function semuaKelompokPembinaan()
  {
    $this->db->select('kelompok_pembinaan.*');
    $this->db->from('kelompok_pembinaan');
    $this->db->order_by('id', 'DESC');
    return $this->db->get()->result_array();
  }

  /**
   * Retrieves all data from the 'bidang' table.
   *
   * This function selects all columns from the 'bidang' table and retrieves
   * the data in descending order based on the 'id' column. The retrieved data
   * is returned as an array.
   *
   * @return array An array containing all the data from the 'bidang' table.
   */
  public function semuaBidang()
  {
    $this->db->select('bidang.*');
    $this->db->from('bidang');
    $this->db->order_by('id', 'DESC');
    return $this->db->get()->result_array();
  }

  /**
   * Retrieves all data from the 'jenis_personil' table.
   *
   * This function selects all columns from the 'jenis_personil' table and retrieves
   * the data in descending order based on the 'id' column. The retrieved data
   * is returned as an array.
   *
   * @return array An array containing all the data from the 'jenis_personil' table.
   */
  public function semuaJenisPersonil()
  {
    $this->db->select('jenis_personil.*');
    $this->db->from('jenis_personil');
    $this->db->order_by('id', 'DESC');
    return $this->db->get()->result_array();
  }

  /**
   * Retrieves all data from the 'jenis_alat' table.
   *
   * This function selects all columns from the 'jenis_alat' table and retrieves
   * the data in descending order based on the 'id' column. The retrieved data
   * is returned as an array.
   *
   * @return array An array containing all the data from the 'jenis_alat' table.
   */
  public function semuaJenisAlat()
  {
    $this->db->select('jenis_alat.*');
    $this->db->from('jenis_alat');
    $this->db->order_by('id', 'DESC');
    return $this->db->get()->result_array();
  }

  /**
   * Retrieves all data from the 'pendidikan' table.
   *
   * This function selects all columns from the 'pendidikan' table and retrieves
   * the data in descending order based on the 'id' column. The retrieved data
   * is returned as an array.
   *
   * @return array An array containing all the data from the 'pendidikan' table.
   */
  public function semuaDataPendidikan()
  {
    $this->db->select('pendidikan.*');
    $this->db->from('pendidikan');
    $this->db->order_by('id', 'DESC');
    return $this->db->get()->result_array();
  }

  /**
   * Retrieves the details of a specific item from the 'tb_jenis_alat' table.
   *
   * @param int $id The ID of the item to retrieve.
   * @return array An array containing the details of the item.
   */
  public function editAlatKelompokPembinaan($id)
  {
    $this->db->select('tb_jenis_alat.*');
    $this->db->from('tb_jenis_alat');
    $this->db->where('id', $id);
    return $this->db->get()->result_array();
  }

  /**
   * Retrieves data from the 'kelas_training' table based on the given ID.
   *
   * @param int $id The ID used to filter the data.
   * @return array An array containing the retrieved data from the 'kelas_training' table.
   */
  public function dataKelasTraining($id)
  {
    $this->db->select('kelas_training.*');
    $this->db->from('kelas_training');
    $this->db->where('id', $id);
    return $this->db->get()->result_array();
  }

  /**
   * Retrieves data of a specific item from the 'tb_kelompok_pembinaan' table based on the given ID.
   *
   * @param datatype $id The ID of the item to retrieve.
   * @return array An array containing the details of the item.
   */
  public function dataKelompokPembinaan($id)
  {
    $this->db->select('tb_kelompok_pembinaan.*');
    $this->db->from('tb_kelompok_pembinaan');
    $this->db->where('id', $id);
    return $this->db->get()->result_array();
  }

  /**
   * Retrieves data from the 'sertifikat_indonesia' table based on the given ID.
   *
   * @param int $id The ID used to filter the data.
   * @return array An array containing the retrieved data from the 'sertifikat_indonesia' table.
   */
  public function getDataSertifikatIndonesia($id)
  {
    $this->db->select('sertifikat_indonesia.*');
    $this->db->from('sertifikat_indonesia');
    $this->db->where('id', $id);
    return $this->db->get()->result_array();
  }

  /**
   * Retrieves data from the 'bidang' table based on the given ID.
   *
   * @param int $id The ID used to filter the data.
   * @return array An array containing the retrieved data from the 'bidang' table.
   */
  public function dataBidang($id)
  {
    $this->db->select('bidang.*');
    $this->db->from('bidang');
    $this->db->where('id', $id);
    return $this->db->get()->result_array();
  }

  /**
   * Retrieves data from the 'jenis_personil' table based on the given ID.
   *
   * @param int $id The ID used to filter the data.
   * @return array An array containing the retrieved data.
   */
  public function dataJenisPersonil($id)
  {
    $this->db->select('jenis_personil.*');
    $this->db->from('jenis_personil');
    $this->db->where('id', $id);
    return $this->db->get()->result_array();
  }

  /**
   * Retrieves data from the 'jenis_pendidikan' table based on the given ID.
   *
   * @param int $id The ID used to filter the data.
   * @return array An array containing the retrieved data.
   */
  public function dataJenisPendidikan($id)
  {
    $this->db->select('pendidikan.*');
    $this->db->from('pendidikan');
    $this->db->where('id', $id);
    return $this->db->get()->result_array();
  }

  /**
   * Retrieves data of a specific admin from the 'user' table based on the given ID.
   *
   * @param int $id The ID of the admin to retrieve.
   * @return array An array containing the details of the admin.
   */
  public function dataAdmin($id)
  {
    $this->db->select('user.*');
    $this->db->from('user');
    $this->db->where('id', $id);
    return $this->db->get()->result_array();
  }

  /**
   * Retrieves data of a specific sertifikat from the 'sertifikat_ing' table based on the given ID.
   *
   * @param int $id The ID used to filter the data.
   * @return array An array containing the retrieved data.
   */
  public function dataSertifikat($id)
  {
    $this->db->select('sertifikat_ing.*');
    $this->db->from('sertifikat_ing');
    $this->db->where('id', $id);
    return $this->db->get()->result_array();
  }

  /**
   * Retrieves all data from the 'kelompok_pembinaan' table.
   *
   * This function selects all columns from the 'kelompok_pembinaan' table and retrieves
   * the data in descending order based on the 'id' column. The retrieved data
   * is returned as an array.
   *
   * @return array An array containing all the data from the 'kelompok_pembinaan' table.
   */
  public function semuaMasterKelompokPembinaan()
  {
    $this->db->select('kelompok_pembinaan.*');
    $this->db->from('kelompok_pembinaan');
    $this->db->order_by('id', 'DESC');
    return $this->db->get()->result_array();
  }

  /**
   * Retrieves data of a specific bidang personil from the 'tb_personil' table based on the given ID.
   *
   * @param int $id The ID used to filter the data.
   * @return array An array containing the retrieved data.
   */
  public function editBidangPersonil($id)
  {
    $this->db->select('tb_personil.*');
    $this->db->from('tb_personil');
    $this->db->where('id', $id);
    return $this->db->get()->result_array();
  }

  /**
   * Retrieves data of the last education class from the 'pendidikan_terakhir' table based on the given ID.
   *
   * @param int $id The ID used to filter the data.
   * @return array An array containing the retrieved data.
   */
  public function editKelasPendidikanTerakhir($id)
  {
    $this->db->select('pendidikan_terakhir.*');
    $this->db->from('pendidikan_terakhir');
    $this->db->where('id', $id);
    return $this->db->get()->result_array();
  }

  /**
   * Retrieves data from the 'pendaftaran' and 'dokumen_pendaftaran' tables based on the given ID.
   *
   * @param int $id The ID used to filter the data.
   * @return array An array containing the retrieved data.
   */
  public function getData($id)
  {
    $this->db->select('*');
    $this->db->from('pendaftaran');
    $this->db->join('dokumen_pendaftaran', 'pendaftaran.id = dokumen_pendaftaran.id_user'); // Menggunakan left join
    $this->db->where('pendaftaran.id_form', $id); // Filter berdasarkan id_pendaftaran
    $query = $this->db->get();
    return $query->result_array();
  }

  /**
   * Retrieves data from the 'pendaftaran', 'berkas_pendaftaran', and 'form' tables based on the given ID.
   *
   * @param int $id The ID used to filter the data.
   * @return array An array containing the retrieved data.
   */
  public function getPeserta($id)
  {
    $query = "SELECT
      p.*,
      MAX(CASE WHEN bp.file_path LIKE '%ktp%' THEN bp.file_name END) AS 'foto_ktp',
      MAX(CASE WHEN bp.file_path LIKE '%ijazah%' THEN bp.file_name END) AS 'ijazah',
      MAX(CASE WHEN bp.file_path LIKE '%foto%' THEN bp.file_name END) AS 'foto',
      MAX(CASE WHEN bp.file_path LIKE '%surat%' THEN bp.file_name END) AS 'surat',
      MAX(CASE WHEN bp.file_path LIKE '%sk%' THEN bp.file_name END) AS 'sk',
      MAX(CASE WHEN bp.file_path LIKE '%bukti%' THEN bp.file_name END) AS 'bukti',
      MAX(CASE WHEN bp.file_path LIKE '%cv%' THEN bp.file_name END) AS 'cv',
      pf.form AS 'nama_form'
        FROM
            pendaftaran AS p
        LEFT JOIN
            berkas_pendaftaran AS bp ON p.id = bp.form_id
        LEFT JOIN
          form AS pf ON p.id_form = pf.id
        WHERE
            p.id_form = $id
        GROUP BY
            p.id";

    return $this->db->query($query)->result_array();
  }

  /**
   * Retrieves the education details based on the provided ID.
   *
   * @param int $id The ID used to filter the education details.
   * @return array An array containing the education details.
   */
  public function getPendidikan($id)
  {
    $query = "SELECT pendidikan.pendidikan FROM `kelas` 
      INNER JOIN pendidikan_terakhir ON kelas.id = pendidikan_terakhir.id_kelas 
      INNER JOIN pendidikan ON pendidikan_terakhir.id_pendidikan = pendidikan.id WHERE kelas.id = ?";

    return $this->db->query($query)->result_array();
  }

  /**
   * Retrieves the classes based on the provided ID.
   *
   * @param int $id The ID used to filter the classes.
   * @throws None
   * @return array An array containing the retrieved classes.
   */
  public function getKelas($id)
  {
    $query = "SELECT jenis_personil.id, jenis_personil.jenis_personil FROM `jenis_personil` JOIN tb_personil ON jenis_personil.id = tb_personil.id_jenis_personil WHERE tb_personil.id_bidang = $id";
    $result = $this->db->query($query)->result_array();

    // Atur header response sebagai JSON
    header('Content-Type: application/json');

    echo json_encode($result);
  }
  public function getBidang($id)
  {
    $query = "SELECT SELECT bidang FROM delta_pic_prod.bidang = $id";
    $result = $this->db->query($query)->result_array();

    // Atur header response sebagai JSON
    header('Content-Type: application/json');

    echo json_encode($result);
  }
  /**
   * Retrieves the specified kelompok based on the provided ID and class.
   *
   * @param int $id The ID used to filter the kelompok.
   * @param int $kelas The class used to filter the kelompok.
   * @throws None
   * @return array An array containing the retrieved kelompok.
   */
  public function getKelompok($id, $kelas)
  {
    $query = "
    SELECT kp.kelompok_pembinaan, kp.id
    FROM tb_kelompok_pembinaan tkp
    INNER JOIN kelompok_pembinaan kp ON tkp.id_kelompok_pembinaan = kp.id
    WHERE tkp.id_bidang = $id
    AND tkp.id_jenis_personil = $kelas;
    ";
    $result = $this->db->query($query)->result_array();

    // Atur header response sebagai JSON
    header('Content-Type: application/json');

    echo json_encode($result);
  }


  /**
   * Retrieves the specified alat based on the provided ID.
   *
   * @param int $id The ID used to filter the alat.
   * @throws None
   * @return array An array containing the retrieved alat.
   */
  public function getAlat($id)
  {
    $query = "SELECT Jenis_alat.jenis_alat, Jenis_alat.id FROM Jenis_alat INNER JOIN tb_jenis_alat ON Jenis_alat.id = tb_jenis_alat.Jenis_alat WHERE 
    tb_jenis_alat.id_kelompok_pembinaan = $id";
    $result = $this->db->query($query)->result_array();

    // Atur header response sebagai JSON
    header('Content-Type: application/json');

    echo json_encode($result);
  }

  /**
   * Retrieves the fields that are empty for a specific user from the 'dokumen_pendaftaran' table.
   *
   * @param int $id The ID of the user.
   * @return array|false An array of empty fields if found, false if user is not found.
   */
  public function getFieldkosong($id)
  {
    $this->db->select('id_user, surat, ijazah, ktp, sk, foto, bukti');
    $this->db->from('dokumen_pendaftaran');
    $this->db->where('id_user', $id);
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
      $row = $query->row();
      $fields = array();

      if (empty($row->surat)) {
        $fields[] = 'surat';
      }

      if (empty($row->ijazah)) {
        $fields[] = 'ijazah';
      }

      if (empty($row->ktp)) {
        $fields[] = 'ktp';
      }
      if (empty($row->sk)) {
        $fields[] = 'sk';
      }
      if (empty($row->foto)) {
        $fields[] = 'foto';
      }
      if (empty($row->bukti)) {
        $fields[] = 'bukti';
      }
      if (empty($row->cv)) {
        $fields[] = 'cv';
      }
      if (empty($row->surat_sehat)) {
        $fields[] = 'surat_sehat';
      }
      return $fields;
    } else {
      // Handle jika id_user tidak ditemukan
      return false;
    }
  }

  /**
   * Retrieves training data from the database.
   *
   * @return array An array containing the training data.
   */
  public function get_training()
  {
    $query = "SELECT 
             f.id as id_form, u.id as id_user, f.form AS form, f.tanggal_pelaksanaan, f.tanggal_selesai,
              COUNT(p.nama) AS peserta,
              u.nama AS pic
            FROM 
                pendaftaran p
            JOIN 
                form f ON p.id_form = f.id
            JOIN 
                user u ON f.id_user = u.id
            GROUP BY 
                f.form, u.nama";

    $res = $this->db->query($query)->result_array();
    return $res;
  }

  /**
   * Inserts data into the 'sertifikat' table in the database.
   *
   * @param array $data An associative array containing the data to be inserted.
   *                    The array should have the following keys:
   *                    - 'id': An array of IDs corresponding to the 'id_pendaftaran' field.
   *                    - 'idn': The value for the 'training' field.
   *                    - 'ing': The value for the 'training_inggris' field.
   *                    - 'pelaksanaan': The value for the 'pelaksanaan' field.
   *                    - 'pelaksanaan_inggris': The value for the 'pelaksanaan_inggris' field.
   *                    - 'terbit': The value for the 'terbit' field.
   *                    - 'terbit_inggirs': The value for the 'terbit_inggris' field.
   *                    - 'nama': An array of names corresponding to the 'nama' field.
   *                    - 'no_sertifikat': An array of certificate numbers corresponding to the 'no_sertifikat' field.
   *                    - 'sertifikat': An array of certificate types corresponding to the 'no_sertifikat' field.
   * @return int The number of rows affected by the insertion.
   */
  public function insertData($data)
  {
    // Loop through the arrays and insert data into the database
    foreach ($data['id'] as $key => $id) {
      $insert_data = array(
        'id_pendaftaran' => $id,
        'training' => $data['idn'],
        'training_inggris' => $data['ing'],
        'pelaksanaan' => $data['pelaksanaan'],
        'pelaksanaan_inggris' => $data['pelaksanaan_inggris'],
        'terbit' => $data['terbit'],
        'terbit_inggris' => $data['terbit_inggirs'],
        'nama' => $data['nama'][$key],
        'no_sertifikat' => $data['no_sertifikat'][$key] . '/' . $data['sertifikat'][$key],

        // Add other fields as needed
      );

      // Insert data into the database
      $this->db->insert('sertifikat', $insert_data);
    }
    return $this->db->affected_rows();
  }
}
