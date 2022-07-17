<?php

namespace App\Concerns;

trait HasPayment
{
    public int $totalPembayaran;

    public int $totalPiutang;

    public int $totalTagihan;

    public int $totalSisa;

    public int $totalPembayaranLunas;

    public int $totalPembayaranBatal;

    public int $totalPembayaranSebagian;

    public function __construct()
    {
        $this->totalPembayaran = 0;
        $this->totalPembayaranLunas = 0;
        $this->totalPembayaranBatal = 0;
        $this->totalPembayaranSebagian = 0;
        $this->totalPiutang = 0;
        $this->totalTagihan = 0;
        $this->totalSisa = 0;
    }

    public function getTotalPembayaran(): int
    {
        return $this->totalPembayaran;
    }

    public function getTotalPiutang(): int
    {
        return $this->totalPiutang;
    }

    public function getTotalTagihan(): int
    {
        return $this->totalTagihan;
    }

    public function getTotalSisa(): int
    {
        return $this->totalSisa;
    }

    public function getTotalPembayaranLunas(): int
    {
        return $this->totalPembayaranLunas;
    }

    public function getTotalPembayaranBatal(): int
    {
        return $this->totalPembayaranBatal;
    }

    /**
     * @param  int  $totalPembayaran
     */
    public function setTotalPembayaran(int $totalPembayaran): void
    {
        $this->totalPembayaran = $totalPembayaran;
    }

    /**
     * @param  int  $totalPiutang
     */
    public function setTotalPiutang(int $totalPiutang): void
    {
        $this->totalPiutang = $totalPiutang;
    }

    /**
     * @param  int  $totalTagihan
     */
    public function setTotalTagihan(int $totalTagihan): void
    {
        $this->totalTagihan = $totalTagihan;
    }

    /**
     * @param  int  $totalPembayaranBatal
     */
    public function setTotalPembayaranBatal(int $totalPembayaranBatal): void
    {
        $this->totalPembayaranBatal = $totalPembayaranBatal;
    }

    /**
     * @param  int  $totalPembayaranLunas
     */
    public function setTotalPembayaranLunas(int $totalPembayaranLunas): void
    {
        $this->totalPembayaranLunas = $totalPembayaranLunas;
    }

    /**
     * @param  int  $totalPembayaranSebagian
     */
    public function setTotalPembayaranSebagian(int $totalPembayaranSebagian): void
    {
        $this->totalPembayaranSebagian = $totalPembayaranSebagian;
    }
}
