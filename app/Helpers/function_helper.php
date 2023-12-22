<?php

/**
 * --------------------------------------------------------------------------
 * Helper Format Rupiah
 * --------------------------------------------------------------------------
 * 
 * 
 **/
function format_rupiah($angka)
{
    $rupiah = number_format($angka, 0, ',', '.');
    return $rupiah;
}
function id_tgl_strip($val)
{
    date_default_timezone_set('Asia/Jakarta');
    return date('d-m-Y', strtotime($val));
}

function tanggal_indo($val)
{
    date_default_timezone_set('Asia/Jakarta');

    return date('d-m-Y H:i', $val);
}

function tglIndo($val)
{
    date_default_timezone_set('Asia/Jakarta');
    return date('d-m-Y', strtotime($val));
}


/*decode string decode (html)*/
function decodeString($read)
{
    return html_entity_decode(htmlspecialchars_decode($read));
}

function time_post($timestamp)
{
    date_default_timezone_set('Asia/Jakarta'); //waktu posting

    $difference = time() - strtotime($timestamp);
    $sec   = $difference;
    $min   = round($difference / 60);
    $hour  = round($difference / 3600);
    $day   = round($difference / 86400);
    $weeks = round($difference / 604800);
    $month = round($difference / 2419200);
    $year  = round($difference / 29030400);

    if ($sec <= 60) {
        $time = $sec . ' detik yang lalu';
    } else if ($min <= 60) {
        $time = $min . ' menit yang lalu';
    } else if ($hour <= 24) {
        $time = $hour . ' jam yang lalu';
    } else if ($day <= 7) {
        $time = $day . ' hari yang lalu';
    } else if ($weeks <= 4) {
        $time = $weeks . ' minggu yang lalu';
    } else if ($month <= 12) {
        $time = $month . ' bulan yang lalu';
    } else {
        $time = $year . ' tahun yang lalu';
    }

    return $time;
}

function month_id($date)
{
    date_default_timezone_set('Asia/Jakarta');
    $month = array(
        1 =>   'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    );
    $crack = explode('-', $date);
    return $crack[2] . ' ' . $month[(int)$crack[1]] . ' ' . $crack[0];
}

function m1()
{
    return "Presensi";
}

function mblb()
{
    return "Mblb";
}