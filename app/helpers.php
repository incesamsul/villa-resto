<?php

use App\Models\FavoritModel;
use App\Models\KategoriModel;
use App\Models\LogAktivitasModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use phpDocumentor\Reflection\Types\Null_;
use PhpParser\Node\Expr\FuncCall;

use function PHPUnit\Framework\isNull;


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
