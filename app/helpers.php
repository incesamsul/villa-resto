<?php

use App\Models\Inventaris;
use App\Models\Reservasi;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Twilio\Rest\Client;




function cekReservasiKamar($idKamar)
{
    $tglHariIni = Carbon::now()->format('Y-m-d');

    $reservasi = Reservasi::where('id_kamar', $idKamar)->latest()->first();
    if ($reservasi) {
        // Check if the reservation date has passed today's date
        if (strtotime($reservasi->tgl_check_in) < strtotime($tglHariIni)) {
            // reservasi invalid
            return;
        } else {
            // reservasi valid
            return $reservasi;
        }
    }
}

function hitungDurasiMalam($checkin, $checkout)
{
    $checkin_date = Carbon::parse($checkin);
    $checkout_date = Carbon::parse($checkout);

    // Jika check-in dan check-out pada hari yang sama, hitung sebagai 1 hari
    if ($checkin_date->isSameDay($checkout_date)) {
        return 1;
    }

    // Jika check-out sebelum jam 12 siang, hitung sebagai 1 malam
    if ($checkout_date->diffInHours($checkout_date->copy()->startOfDay()->addHours(12)) < 0) {
        return $checkin_date->diffInDays($checkout_date);
    }

    // Jika check-out setelah jam 12 siang, hitung sebagai 2 malam
    return $checkin_date->diffInDays($checkout_date->addDay());
}

function convertNoHp($noHp)
{
    return '62' . substr($noHp, 1);
}

function sendWhatsAppMessage($wa, $pesan)
{
    $_wa = convertNoHp($wa);
    $account_sid = 'AC80c49cc0f6ee0b7b01a332c886df472a';
    $auth_token = '4e1a8dd7efdaccf38ee53a9d71f3ad07';
    $twilio_whatsapp_number = 'whatsapp:+14155238886';

    $client = new Client($account_sid, $auth_token);

    $message = $client->messages->create(
        'whatsapp:' . $_wa,
        [
            'from' => $twilio_whatsapp_number,
            'body' => $pesan,
        ]
    );

    return response()->json(['status' => 'success', 'message' => 'WhatsApp message sent!']);
}

function getHour()
{
    // Create a new Carbon instance with the current time and the default timezone
    $now = Carbon::now();
    // Set the timezone of the Carbon instance to Makassar
    $now->setTimezone('Asia/Makassar');
    // Get the hour in the Makassar timezone
    $hour = $now->format('H:i:s');
    return $hour;
}

function spaceToLine($string)
{
    return str_replace(" ", "-", $string);
}

function removeComa($string)
{
    return str_replace(",", "", $string);
}

function lineToSpace($string)
{
    return str_replace("-", " ", $string);
}

function removeSpace($string)
{
    return str_replace(" ", "", $string);
}

function getUserRoleName($userRoleId)
{
    return DB::table('users')
        ->Join('role', 'role.id_role', '=', 'users.id_role')
        ->where('users.id_role', $userRoleId)
        ->select('nama_role')
        ->first()->nama_role;
}


function sweetAlert($pesan, $tipe)
{
    echo '<script>document.addEventListener("DOMContentLoaded", function() {
        Swal.fire(
            "' . $pesan . '",
            "proses berhasil di lakukan",
            "' . $tipe . '",
        );
    })</script>';
}
