<?php
function increment($data, $loop)
{
    return $data->firstItem() + $loop->index;
}

function generateMonthYearStringFromDate(DateTime $date)
{
    $monthNames = [
        1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April', 5 => 'Mei', 6 => 'Juni',
        7 => 'Juli', 8 => 'Agustus', 9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
    ];

    $month = $date->format('n');
    $year = $date->format('Y');

    $monthName = $monthNames[$month];

    return $monthName . ' ' . $year;
}

function formatTanggalIndo($date, $type = null, $year = null)
{
    if ($date == null) {
        return '-';
    }

    if ($type == 'singkat') {
        $BulanIndo = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
    } else {
        $BulanIndo = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
    }

    $tahun = substr($date, 0, 4);
    $bulan = substr($date, 5, 2);
    $tgl = substr($date, 8, 2);
    if ($year == "kosong") {
        $result = $tgl . ' ' . $BulanIndo[(int) $bulan - 1];
    } else if ($bulan == 0) {
        $result = 0;
    } else {
        $result = $tgl . ' ' . $BulanIndo[(int) $bulan - 1] . ' ' . $tahun;
    }
    return $result;
}

function bulan_list()
{
    $months = array(
        "Januari", "Februari", "Maret", "April", "Mei", "Juni",
        "Juli", "Agustus", "September", "Oktober", "November", "Desember"
    );

    return $months;
}

function bulanSaatIni()
{
    $months = array(
        1 => 'Januari', 2 => 'Februari', 3 => 'Maret',
        4 => 'April', 5 => 'Mei', 6 => 'Juni',
        7 => 'Juli', 8 => 'Agustus', 9 => 'September',
        10 => 'Oktober', 11 => 'November', 12 => 'Desember'
    );

    $currentMonthIndex = date('n');
    $currentMonthString = $months[$currentMonthIndex];

    return $currentMonthString;
}

function getPukul($datetime)
{
    if ($datetime instanceof DateTime) {
        return $datetime->format('H:i'); // Format H:i akan menghasilkan pukul (jam:menit)
    } else {
        return ''; // Handle jika $datetime bukan instance dari DateTime
    }
}
