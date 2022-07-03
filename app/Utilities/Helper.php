<?php

namespace App\Utilities;

use Akaunting\Money\Money;
use App\Models\JenisObjekPajak;
use App\Models\JenisTarif;
use App\Models\ObjekPajak;
use App\Models\Pembayaran;
use App\Models\Wilayah;
use DateInterval;
use DatePeriod;
use DateTime;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Date;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Str;

class Helper
{
    public static function periodePembayaran($id): string
    {
        switch ($id) {
            case 1:
                return "Hari";
                break;
            case 2:
                return 'Minggu';
                break;
            default:
                return 'Tahun';
        }
//        return match ($id) {
//            1 => 'Hari',
//            2 => 'Minggu',
//            default => 'Tahun',
//        };
    }

    public static function getTriwulan($id): string
    {
        switch ($id) {
            case 'pertama':
                return 'Triwulan Pertama';
                break;
            case 'kedua':
                return 'Triwulan Kedua';
                break;
            case 'ketiga':
                return 'Triwulan Ketiga';
                break;
            case 'keempat':
                return 'Triwulan Keempat';
                break;
            default:
                return '';
        }
//        return match ($id) {
//            'pertama' => 'Triwulan Pertama',
//            'kedua' => 'Triwulan Kedua',
//            'ketiga' => 'Triwulan Ketiga',
//            'keempat' => 'Triwulan Keempat',
//            default => '',
//        };
    }

    public static function generateNoTransaksi($length = 8, $pad = '0'): string
    {
        $max = Pembayaran::max('id') + 1;
        $pad = Str::padLeft($max, (int) $length, $pad);

        $format = setting('format_no_transaksi');
        $delimiter = setting('pemisah');

        return $format.$delimiter.$pad;
    }


    public static function generateNomorSts($id, $bayarId)
    {
        $bayarId = $bayarId ?? 0;
        $maxNumber = Pembayaran::max('id') + 1;
        $shortcode = JenisObjekPajak::getShortcodeObjekPajak($id);
        $number = Str::padLeft($maxNumber, 5, '0');
        $tahun = setting('tahun_sppt');
        $kodeProv = setting('kode_provinsi');

        return $shortcode.'-'.$tahun.$kodeProv.$bayarId.$number;
    }

    public static function generateNomorStsOp($id, $opid = 1, $delimiter = '/', $length = 5, $pad = '0')
    {
        $maxNumber = ObjekPajak::max('id') + 1;
        $padNum = Str::padLeft($maxNumber, (int) $length, $pad);
        $shortcode = JenisObjekPajak::getShortcodeObjekPajak($id);
        $sts = self::convertToRoman($id);
        $bulan = self::convertToRoman(setting('masa_pajak_bulan', now()->month));
        $tahun = setting('tahun_sppt');

        // Format (I/bln/thn/kodeobjekpajak/autonumber)
        return $sts.$delimiter.'STS'.$delimiter.$bulan.$delimiter.$tahun.$delimiter.$shortcode.$delimiter.$opid.$padNum;
    }


    public static function generateNomorSkpd($id, $bayarId, int $bulan, $tahun, $delimiter = '/', $length = 5, $pad = '0'): string
    {
        $bayarId = $bayarId ?? 0;
        $shortcode = JenisObjekPajak::getShortcodeObjekPajak($id);
        $max = Pembayaran::max('id') + 1;
        $pad = Str::padLeft($max, (int) $length, $pad);

        $skpd = self::convertToRoman(1);
        $bln = self::convertToRoman($bulan) ?: self::convertToRoman(setting('masa_pajak_bulan', now()->month));
        $tahun = $tahun ? $tahun : setting('tahun_sppt');

        return $skpd.$delimiter.$bln.$delimiter.$tahun.$delimiter.$shortcode.$delimiter.$bayarId.$pad;
    }

