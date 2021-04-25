<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * buat Kode baru otomatis
 */
function getNewKode($prefix, $fieldName, $tableName)
{
    $sNextKode = "";
    $sLastKode = "";
    $CI =& get_instance();
    $CI->db->order_by($fieldName, 'desc');
    $CI->db->limit(1);
    $row = $CI->db->get($tableName)->row();
    if ($row) {
        $value = $row->$fieldName;
        $sLastKode = intval(substr($value, 2, 3));
        $sLastKode = intval($sLastKode) + 1;
        $sNextKode = $prefix . sprintf('%03s', $sLastKode);
        if (strlen($sNextKode) > 5) {
            $sNextKode = $prefix . "999";
        }
    } else {
        $sNextKode = $prefix . "001";
    }
    return $sNextKode;
}

/**
 * buat nomor jo baru
 * JO0001
 */
function getNewJO($prefix, $fieldName, $tableName)
{
    $sNextKode = "";
    $sLastKode = "";
    $CI =& get_instance();
    $CI->db->order_by($fieldName, 'desc');
    $CI->db->limit(1);
    $row = $CI->db->get($tableName)->row();
    if ($row) {
        $value = $row->$fieldName;
        $sLastKode = intval(substr($value, 2, 4));
        $sLastKode = intval($sLastKode) + 1;
        $sNextKode = $prefix . sprintf('%04s', $sLastKode);
        if (strlen($sNextKode) > 6) {
            $sNextKode = $prefix . "9999";
        }
    } else {
        $sNextKode = $prefix . "0001";
    }
    return $sNextKode;
}

/**
 * buat nomor cost sheet baru
 * CST0001
 */
function getNewCSheet($prefix, $fieldName, $tableName)
{
    $sNextKode = "";
    $sLastKode = "";
    $CI =& get_instance();
    $CI->db->order_by($fieldName, 'desc');
    $CI->db->limit(1);
    $row = $CI->db->get($tableName)->row();
    if ($row) {
        $value = $row->$fieldName;
        $sLastKode = intval(substr($value, 3, 4));
        $sLastKode = intval($sLastKode) + 1;
        $sNextKode = $prefix . sprintf('%04s', $sLastKode);
        if (strlen($sNextKode) > 7) {
            $sNextKode = $prefix . "9999";
        }
    } else {
        $sNextKode = $prefix . "0001";
    }
    return $sNextKode;
}

/**
 * buat nomor invoice baru
 * INV0001
 */
function getNewInvoice($prefix, $fieldName, $tableName)
{
    $sNextKode = "";
    $sLastKode = "";
    $CI =& get_instance();
    $CI->db->order_by($fieldName, 'desc');
    $CI->db->limit(1);
    $row = $CI->db->get($tableName)->row();
    if ($row) {
        $value = $row->$fieldName;
        $sLastKode = intval(substr($value, 3, 4));
        $sLastKode = intval($sLastKode) + 1;
        $sNextKode = $prefix . sprintf('%04s', $sLastKode);
        if (strlen($sNextKode) > 7) {
            $sNextKode = $prefix . "9999";
        }
    } else {
        $sNextKode = $prefix . "0001";
    }
    return $sNextKode;
}

/**
 * liat isi variabel
 */
function pre($data) {
    echo "<pre>";
    print_r($data);
    echo "</pre>";
}

/**
 * check akun last level
 */
function isLastLevel($akunLastLevel, $akun)
{
    $idakunArray = array_map('toArray', $akunLastLevel);
    return in_array($akun->idakun, $idakunArray, true);
}

/**
 * fungsi untuk mengubah posisi NAMA AKUN, disesuaikan dengan level akunnya
 */
function formatNamaAkun($akunLastLevel, $akun)
{
    $idakunArray = array_map('toArray', $akunLastLevel);
    // $lenKode = strlen(($akun->KodeBB <> '' ? $akun->KodeBB : ($akun->KodeBP <> '' ? $akun->KodeBP : $akun->Kode)));
    $lenKode = strlen($akun->Kode);
    switch ($lenKode) {
        case 1:
            $result = '<b>' . $akun->Nama . '</b>';
            break;
        case 2:
            $result = '&nbsp;&nbsp;&nbsp;&nbsp;' . (in_array($akun->idakun, $idakunArray, true) ? $akun->Nama : '<b>' . $akun->Nama . '</b>');
            break;
        case 4:
            // $countId = $this->Akun_model0->totalRows($row->idakun, $this->table);
            $result = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . (in_array($akun->idakun, $idakunArray, true) ? $akun->Nama : '<b>' . $akun->Nama . '</b>');
            // $result = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . (in_array($akun->idakun, $indukArray, true) ? $akun->Nama : '<b>' . $akun->Nama . '</b>');
            break;
        case 7:
            // $countId = $this->Akun_model0->totalRows($row->idakun, $this->table);
            $result = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . (in_array($akun->idakun, $idakunArray, true) ? $akun->Nama : '<b>' . $akun->Nama . '</b>');
            // $result = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . (in_array($akun->idakun, $indukArray, true) ? $akun->Nama : '<b>' . $akun->Nama . '</b>');
            break;
        case 10:
            // $result = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $akun->Nama;
            $result = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . (in_array($akun->idakun, $idakunArray, true) ? $akun->Nama : '<b>' . $akun->Nama . '</b>');
            break;
        case 13:
            $result = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $akun->Nama;
            break;
    }

    return $result;
}

