<?php 

if (!function_exists('custom_label')) {
    function custom_label($field) {
        switch ($field) {
            case 'surat':
                return 'Surat Pernyataan Peserta';
            case 'ijazah':
                return 'Ijazah Terakhir';
            case 'ktp':
                return 'KTP';
                case 'sk':
                    return 'Surat Keterangan Bekerja dari Perusahaan';
                    case 'foto':
                        return 'Pas Foto';
                        case 'bukti':
                            return 'Bukti Transfer (Reguler)';
                            case 'cv':
                                return 'Curiculum Vitae';
                                case 'surat_sehat':
                                    return 'Surat Sehat';
            default:
                return $field;
        }
    }
}



?>