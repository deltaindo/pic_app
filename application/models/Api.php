<?php  

class Api extends CI_Model {


    public function getProvinsi()
    {

        $api_url = 'https://emsifa.github.io/api-wilayah-indonesia/api/provinces.json';

        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, $api_url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        // Mengaktifkan opsi untuk mengikuti pengalihan (301)
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);

        $response = curl_exec($curl);

        // Periksa apakah ada kesalahan dalam permintaan CURL
        if ($response === false) {
            die(curl_error($curl));
        }

        // Periksa kode status HTTP
        $http_status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        if ($http_status !== 200) {
            die("HTTP status code: " . $http_status);
        }

        curl_close($curl);

        // Parsing respons JSON
        $data = json_decode($response);

        // Periksa apakah parsing JSON berhasil
        if ($data === null) {
            die("Error decoding JSON: " . json_last_error_msg());
        }

        return $data;
    }

    public function getKabupaten($id)
    {
        $api_url = 'https://emsifa.github.io/api-wilayah-indonesia/api/regencies/' . $id . '.json';
    
        $curl = curl_init();
    
        curl_setopt($curl, CURLOPT_URL, $api_url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    
        // Mengaktifkan opsi untuk mengikuti pengalihan (301)
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
    
        $response = curl_exec($curl);
    
        // Periksa apakah ada kesalahan dalam permintaan CURL
        if ($response === false) {
            die(curl_error($curl));
        }
    
        // Periksa kode status HTTP
        $http_status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        if ($http_status !== 200) {
            die("HTTP status code: " . $http_status);
        }
    
        curl_close($curl);
    
        // Parsing respons JSON
        $data = json_decode($response);
    
        // Periksa apakah parsing JSON berhasil
        if ($data === null) {
            die("Error decoding JSON: " . json_last_error_msg());
        }
    
        // Mengembalikan data sebagai respons JSON
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function getKecamatan($id)
    {
        $api_url = 'https://emsifa.github.io/api-wilayah-indonesia/api/districts/' . $id . '.json';
    
        $curl = curl_init();
    
        curl_setopt($curl, CURLOPT_URL, $api_url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    
        // Mengaktifkan opsi untuk mengikuti pengalihan (301)
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
    
        $response = curl_exec($curl);
    
        // Periksa apakah ada kesalahan dalam permintaan CURL
        if ($response === false) {
            die(curl_error($curl));
        }
    
        // Periksa kode status HTTP
        $http_status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        if ($http_status !== 200) {
            die("HTTP status code: " . $http_status);
        }
    
        curl_close($curl);
    
        // Parsing respons JSON
        $data = json_decode($response);
    
        // Periksa apakah parsing JSON berhasil
        if ($data === null) {
            die("Error decoding JSON: " . json_last_error_msg());
        }
    
        // Mengembalikan data sebagai respons JSON
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    
    public function getKelurahan($id)
    {
        $api_url = 'https://emsifa.github.io/api-wilayah-indonesia/api/villages/' . $id . '.json';
    
        $curl = curl_init();
    
        curl_setopt($curl, CURLOPT_URL, $api_url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    
        // Mengaktifkan opsi untuk mengikuti pengalihan (301)
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
    
        $response = curl_exec($curl);
    
        // Periksa apakah ada kesalahan dalam permintaan CURL
        if ($response === false) {
            die(curl_error($curl));
        }
    
        // Periksa kode status HTTP
        $http_status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        if ($http_status !== 200) {
            die("HTTP status code: " . $http_status);
        }
    
        curl_close($curl);
    
        // Parsing respons JSON
        $data = json_decode($response);
    
        // Periksa apakah parsing JSON berhasil
        if ($data === null) {
            die("Error decoding JSON: " . json_last_error_msg());
        }
    
        // Mengembalikan data sebagai respons JSON
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
    
}