function toArray($obj)
{
    $obj = (array) $obj; //cast to array, optional
    return $obj['idakun'];
}

function numIndo($angka)
{
    return number_format($angka, 2, ',', '.');
}

function shortDateIndo($tgl)
{
    $ubah    = gmdate($tgl, time() + 60 * 60 * 8);
    $pecah   = explode('-', $ubah);
    $tanggal = $pecah[2];
    $bulan   = shortBulan($pecah[1]);
    $tahun   = $pecah[0];
    return $tanggal . '/' . $bulan . '/' . $tahun;
}

function shortBulan($bln)
{
    switch ($bln) {
        case 1:
            return '01';
            break;
        case 2:
            return '02';
            break;
        case 3:
            return '03';
            break;
        case 4:
            return '04';
            break;
        case 5:
            return '05';
            break;
        case 6:
            return '06';
            break;
        case 7:
            return '07';
            break;
        case 8:
            return '08';
            break;
        case 9:
            return '09';
            break;
        case 10:
            return '10';
            break;
        case 11:
            return '11';
            break;
        case 12:
            return '12';
            break;
    }
}

function mediumDateIndo($tgl)
{
    $ubah    = gmdate($tgl, time() + 60 * 60 * 8);
    $pecah   = explode('-', $ubah);
    $tanggal = $pecah[2];
    $bulan   = mediumBulan($pecah[1]);
    $tahun   = $pecah[0];
    return $tanggal . '-' . $bulan . '-' . $tahun;
}

function mediumBulan($bln)
{
    switch ($bln) {
        case 1:
            return 'Jan';
            break;
        case 2:
            return 'Feb';
            break;
        case 3:
            return 'Mar';
            break;
        case 4:
            return 'Apr';
            break;
        case 5:
            return 'Mei';
            break;
        case 6:
            return 'Jun';
            break;
        case 7:
            return 'Jul';
            break;
        case 8:
            return 'Ags';
            break;
        case 9:
            return 'Sep';
            break;
        case 10:
            return 'Okt';
            break;
        case 11:
            return 'Nov';
            break;
        case 12:
            return 'Des';
            break;
    }
}

function longDateIndo($tgl)
{
    $ubah    = gmdate($tgl, time() + 60 * 60 * 8);
    $pecah   = explode('-', $ubah);
    $tanggal = $pecah[2];
    $bulan   = $pecah[1];
    $tahun   = $pecah[0];
    $bulan2  = bulan($bulan);

    $nama  = date('l', mktime(0, 0, 0, $bulan, $tanggal, $tahun));
    $nama2 = '';
    switch ($nama) {
        case 'Sunday':
            $nama2 = 'Minggu';
            break;
        case 'Monday':
            $nama2 = 'Senin';
            break;
        case 'Tuesday':
            $nama2 = 'Selasa';
            break;
        case 'Wednesday':
            $nama2 = 'Rabu';
            break;
        case 'Thursday':
            $nama2 = 'Kamis';
            break;
        case 'Friday':
            $nama2 = 'Jumat';
            break;
        case 'Saturday':
            $nama2 = 'Sabtu';
            break;
    }
    return $nama2 . ', ' . $tanggal . ' ' . $bulan2 . ' ' . $tahun;
}

function dateIndo($value)
{
    return date_format(date_create($value), 'd-m-Y');
}

function dateMysql($value)
{
    return date('Y-m-d', strtotime(str_replace('/', '-', $value)));
}

function dateAdd($value, $add)
{
    // echo pre($value);
    // echo pre($add);
    $date = date_create($value);
    date_add($date, date_interval_create_from_date_string($add . " days"));
    return date_format($date,"Y-m-d");
}