    public static function generateNomorSkpdOp($id, $opid = 1, $delimiter = '/', $length = 5, $pad = '0'): string
    {
        $shortcode = JenisObjekPajak::getShortcodeObjekPajak($id);
        $max = ObjekPajak::max('id') + 1;
        $padNum = Str::padLeft($max, (int) $length, $pad);
        $skpd = self::convertToRoman($id);
        $bulan = self::convertToRoman(setting('masa_pajak_bulan', now()->month));
        $tahun = setting('tahun_sppt');

        return $skpd.$delimiter.'SKPD'.$delimiter.$bulan.$delimiter.$tahun.$delimiter.$shortcode.$delimiter.$opid.$padNum;
    }

    /**
     * Convert Number to Roman
     *
     * @param  integer  $integer
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
            'M'  => 1000,
            'CM' => 900,
            'D'  => 500,
            'CD' => 400,
            'C'  => 100,
            'XC' => 90,
            'L'  => 50,
            'XL' => 40,
            'X'  => 10,
            'IX' => 9,
            'V'  => 5,
            'IV' => 4,
            'I'  => 1,
        ];

        foreach ($lookup as $roman => $value) {
            // Determine the number of matches
            $matches = intval($integer / $value);

            // Add the same number of characters to the string
            $result .= str_repeat($roman, $matches);

            // Set the integer to be the remainder of the integer and the value
            $integer = $integer % $value;
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

    public static function getAvatar()
    {
        $avatar = auth()->user()->avatar;

        return (isset($avatar) && $avatar != '') ? $avatar : asset('assets/images/users/default.png');
    }

    public static function isWajibPajak(): bool
    {
        return auth()->user()->getRoleNames()[0] === 'user';
    }

    public static function isSuperadmin(): bool
    {
        return auth()->user()->getRoleNames()[0] === 'superadmin';
    }

    public static function isAdmin(): bool
    {
        return auth()->user()->getRoleNames()[0] === 'admin';
    }

    public static function isOperator(): bool
    {
        return auth()->user()->getRoleNames()[0] === 'operator';
    }

    public static function getWilayah($kode)
    {
        return Wilayah::getWilayah($kode);
    }

    public static function getNamaWilayah($kode)
    {
        return Wilayah::getWilayahName($kode)->nama;
    }

    public static function getNamaJenisObjekPajak($id, $short = false)
    {
        return JenisObjekPajak::getNamaJenisObjekPajak($id, $short);
    }

    public static function getListJenisObjekPajak()
    {
        return JenisObjekPajak::all();
    }

    public static function getNamaStatusBayar($kode)
    {
        switch ($kode){
            case '0':
                $nama = 'Belum Lunas';
                break;
            case '1':
                $nama = 'Lunas';
                break;
            default:
                $nama = 'N/A';
                break;
        }

        return $nama;

//        return $kode === 0 ? 'Belum Lunas' : 'Lunas';
    }

    public static function getAlertColor($kode)
    {
        switch ($kode) {
            case 1 :
                $alert = 'success';
                break;
            case 2 :
                $alert = 'danger';
                break;
            case 3:
                $alert = 'info';
                break;
            case 4 :
                $alert = 'warning';
                break;
            case 5 :
                $alert = 'primary';
                break;
            default:
                $alert = 'danger';
        }

        return $alert;
    }

    public static function getNamaStatusTransaksi($kode)
    {
        switch ($kode) {
            case 1:
                return 'Lancar';
                break;
            case 2:
                return 'Menunggak';
                break;
            default:
                return '-';
                break;
        }
    }

    public static function setTglJatuhTempo($jenisOp, $periode, $date)
    {
        if ($jenisOp === 3 && isset($periode) || $periode > 0) {
            if ($periode === 1) {
                $tglJatuhTempo = \Carbon\Carbon::parse(now())->addDays(1);
            } elseif ($periode === 2) {
                $tglJatuhTempo = Carbon::parse(now())->addDays(7);
            } else {
                $tglJatuhTempo = Carbon::parse(now())->addDays(365);
            }
        } elseif ($jenisOp === 4 && isset($date)) {
            $tglJatuhTempo = \Carbon\Carbon::parse($date ?? now())->addDays(Helper::jumlah_hari(now()));
        } else {
            $tglJatuhTempo = null;
        }

        return $tglJatuhTempo;
    }

    public static function setJatuhTempoByDate($date)
    {
        $date = $date ?: now();
        return \Carbon\Carbon::parse($date)->addDays(static::jumlah_hari(now()));
    }

    public static function getNamaStatusAktif($kode)
    {
        return $kode === 0 ? 'Tidak Aktif' : 'Aktif';
    }

    public static function getCountByWajibPajak($wpid, $opid = null)
    {
        return Pembayaran::getCountByWajibPajak($wpid, $opid);
    }

    public static function hitungPajakReklame($jenisTarif, $nilai = 0, $njopr = 0, $format = false)
    {
        $tarif = JenisTarif::find($jenisTarif);

        if (!is_null($tarif)) {
            $nilaiTarif = $tarif->nilai === '25%' ? 25 / 100 : 20 / 100;
        } else {
            $nilaiTarif = 0.00;
        }

        $nilaiStrategis = $nilai > 0 ? $nilai : 0;
        $njopr = $njopr > 0 ? $njopr : 0;

        $ns = ((double) $nilaiStrategis + (double) $njopr) * $nilaiTarif;

        if ($format) {
            return Money::IDR($ns);
        }

        return $ns;
    }

    public static function hitungPajakBillboard($nilai, $panjang, $lebar, $format = false)
    {
        $nilai = $nilai > 0 ? $nilai : 0;
        $panjang = (int) $panjang;
        $lebar = (int) $lebar;

        if ($format) {
            return Money::IDR($nilai * ($panjang * $lebar));
        }

        return (double) $nilai * ($panjang * $lebar);
    }

    public static function hitungPajakKuantiti($nilai, $kuantiti, $format = false)
    {
        $nilai = $nilai > 0 ? $nilai : 0;
        $kuantiti = (int) $kuantiti;

        if ($format) {
            return Money::IDR($nilai * $kuantiti);
        }

        return (double) $nilai * $kuantiti;
    }

    public static function getNamaBulan($date, $backMonth = false)
    {
        if ($backMonth) {
            return Carbon::parse($date)->locale(config('app.locale'))->subDays(30)->format('F');
        }

        return Carbon::parse($date ?: now())->locale(config('app.locale'))->format('F');
    }

    public static function terbilang($x, $style = 4): string
    {
        if ($x < 0) {
            $hasil = 'minus '.trim(static::kekata($x));
        } else {
            $hasil = trim(static::kekata($x));
        }

        switch ($style) {
            case 1:
                return strtoupper($hasil);
                break;
            case 2:
                return strtolower($hasil);
                break;
            case 3:
                return ucwords($hasil);
                break;
            default:
                return ucfirst($hasil);
        }

//        return match ($style) {
//            1 => strtoupper($hasil),
//            2 => strtolower($hasil),
//            3 => ucwords($hasil),
//            default => ucfirst($hasil),
//        };
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

    public static function nama_hari($tanggal = '')
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

    public static function getNamaBulanIndo($bln)
    {
        $bln = !is_null($bln) ? $bln : setting('masa_pajak_bulan');
        switch ($bln) {
            case '1':
                return 'Januari';
                break;
            case '2':
                return 'Februari';
                break;
            case '3':
                return 'Maret';
                break;
            case '4':
                return 'April';
                break;
            case '5':
                return 'Mei';
                break;
            case '6':
                return 'Juni';
                break;
            case '7':
                return 'Juli';
                break;
            case '8':
                return 'Agustus';
                break;
            case '9':
                return 'September';
                break;
            case '10':
                return 'Oktober';
                break;
            case '11':
                return 'November';
                break;
            case '12':
                return 'Desember';
                break;
            default:
                return 'Tidak ada';
        }

//        return match ($bln) {
//            '1' => 'Januari',
//            '2' => 'Februari',
//            '3' => 'Maret',
//            '4' => 'April',
//            '5' => 'Mei',
//            '6' => 'Juni',
//            '7' => 'Juli',
//            '8' => 'Agustus',
//            '9' => 'September',
//            '10' => 'Oktober',
//            '11' => 'November',
//            '12' => 'Desember',
//            default => 'Tidak ada'
//        };
    }

    public static function list_bulan($short = false): array
    {
        if ($short) {
            $bln = [
                '1'  => 'Jan',
                '2'  => 'Feb',
                '3'  => 'Mar',
                '4'  => 'Apr',
                '5'  => 'Mei',
                '6'  => 'Jun',
                '7'  => 'Jul',
                '8'  => 'Agu',
                '9'  => 'Sep',
                '10' => 'Okt',
                '11' => 'Nov',
                '12' => 'Des',
            ];
        } else {
            $bln = [
                '1'  => 'Januari',
                '2'  => 'Februari',
                '3'  => 'Maret',
                '4'  => 'April',
                '5'  => 'Mei',
                '6'  => 'Juni',
                '7'  => 'Juli',
                '8'  => 'Agustus',
                '9'  => 'September',
                '10' => 'Oktober',
                '11' => 'November',
                '12' => 'Desember',
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

    public static function index_nama_bulan($nama_bulan = '', $short = false)
    {
        $list_bulan = self::list_bulan($short);

        return array_search($nama_bulan, $list_bulan, null);
    }

    public static function tanggal($tanggal = 'now', $short_month = false, $empty_val = '')
    {
        $null = ['', '0000-00-00', '0000-00-00 00:00:00', '1970-01-01', null];
        if (in_array($tanggal, $null)) {
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

    public static function tanggal_jam($tanggal = '', $sep = ' - ')
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

    public static function hari_tanggal_jam($tanggal = '', $sep = ' pukul ')
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

    public static function xtime($ymdhis = ''): string
    {
        if (!$ymdhis or $ymdhis === '0000-00-00 00:00:00') {
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
        } elseif ($selmenit < 50) {
            return $selmenit.' menit yang lalu';
        } elseif ($seljam < 4) {
            return $seljam.' jam yang lalu';
        } elseif ($seljam < 24) {
            return 'Hari ini pukul '.$pukul;
        } elseif ($seljam < 48) {
            return 'Kemarin pukul '.$pukul;
        } elseif (date('W', $ago) === date('W', $now)) {
            return $nama_hari.' '.$pukul;
        } elseif (date('Y', $ago) === date('Y', $now)) {
            return $tgl.' '.$nama_bulan.' '.$pukul;
        } else {
            return static::tanggal_jam($ymdhis);
        }
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

    public static function list_tanggal(): array
    {
        $day = [];
        for ($i = 1; $i <= 31; $i++) {
            $day[$i] = $i;
        }

        return $day;
    }

    public static function to_persen($jumlah, $total)
    {
        if (!isset($jumlah, $total)) {
            return 0;
        }

        if (!is_double($jumlah) || !is_double($total)) {
            $jumlah = (double) $jumlah;
            $total = (double) $total;
        }

        $round = round(((double) $jumlah / (double) $total) * 100, 2);
        if ($round > 100) {
            $round = 100;
        }

//        dd($jumlah, $total, $round);
        return $round.'%';
//        return round(($jumlah / $total) * 100, 2).'%';

    }

    public static function switchIcon($id): string
    {
        switch ($id) {
            case 1:
                return '<i class="bx bx-restaurant d-block"></i>';
                break;
            case 2:
                return '<i class="bx bx-hotel d-block"></i>';
                break;
            case 3:
                return '<i class="bx bx-layer d-block"></i>';
                break;
            case 4:
                return '<i class="bx bx-wrench d-block"></i>';
                break;
            case 5:
                return '<i class="bx bx-bulb d-block"></i>';
                break;
            default:
                return '';
        }

//        return match ($id) {
//            1 => '<i class="bx bx-restaurant d-block"></i>',
//            2 => '<i class="bx bx-hotel d-block"></i>',
//            3 => '<i class="bx bx-layer d-block"></i>',
//            4 => '<i class="bx bx-wrench d-block"></i>',
//            5 => '<i class="bx bx-bulb d-block"></i>',
//            default => '',
//        };
    }

    public static function getModelInstance($model)
    {
        $modelNamespace = "App\\Models\\";

        return app($modelNamespace.$model);
    }

    public static function switchBadge($id)
    {
        switch ($id) {
            case 1 :
                return 'danger';
                break;
            case 2 :
                return 'success';
                break;
            case 3 :
                return 'info';
                break;
            case 4 :
                return 'warning';
                break;
            case 5 :
                return 'primary';
                break;
            default:
                return '';

        }
//        return match ($id) {
//            1 => 'danger',
//            2 => 'success',
//            3 => 'info',
//            4 => 'warning',
//            5 => 'primary',
//            default => '',
//        };
    }

    public static function convertDateFromString($date, $toDate = false)
    {
        $date = $date ?? '';
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

    public static function hitung_pajak($nilai, $pajak)
    {
        $nilai = $nilai ?? 0;
        $pajak = $pajak ?? 0;

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

    /**
     * Determines if the current version of PHP is equal to or greater than the supplied value
     *
     * @param  string
     *
     * @return    bool    TRUE if the current version is $version or higher
     */
    public static function is_php($version): bool
    {
        static $_is_php;
        $version = (string) $version;

        if (!isset($_is_php[$version])) {
            $_is_php[$version] = version_compare(PHP_VERSION, $version, '>=');
        }

        return $_is_php[$version];
    }

