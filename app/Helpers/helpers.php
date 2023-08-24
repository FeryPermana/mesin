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
