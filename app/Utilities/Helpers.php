<?php // Code within app\Helpers\Helper.php

namespace App\Utilities;

use App\Models\Customers;
use App\Models\GolonganTarif;
use App\Models\MetodeBayarPajak;
use App\Models\Payment;
use App\Models\PaymentStatus;
use App\Models\Zone;
use Config;
use DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use JetBrains\PhpStorm\ArrayShape;
use JetBrains\PhpStorm\Pure;
use ReflectionClass;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Storage;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Helpers
{

    public static function convertTitle(string $title): array|string|null
    {
        return preg_replace('/[\s-]+/', '-', strtolower($title));
    }

    #[ArrayShape(['zonaKode' => 'int', 'kodeGol' => 'int', 'padNum' => 'string'])] private static function getMaxNumber($golid, $zonaid,$length, $pad): array
    {
        $maxNumber = Customers::max('id');
        $maxNumber = is_null($maxNumber) ? 1 : $maxNumber;
        $padNum = Str::padLeft($maxNumber, $length, $pad);
        $golongan = GolonganTarif::find($golid);
        $kodeGol = !is_null($golongan) ? (int) $golongan->kode_golongan : 111;
        $zona = Zone::find($zonaid);
        $zonaKode = !is_null($zona) ? (int) $zona->kode : 10;

        return [
            'zonaKode' => $zonaKode,
            'kodeGol' => $kodeGol,
            'padNum' => $padNum,
        ];
    }

    public static function generateNoSambungan($golid, $zonaid, $delimiter = '', $length = 5, $pad = '00000'): string
    {
        $kode = static::getMaxNumber($golid, $zonaid, $length, $pad);
        $zonaKode = $kode['zonaKode'];
        $kodeGol = $kode['kodeGol'];
        $padNum = $kode['padNum'];
        $delimiter = setting('pemisah', $delimiter);

        return $zonaKode.$delimiter.$kodeGol.$delimiter.$delimiter.$padNum;
    }

    public static function generateNoPelanggan($golid, $zonaid, $delimiter = '', $length = 5, $pad = '00000'): string
    {
        $kode = static::getMaxNumber($golid, $zonaid, $length, $pad);
        $zonaKode = $kode['zonaKode'];
        $kodeGol = $kode['kodeGol'];
        $padNum = $kode['padNum'];
        $kodeKab = '7312';
        $delimiter = setting('pemisah', $delimiter);

        return $kodeKab.$delimiter.$zonaKode.$delimiter.$kodeGol.$delimiter.$padNum;
    }

    public function encodeId($id): string
    {
        return \Hashids::encode($id);
    }

    public static function decodeId(string $hash)
    {
        return \Hashids::decode($hash)[0];
    }

    public static function generateNoTransaksi($delimiter = '', $length = 5, $pad = '00000'): string
    {
        $maxNumber = Payment::max('id');
        $maxNumber = is_null($maxNumber) ? 1 : $maxNumber;
        $padNum = Str::padLeft($maxNumber, $length, $pad);
        $tahun = setting('tahun_periode',now()->year);
        $bulan = setting('bulan',now()->month);
        $prefix = setting('format_no_transaksi', 'PDM');
        $delimiter = setting('pemisah', $delimiter);
        return $prefix.$delimiter.$tahun.$bulan.$padNum;
    }

    public static function hitungPembayaranAir($meter_awal, $meter_akhir, $tarif_per_kwh, $tarif_per_meter): float|int
    {
        $kwh = $meter_akhir - $meter_awal;
        $pembayaran_air = $kwh * $tarif_per_kwh;
        $pembayaran_meter = $tarif_per_meter * $meter_akhir;
        return $pembayaran_air + $pembayaran_meter;
    }

    public static function getNamaStatusTransaksi($kode): string
    {
        return match ($kode) {
            1 => 'Lancar',
            2 => 'Menunggak',
            default => '-',
        };
    }

    /**
     * Convert Number to Roman
     *
     * @param  int  $integer
     *
     * @return string
     */
    public static function convertToRoman(int $integer): string
    {
        // Convert the integer into an integer (just to make sure)
        $integer = intval($integer);
        $result = '';

        // Create a lookup array that contains all of the Roman numerals.
        $lookup = [
            'M' => 1000,
            'CM' => 900,
            'D' => 500,
            'CD' => 400,
            'C' => 100,
            'XC' => 90,
            'L' => 50,
            'XL' => 40,
            'X' => 10,
            'IX' => 9,
            'V' => 5,
            'IV' => 4,
            'I' => 1,
        ];

        foreach ($lookup as $roman => $value) {
            // Determine the number of matches
            $matches = (int) ($integer / $value);

            // Add the same number of characters to the string
            $result .= str_repeat($roman, $matches);

            // Set the integer to be the remainder of the integer and the value
            $integer %= $value;
        }

        // The Roman numeral should be built, return it
        return $result;
    }

    public static function getRomawi($bln)
    {
        switch ($bln) {
            case 1:
                return 'I';
                break;
            case 2:
                return 'II';
                break;
            case 3:
                return 'III';
                break;
            case 4:
                return 'IV';
                break;
            case 5:
                return 'V';
                break;
            case 6:
                return 'VI';
                break;
            case 7:
                return 'VII';
                break;
            case 8:
                return 'VIII';
                break;
            case 9:
                return 'IX';
                break;
            case 10:
                return 'X';
                break;
            case 11:
                return 'XI';
                break;
            case 12:
                return 'XII';
                break;
        }
    }

    public static function showQrCode($text, $size = 100, $format = 'png'): string
    {
        return '<img src="data:image/png;base64,'.base64_encode(self::generateQrCode($text, $size, $format)).'" alt="qrcode">';
    }

    public static function generateQrCode($text, $size = 100, $format = 'png', $style = 'square', $eyeStyle = 'square', $margin = 0)
    {
        return QrCode::format($format)
            ->size($size)
            ->style($style)
            ->eye($eyeStyle)
            ->margin($margin)
//            ->merge('../public/storage/uploads/20211009202835.png')
            ->generate($text);
    }

    /**
     * Get Available models in app.
     *
     * @return array $models
     */
    public static function getAvailableModels(): array
    {

        $models = [];
        $modelsPath = app_path('Models');
        $modelFiles = File::allFiles($modelsPath);
        foreach ($modelFiles as $modelFile) {
            $models[] = '\App\\' . $modelFile->getFilenameWithoutExtension();
        }

        return $models;
    }

    public static function recursive_change_key($arr, $set) {
        if (is_array($arr) && is_array($set)) {
            $newArr = array();
            foreach ($arr as $k => $v) {
                $key = array_key_exists( $k, $set) ? $set[$k] : $k;
                $newArr[$key] = is_array($v) ? self::recursive_change_key($v, $set) : $v;
            }
            return $newArr;
        }
        return $arr;
    }

    public static function showAlert ($tipe, $message): string
    {
        return '<div class="alert alert-'.$tipe.' alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    '.$message.'
                </div>';
    }

    public static function getClassFromFile($filepath): string
    {
        // this assumes you're following PSR-4 standards, although you may
        // still need to modify based on how you're structuring your app/namespaces
        return (string)Str::of($filepath)
            ->replace(app_path(), '\App')
            ->replaceFirst('app', 'App')
            ->replaceLast('.php', '')
            ->replace('/', '\\');
    }

    public static function getAppModels($path = null, $base_model = null, bool $with_abstract = false): Collection
    {
        // set up this filesystem disk in your config/filesystems file
        // this is just pointing to the app/ directory using the local driver
        $disk = Storage::disk('app');

        return collect($disk->allFiles($path))
            ->map(function ($filename) use ($disk) {
                return self::getClassFromFile($disk->path($filename));
            })
            ->filter(function ($class) use ($base_model, $with_abstract) {
                $ref = new ReflectionClass($class);

                if (!$with_abstract && $ref->isAbstract()) {
                    return false;
                }

                return $ref->isSubclassOf(
                    $base_model ?? Model::class
                );
            })
            ->map(function ($class) {
                return (new ReflectionClass($class))->getShortName();
            });
    }


    public static function getModels($path){
        $out = [];
        $results = scandir($path);
        foreach ($results as $result) {
            if ($result === '.' || $result === '..') {
                continue;
            }
            $filename = $path . '/' . $result;
            if (is_dir($filename)) {
                $out = array_merge($out, self::getModels($filename));
            }else{
                $out[] = substr($filename,0,-4);
            }
        }
        return $out;
    }

    public static function getNamaStatusBayar($kode): string
    {
        $statusBayar = PaymentStatus::find($kode);
        return !is_null($statusBayar) ? $statusBayar->name : '';
    }

    public static function getNamaMetodeBayar($id): string
    {
        $metode = MetodeBayarPajak::find($id);
        return !is_null($metode) ? $metode->nama : '';
    }

    public static function getEventColor($event): string
    {
//        $event = Str::lower($event);
        if($event === 'created' || $event === 'creating') {
            $color = 'success';
        }
        elseif($event === 'updated' || $event === 'updating') {
            $color = 'info';
        }
        elseif($event === 'deleted' || $event === 'deleting') {
            $color = 'danger';
        }
        elseif($event === 'restored' || $event === 'restoring') {
            $color = 'info';
        }
        elseif($event === 'forceDeleted' || $event === 'forceDeleting') {
            $color = 'danger';
        }
        elseif($event === 'saved' || $event === 'saving') {
            $color = 'success';
        }
        elseif($event === 'failed' || $event === 'failing') {
            $color = 'danger';
        }
        elseif($event === 'expired' || $event === 'expiring') {
            $color = 'danger';
        }
        elseif($event === 'completed' || $event === 'completing') {
            $color = 'success';
        }
        elseif($event === 'cancelled' || $event === 'cancelling') {
            $color = 'danger';
        }
        elseif($event === 'paid' || $event === 'paying') {
            $color = 'success';
        }
        elseif($event === 'unpaid' || $event === 'unpaying') {
            $color = 'danger';
        }
        elseif($event ==='retrieved' || $event === 'retrieving') {
            $color = 'primary';
        }
        elseif($event === 'sent' || $event === 'sending') {
            $color = 'info';
        }
        elseif($event === 'received' || $event === 'receiving') {
            $color = 'info';
        }
        elseif($event === 'approved' || $event === 'approving') {
            $color = 'success';
        }
        elseif($event === 'rejected' || $event === 'rejecting') {
            $color = 'danger';
        }
        else {
            $color = 'warning';
        }
        return $color;
    }

    public static function getAlertColor($kode): string
    {
        return match ($kode) {
            1 => 'success',
            3 => 'info',
            4 => 'warning',
            5 => 'primary',
            default => 'danger',
        };
    }

    public static function jumlah_hari($date): int
    {
        $date ??= now();

        return Carbon::parse($date)->daysInMonth;
    }

    public static function awal_bulan($date): Carbon
    {
        $date ??= now();

        return Carbon::parse($date)->startOfMonth();
    }

    public static function akhir_bulan($date): Carbon
    {
        $date ??= now();

        return Carbon::parse($date)->endOfMonth();
    }

    public static function checkJatuhTempo($date): bool
    {
        $jatuhTempo = false;
        $selisihHari = \Carbon\Carbon::parse($date)->diffInDays(setting('tanggal_periode_pajak'));
        if ($selisihHari <= 0) {
            $jatuhTempo = true;
        }

        return $jatuhTempo;
    }

    public static function selisihHari($date): string
    {
        $date = !is_null($date) ? $date : null;
        if ($date) {
            $hari = \Carbon\Carbon::parse($date)->diffInDays(setting('tanggal_periode_pajak'));
        } else {
            $hari = null;
        }

        if ($hari <= 0) {
            return 'Sudah jatuh tempo';
        }

        return 'Sisa '.$hari;
    }

    public static function selisihHari2($date, $format = false): float|string
    {
        $tglBayar = strtotime(setting('tgl_periode_pajak'));
        $jt = strtotime($date);
        $now = strtotime(now());
        $diff = $jt - $now;
        $bedaHari = floor($diff / (60 * 60 * 24));
        if ($diff > 0) {
            if ($bedaHari < 3) {
                return $format ? 'Dalam '.$bedaHari.' hari' : $bedaHari;
            }

            return $format ? 'Masih dalam '.$bedaHari.' hari' : $bedaHari;
        }

        return $format ? 'Sudah lewat '.$bedaHari.' hari' : $bedaHari;
    }

    public static function list_tanggal(): array
    {
        $day = [];
        for ($i = 1; $i <= 31; $i++) {
            $day[$i] = $i;
        }

        return $day;
    }

    public static function xtime($ymdhis = ''): string
    {
        if (!$ymdhis || $ymdhis === '0000-00-00 00:00:00') {
            return '';
        }
        $ago = strtotime($ymdhis);
        $now = time();
        $tgl = date('j', $ago);
        $nama_hari = static::nama_hari($ymdhis);
        $nama_bulan = static::nama_bulan($ymdhis);
        $pukul = date('H:i', $ago);
        $seldetik = abs(floor($now - $ago));
        $selmenit = abs(round($seldetik / 60));
        $seljam = abs(round($seldetik / 3600));
        if ($seldetik < 50) {
            return $seldetik.' detik yang lalu';
        }

        if ($selmenit < 50) {
            return $selmenit.' menit yang lalu';
        }

        if ($seljam < 4) {
            return $seljam.' jam yang lalu';
        }

        if ($seljam < 24) {
            return 'Hari ini pukul '.$pukul;
        }

        if ($seljam < 48) {
            return 'Kemarin pukul '.$pukul;
        }

        if (date('W', $ago) === date('W', $now)) {
            return $nama_hari.' '.$pukul;
        }

        if (date('Y', $ago) === date('Y', $now)) {
            return $tgl.' '.$nama_bulan.' '.$pukul;
        }

        return static::tanggal_jam($ymdhis);
    }

    public static function custom_number_format($n, $precision = 3): string
    {
        if ($n < 1000000) {
            // Anything less than a million
            $n_format = number_format($n);
        } elseif ($n < 1000000000) {
            // Anything less than a billion
            $n_format = number_format($n / 1000000, $precision).'M';
        } else {
            // At least a billion
            $n_format = number_format($n / 1000000000, $precision).'B';
        }

        return $n_format;
    }

    public static function hitungDenda($jumlah, $denda): float|int
    {
        $denda = setting('tarif_denda', $denda);
        return $jumlah * $denda;

    }

    // Converts a number into a short version, eg: 1000 -> 1k
    // Based on: http://stackoverflow.com/a/4371114
    public static function number_format_short($n, $precision = 1): string
    {
        if ($n < 900) {
            // 0 - 900
            $n_format = number_format($n, $precision);
            $suffix = '';
        } elseif ($n < 900000) {
            // 0.9k-850k
            $n_format = number_format($n / 1000, $precision);
            $suffix = 'K';
        } elseif ($n < 900000000) {
            // 0.9m-850m
            $n_format = number_format($n / 1000000, $precision);
            $suffix = 'M';
        } elseif ($n < 900000000000) {
            // 0.9b-850b
            $n_format = number_format($n / 1000000000, $precision);
            $suffix = 'B';
        } else {
            // 0.9t+
            $n_format = number_format($n / 1000000000000, $precision);
            $suffix = 'T';
        }
        // Remove unecessary zeroes after decimal. "1.0" -> "1"; "1.00" -> "1"
        // Intentionally does not affect partials, eg "1.50" -> "1.50"
        if ($precision > 0) {
            $dotzero = '.'.str_repeat('0', $precision);
            $n_format = str_replace($dotzero, '', $n_format);
        }
        return $n_format.$suffix;
    }

    // Shortens a number and attaches K, M, B, etc. accordingly
    public static function number_shorten($number, $precision = 3, $divisors = null): string
    {

        // Setup default $divisors if not provided
        if (!isset($divisors)) {
            $divisors = [
                1000 ** 0 => '', // 1000^0 == 1
                1000 ** 1 => 'K', // Thousand
                1000 ** 2 => 'M', // Million
                1000 ** 3 => 'B', // Billion
                1000 ** 4 => 'T', // Trillion
                1000 ** 5 => 'Qa', // Quadrillion
                1000 ** 6 => 'Qi', // Quintillion
            ];
        }

        // Loop through each $divisor and find the
        // lowest amount that matches
        foreach ($divisors as $divisor => $shorthand) {
            if (abs($number) < ($divisor * 1000)) {
                // We found a match!
                break;
            }
        }

        // We found our match, or there were no matches.
        // Either way, use the last defined value for $divisor.
        return number_format($number / $divisor, $precision).$shorthand;
    }

    public static function kekata($x): string
    {
        $x = abs($x);
        $angka = [
            '', 'satu', 'dua', 'tiga', 'empat', 'lima',
            'enam', 'tujuh', 'delapan', 'sembilan', 'sepuluh', 'sebelas',
        ];
        $temp = '';
        if ($x < 12) {
            $temp = ' '.$angka[$x];
        } else {
            if ($x < 20) {
                $temp = static::kekata($x - 10).' belas';
            } else {
                if ($x < 100) {
                    $temp = static::kekata($x / 10).' puluh'.static::kekata($x % 10);
                } else {
                    if ($x < 200) {
                        $temp = ' seratus'.static::kekata($x - 100);
                    } else {
                        if ($x < 1000) {
                            $temp = static::kekata($x / 100).' ratus'.static::kekata($x % 100);
                        } else {
                            if ($x < 2000) {
                                $temp = ' seribu'.static::kekata($x - 1000);
                            } else {
                                if ($x < 1000000) {
                                    $temp = static::kekata($x / 1000).' ribu'.static::kekata($x % 1000);
                                } else {
                                    if ($x < 1000000000) {
                                        $temp = static::kekata($x / 1000000).' juta'.static::kekata($x % 1000000);
                                    } else {
                                        if ($x < 1000000000000) {
                                            $temp = static::kekata($x / 1000000000).' milyar'.static::kekata(fmod($x, 1000000000));
                                        } else {
                                            if ($x < 1000000000000000) {
                                                $temp = static::kekata($x / 1000000000000).' trilyun'.static::kekata(fmod($x, 1000000000000));
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }

        return $temp;
    }

    public static function nama_hari($tanggal = ''): string
    {
        if ($tanggal === '') {
            $tanggal = date('Y-m-d H:i:s');
            $ind = date('w', strtotime($tanggal));
        } elseif (strlen($tanggal) < 2) {
            $ind = $tanggal - 1;
        } else {
            $ind = date('w', strtotime($tanggal));
        }
        $arr_hari = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];

        return $arr_hari[$ind];
    }

    public static function getNamaBulanIndo($bln): string
    {
        if (is_int($bln)) {
            return match ($bln) {
                1 => 'Januari',
                2 => 'Februari',
                3 => 'Maret',
                4 => 'April',
                5 => 'Mei',
                6 => 'Juni',
                7 => 'Juli',
                8 => 'Agustus',
                9 => 'September',
                10 => 'Oktober',
                11 => 'November',
                12 => 'Desember'
            };
        }

        return match ($bln) {
            '1' => 'Januari',
            '2' => 'Februari',
            '3' => 'Maret',
            '4' => 'April',
            '5' => 'Mei',
            '6' => 'Juni',
            '7' => 'Juli',
            '8' => 'Agustus',
            '9' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember'
        };
    }

    public static function list_bulan($short = false): array
    {
        if ($short) {
            $bln = [
                1 => 'Jan',
                2 => 'Feb',
                3 => 'Mar',
                4 => 'Apr',
                5 => 'Mei',
                6 => 'Jun',
                7 => 'Jul',
                8 => 'Agu',
                9 => 'Sep',
                10 => 'Okt',
                11 => 'Nov',
                12 => 'Des',
            ];
        } else {
            $bln = [
                1 => 'Januari',
                2 => 'Februari',
                3 => 'Maret',
                4 => 'April',
                5 => 'Mei',
                6 => 'Juni',
                7 => 'Juli',
                8 => 'Agustus',
                9 => 'September',
                10 => 'Oktober',
                11 => 'November',
                12 => 'Desember',
            ];
        }

        return $bln;
    }

    public static function nama_bulan($tanggal = '', $short = false): string
    {
        if ($tanggal === '' || $tanggal === 'now') {
            $tanggal = date('Y-m-d H:i:s');
            $ind = date('m', strtotime($tanggal));
        } elseif (strlen($tanggal) < 3) {
            $ind = $tanggal;
        } else {
            $ind = date('m', strtotime($tanggal));
        }
        --$ind;
        if ($short) {
            $arr_bulan = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
        } else {
            $arr_bulan = [
                'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember',
            ];
        }

        return $arr_bulan[$ind];
    }

    #[Pure] public static function index_nama_bulan($nama_bulan = '', $short = false)
    {
        $list_bulan = self::list_bulan($short);

        return array_search($nama_bulan, $list_bulan, null);
    }

    public static function getNamaBulan($date, $backMonth = false): string
    {
        if ($backMonth) {
            return Carbon::parse($date)->locale(config('app.locale'))->subDays(30)->format('F');
        }

        return Carbon::parse($date ?: now())->locale(config('app.locale'))->format('F');
    }

    public static function setTglJatuhTempo($jenisOp, $periode, $date): ?Carbon
    {
        if (($jenisOp === 3 && isset($periode)) || $periode > 0) {
            if ($periode === 1) {
                $tglJatuhTempo = Carbon::parse(now())->addDays(1);
            } elseif ($periode === 2) {
                $tglJatuhTempo = Carbon::parse(now())->addDays(7);
            } else {
                $tglJatuhTempo = Carbon::parse(now())->addDays(365);
            }
        } elseif ($jenisOp === 4 && isset($date)) {
            $tglJatuhTempo = Carbon::parse($date ?? now())->addDays(static::jumlah_hari(now()));
        } else {
            $tglJatuhTempo = null;
        }

        return $tglJatuhTempo;
    }

    public static function setJatuhTempoByDate($date): \Carbon\Carbon
    {
        $date = $date ?: now();
        return \Carbon\Carbon::parse($date)->addDays(static::jumlah_hari(now()));
    }

    public static function terbilang($x, $style = 4): string
    {
        if ($x < 0) {
            $hasil = 'minus '.trim(static::kekata($x));
        } else {
            $hasil = trim(static::kekata($x));
        }

        return match ($style) {
            1 => strtoupper($hasil),
            2 => strtolower($hasil),
            3 => ucwords($hasil),
            default => ucfirst($hasil),
        };
    }

    public static function tanggal($tanggal = 'now', $short_month = false, $empty_val = '')
    {
        $null = ['', '0000-00-00', '0000-00-00 00:00:00', '1970-01-01', null];
        if (in_array($tanggal, $null, true)) {
            return $empty_val;
        }
        if ($tanggal === 'now') {
            $tanggal = date('Y-m-d H:i:s');
        }
        $tgl = date('j', strtotime($tanggal));
        $thn = date('Y', strtotime($tanggal));
        $bln = self::nama_bulan($tanggal, $short_month);

        return $tgl.' '.$bln.' '.$thn;
    }

    public static function tanggal_jam($tanggal = '', $sep = ' - '): string
    {
        if ($tanggal === '') {
            $tanggal = date('Y-m-d H:i:s');
        }

        return self::tanggal($tanggal).$sep.date('H:i', strtotime($tanggal));
    }

    public static function day_date($tanggal = '')
    {
        Date::setLocale(config('app.locale'));
        if ($tanggal === '') {
            $tanggal = Date::now()->format('l, j F Y');
        }

        return $tanggal;
    }

    public static function localeDate($date, $format): string
    {
        Date::setLocale(config('app.locale'));

        return Date::createFromFormat('Y-m-d H:i:s', $date->format('Y-m-d H:i:s'))->format($format);
    }

    public static function hari_tanggal($tanggal = ''): string
    {
        Date::setLocale('id');
        if ($tanggal === '') {
//                $tanggal = date('Y-m-d H:i:s');
            $tanggal = Date::now()->timezone(config('app.timezone'))->format('Y-m-d H:i:s');
        }
        $tgl = date('d', strtotime($tanggal));
        $thn = date('Y', strtotime($tanggal));
        $hari = self::nama_hari($tanggal);
        $tgl = (int) $tgl;
        $bln = self::nama_bulan($tanggal);

        return $hari.', '.$tgl.' '.$bln.' '.$thn;
    }

    public static function hari_tanggal_jam($tanggal = '', $sep = ' pukul '): string
    {
        if ($tanggal === '') {
            $tanggal = date('Y-m-d H:i:s');
        }

        return self::hari_tanggal($tanggal).$sep.date('H:i', strtotime($tanggal));
    }

    public static function ddmmy($tanggal = 'now', $sep = '/', $full_year = true)
    {
        if ($tanggal === null || $tanggal === '0000-00-00') {
            return '';
        }
        if ($tanggal === 'now') {
            $tanggal = date('Y-m-d');
        }
        $tanggal = strtotime($tanggal);
        $y_format = $full_year ? 'Y' : 'y';

        return date('d'.$sep.'m'.$sep.$y_format, $tanggal);
    }

    public static function dmyhi($tanggal = 'now', $sep = '/', $full_year = true)
    {
        if ($tanggal === null || $tanggal === '0000-00-00') {
            return '';
        }
        if ($tanggal === 'now') {
            $tanggal = date('Y-m-d H:i:s');
        }
        $tanggal = strtotime($tanggal);
        $y_format = $full_year ? 'Y' : 'y';

        return date('d'.$sep.'m'.$sep.$y_format.' H:i', $tanggal);
    }

    public static function ymdhis($tanggal = '', $sep = '/', $inc_time = true)
    {
        if ($tanggal === '') {
            return date('Y-m-d H:i:s');
        }

        [$date, $time] = array_pad(explode(' ', $tanggal), 2, date('H:i'));
        $pecah = explode($sep, $date);
        $d = self::add_nol($pecah[0], 2);
        $m = self::add_nol($pecah[1], 2);
        $y = $pecah[2];
        $ret = $y.'-'.$m.'-'.$d;
        if ($inc_time) {
            $ret .= ' '.$time.':00';
        }

        return $ret;
    }

    public static function dmy2ymd($dmy, $dmy_sep = '/'): string
    {
        [$d, $m, $y] = array_pad(explode($dmy_sep, $dmy), 3, '00');

        return "{$y}-{$m}-{$d}";
    }

    public static function year_range($start = '', $end = '')
    {
        $year1 = self::getYear($start);
        $year2 = self::getYear($end);
        $arr = range($year1, $year2);

        return array_combine($arr, $arr);
    }

    /**
     * @param  mixed  $start
     *
     * @return mixed
     */
    private static function getYear(mixed $start): mixed
    {
        if (strlen($start) < 4) {
            if (str_starts_with($start, '+')) {
                $year = date('Y').substr($start, 1, strlen($start));
            } elseif (str_starts_with($start, '-')) {
                $year = date('Y') - substr($start, 1, strlen($start));
            } elseif ($start === '0') {
                $year = date('Y');
            }
        } else {
            $year = $start;
        }

        return $year;
    }

    public static function date_range($unix_start = '', $mixed = '', $is_unix = true, $format = 'Y-m-d')
    {
        if ($unix_start === '' or $mixed === '' or $format === '') {
            return false;
        }

        $is_unix = !(!$is_unix or $is_unix === 'days');

        if ((!ctype_digit((string) $unix_start) && ($unix_start = @strtotime($unix_start)) === false)
            || (!ctype_digit((string) $mixed) && ($is_unix === false || ($mixed = @strtotime($mixed)) === false))
            || ($is_unix === true && $mixed < $unix_start)
        ) {
            return false;
        }

        if ($is_unix && ($unix_start === $mixed or date($format, $unix_start) === date($format, $mixed))) {
            return [date($format, $unix_start)];
        }

        $range = [];
        $from = new DateTime();

        if (self::is_php('5.3')) {
            $from->setTimestamp($unix_start);
            if ($is_unix) {
                $arg = new DateTime();
                $arg->setTimestamp($mixed);
            } else {
                $arg = (int) $mixed;
            }

            $period = new DatePeriod($from, new DateInterval('P1D'), $arg);
            foreach ($period as $date) {
                $range[] = $date->format($format);
            }

            if (!is_int($arg) && $range[count($range) - 1] !== $arg->format($format)) {
                $range[] = $arg->format($format);
            }

            return $range;
        }

        $from->setDate(date('Y', $unix_start), date('n', $unix_start), date('j', $unix_start));
        $from->setTime(date('G', $unix_start), date('i', $unix_start), date('s', $unix_start));
        if ($is_unix) {
            $arg = new DateTime();
            $arg->setDate(date('Y', $mixed), date('n', $mixed), date('j', $mixed));
            $arg->setTime(date('G', $mixed), date('i', $mixed), date('s', $mixed));
        } else {
            $arg = (int) $mixed;
        }
        $range[] = $from->format($format);

        if (is_int($arg)) // Day intervals
        {
            do {
                $from->modify('+1 day');
                $range[] = $from->format($format);
            } while (--$arg > 0);
        } else // end date UNIX timestamp
        {
            for ($from->modify('+1 day'), $end_check = $arg->format('Ymd'); $from->format('Ymd') < $end_check; $from->modify('+1 day')) {
                $range[] = $from->format($format);
            }

            $range[] = $arg->format($format);
        }

        return $range;
    }

    public static function switchIcon($id): string
    {
        return match ($id) {
            1 => '<i class="bx bx-restaurant d-block"></i>',
            2 => '<i class="bx bx-hotel d-block"></i>',
            3 => '<i class="bx bx-layer d-block"></i>',
            4 => '<i class="bx bx-wrench d-block"></i>',
            5 => '<i class="bx bx-bulb d-block"></i>',
            default => '',
        };
    }

    public static function setBadgeColor($status): string
    {
        return match ($status) {
            1 => 'success',
            2 => 'warning',
            3 => 'danger',
            '' => 'info'
        };
    }

    public static function getModelInstance($model)
    {
        $modelNamespace = "App\\Models\\";

        return app($modelNamespace.$model);
    }

    public static function switchBadge($id)
    {
        return match ($id) {
            1 => 'danger',
            2 => 'success',
            3 => 'info',
            4 => 'warning',
            5 => 'primary',
            default => '',
        };
    }

    public static function hitung_pajak($nilai, $pajak)
    {
        $nilai ??= 0;
        $pajak ??= 0;

        return $nilai * ($pajak / 100) ?? 0.00;
    }

    public static function add_nol($str, $jumnol = 2)
    {
        if (strlen($str) > $jumnol) {
            return $str;
        } else {
            $res = '';
            $n = $jumnol - strlen($str);
            $res .= str_repeat('0', $n);

            return $res.$str;
        }
    }

    public static function convertDateFromString($date, $toDate = false)
    {
        $date ??= '';
        Date::setLocale('id');
        if (!$toDate) {
            return Date::parse($date)->timezone(config('app.timezone'))->locale('id')->toDateTime();
        }

        return Date::parse($date)->timezone(config('app.timezone'))->locale('id')->toDate();

    }

    public static function convertTglFromString($date)
    {
        $date = is_string($date) ? $date : '';
        Carbon::setLocale(config('app.locale'));
        $date = explode(' ', $date);
        $tgl = $date[0];

        return Carbon::parse($tgl)->timezone(config('app.timezone'))->locale('id')->format('d/m/Y');

    }

    public static function format_indonesia($nilai, $koma = false): string
    {
        if ($koma) {
            return 'Rp. '.number_format($nilai, 2, ',', '.');
        }

        return 'Rp. '.number_format($nilai, 0, ',', '.');
    }

    public static function format_angka($angka, $empty_val = '0')
    {
        $angka = self::ribuan($angka);

        return empty($angka) ? $empty_val : $angka;
    }

    public static function ribuan($num = 0, $decimal = 'auto 2')
    {
        if (empty($num)) {
            return '0';
        }
        $auto = false;
        if (str_starts_with($decimal, 'auto')) {
            [, $decimal] = explode(' ', $decimal);
            $auto = true;
        }
        $num = number_format($num, $decimal, ',', '.');
        if ($auto) {
            $num = str_replace(',00', '', $num);
        }
        return $num;
    }

    public static function swap($locale){
        // available language in template array
//        $availLocale=['en'=>'en','id'=>'id'];
        $availLocale=['en'=>'en','id'=>'id'];
        // check for existing language
        if(array_key_exists($locale, $availLocale)){
            session()->put('locale', $locale);
        }
        return redirect()->back();
    }

    public static function applClasses(): array
    {
        // default data array
        $DefaultData = [
            'mainLayoutType' => 'vertical',
            'theme' => setting('theme', 'light'),
            'sidebarCollapsed' => setting('sidebarCollapsed', false),
            'navbarColor' => setting('navbarColor', ''),
            'horizontalMenuType' => 'floating',
            'verticalMenuNavbarType' => setting('verticalMenuNavbarType', 'floating'),
            'footerType' => setting('footerType', 'static'), //footer
            'layoutWidth' => 'boxed',
            'showMenu' => true,
            'bodyClass' => '',
            'pageClass' => '',
            'pageHeader' => true,
            'contentLayout' => 'default',
            'blankPage' => false,
            'defaultLanguage' => 'id',
            'direction' => env('MIX_CONTENT_DIRECTION', 'ltr'),
        ];

        // if any key missing of array from custom.php file it will be merge and set a default value from dataDefault array and store in data variable
        $data = array_merge($DefaultData, config('custom.custom'));

        // All options available in the template
        $allOptions = [
            'mainLayoutType' => ['vertical', 'horizontal'],
            'theme' => ['light' => 'light', 'dark' => 'dark-layout', 'bordered' => 'bordered-layout', 'semi-dark' => 'semi-dark-layout'],
            'sidebarCollapsed' => [true, false],
            'showMenu' => [true, false],
            'layoutWidth' => ['full', 'boxed'],
            'navbarColor' => ['bg-primary', 'bg-info', 'bg-warning', 'bg-success', 'bg-danger', 'bg-dark'],
            'horizontalMenuType' => ['floating' => 'navbar-floating', 'static' => 'navbar-static', 'sticky' => 'navbar-sticky'],
            'horizontalMenuClass' => ['static' => '', 'sticky' => 'fixed-top', 'floating' => 'floating-nav'],
            'verticalMenuNavbarType' => ['floating' => 'navbar-floating', 'static' => 'navbar-static', 'sticky' => 'navbar-sticky', 'hidden' => 'navbar-hidden'],
            'navbarClass' => ['floating' => 'floating-nav', 'static' => 'navbar-static-top', 'sticky' => 'fixed-top', 'hidden' => 'd-none'],
            'footerType' => ['static' => 'footer-static', 'sticky' => 'footer-fixed', 'hidden' => 'footer-hidden'],
            'pageHeader' => [true, false],
            'contentLayout' => ['default', 'content-left-sidebar', 'content-right-sidebar', 'content-detached-left-sidebar', 'content-detached-right-sidebar'],
            'blankPage' => [false, true],
            'sidebarPositionClass' => [
                'content-left-sidebar' => 'sidebar-left', 'content-right-sidebar' => 'sidebar-right', 'content-detached-left-sidebar' => 'sidebar-detached sidebar-left',
                'content-detached-right-sidebar' => 'sidebar-detached sidebar-right', 'default' => 'default-sidebar-position',
            ],
            'contentsidebarClass' => [
                'content-left-sidebar' => 'content-right', 'content-right-sidebar' => 'content-left', 'content-detached-left-sidebar' => 'content-detached content-right',
                'content-detached-right-sidebar' => 'content-detached content-left', 'default' => 'default-sidebar',
            ],
            'defaultLanguage' => ['en' => 'en', 'id' => 'id'],
            'direction' => ['ltr', 'rtl'],
        ];

        //if mainLayoutType value empty or not match with default options in custom.php config file then set a default value
        foreach ($allOptions as $key => $value) {
            if (array_key_exists($key, $DefaultData)) {
                if (gettype($DefaultData[$key]) === gettype($data[$key])) {
                    // data key should be string
                    if (is_string($data[$key])) {
                        // data key should not be empty
                        if (isset($data[$key]) && $data[$key] !== null) {
                            // data key should not be exist inside allOptions array's sub array
                            if (!array_key_exists($data[$key], $value)) {
                                // ensure that passed value should be match with any of allOptions array value
                                $result = array_search($data[$key], $value, 'strict');
                                if (empty($result) && $result !== 0) {
                                    $data[$key] = $DefaultData[$key];
                                }
                            }
                        } else {
                            // if data key not set or
                            $data[$key] = $DefaultData[$key];
                        }
                    }
                } else {
                    $data[$key] = $DefaultData[$key];
                }
            }
        }

        //layout classes
        $layoutClasses = [
            'theme' => $data['theme'],
            'layoutTheme' => $allOptions['theme'][$data['theme']],
            'sidebarCollapsed' => $data['sidebarCollapsed'],
            'showMenu' => $data['showMenu'],
            'layoutWidth' => $data['layoutWidth'],
            'verticalMenuNavbarType' => $allOptions['verticalMenuNavbarType'][$data['verticalMenuNavbarType']],
            'navbarClass' => $allOptions['navbarClass'][$data['verticalMenuNavbarType']],
            'navbarColor' => $data['navbarColor'],
            'horizontalMenuType' => $allOptions['horizontalMenuType'][$data['horizontalMenuType']],
            'horizontalMenuClass' => $allOptions['horizontalMenuClass'][$data['horizontalMenuType']],
            'footerType' => $allOptions['footerType'][$data['footerType']],
            'sidebarClass' => '',
            'bodyClass' => $data['bodyClass'],
            'pageClass' => $data['pageClass'],
            'pageHeader' => $data['pageHeader'],
            'blankPage' => $data['blankPage'],
            'blankPageClass' => '',
            'contentLayout' => $data['contentLayout'],
            'sidebarPositionClass' => $allOptions['sidebarPositionClass'][$data['contentLayout']],
            'contentsidebarClass' => $allOptions['contentsidebarClass'][$data['contentLayout']],
            'mainLayoutType' => $data['mainLayoutType'],
            'defaultLanguage' => $allOptions['defaultLanguage'][$data['defaultLanguage']],
            'direction' => $data['direction'],
        ];
        // set default language if session hasn't locale value the set default language
        if (!session()->has('locale')) {
            app()->setLocale($layoutClasses['defaultLanguage']);
        }

        // sidebar Collapsed
        if ($layoutClasses['sidebarCollapsed'] == 'true') {
            $layoutClasses['sidebarClass'] = "menu-collapsed";
        }

        // blank page class
        if ($layoutClasses['blankPage'] == 'true') {
            $layoutClasses['blankPageClass'] = "blank-page";
        }

        return $layoutClasses;
    }

    public static function updatePageConfig($pageConfigs)
    {
        $demo = 'custom';
        if (isset($pageConfigs)) {
            if (count($pageConfigs) > 0) {
                foreach ($pageConfigs as $config => $val) {
                    Config::set('custom.'.$demo.'.'.$config, $val);
                }
            }
        }
    }
}