    public static function jumlah_hari($date)
    {
        $date = $date ?? now();

        return Carbon::parse($date)->daysInMonth;
    }

    public static function awal_bulan($date)
    {
        $date = $date ?? now();

        return Carbon::parse($date)->startOfMonth();
    }

    public static function akhir_bulan($date)
    {
        $date = $date ?? now();

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

    public static function selisihHari($date)
    {
        $date = !is_null($date) ? $date : null;
        if ($date) {
            $hari = \Carbon\Carbon::parse($date)->diffInDays(setting('tanggal_periode_pajak'));
        } else {
            $hari = null;
        }

        if ($hari <= 0) {
            return 'Sudah jatuh tempo';
        } else {
            return 'Sisa '.$hari;
        }
    }

    public static function selisihHari2($date, $format = false)
    {
        $tglBayar = strtotime(setting('tgl_periode_pajak'));
        $jt = strtotime($date);
        $now = strtotime(now());
        $diff = $jt - $now;
        $bedaHari = floor($diff / (60 * 60 * 24));
        if ($diff > 0) {
            if ($bedaHari < 3) {
                return  $format ? 'Dalam '.$bedaHari.' hari' : $bedaHari;
            } else {
                return $format ? 'Masih dalam '.$bedaHari.' hari' : $bedaHari;
            }
        } else {
            return $format ? 'Sudah lewat '.$bedaHari.' hari' : $bedaHari;
        }
    }

    public static function hitungPersentasePerbandinganPajak($wajibPajak, $objekPajak, $before, $now)
    {
        $nilaiPajak = 0;
        $pembayaran = Pembayaran::query()->with('objekpajak', 'wajibpajak')
            ->where('wajib_pajak_id', $wajibPajak)
            ->where('objek_pajak_id', $objekPajak);

        if ($before) {
            $pembayaran->where('bulan', $before)->get()->first();
            if (!is_null($pembayaran)) {
                $nilaiPajak = $pembayaran->nilai_pajak;
            }
        }

        if ($now) {
            $pembayaran->where('bulan', $now);
        }

        return $pembayaran->get();
    }
}
