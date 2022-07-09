<?php

namespace App\Concerns;

trait HasStat
{
    public int $totalPelanggan;
    public int $totalPelangganValid;
    public int $totalPelangganTidakValid;
    public int $totalPelangganAktif;
    public int $totalPelangganDitangguhkan;
    public int $totalPelangganDiDop;

    public function __construct()
    {
        parent::__construct();
        $this->totalPelanggan = 0;
        $this->totalPelangganAktif = 0;
        $this->totalPelangganDiDop = 0;
        $this->totalPelangganDitangguhkan = 0;
        $this->totalPelangganTidakValid = 0;
        $this->totalPelangganValid = 0;
    }

    public function getTotalPelanggan(): int
    {
        return $this->totalPelanggan;
    }

    public function getTotalPelangganValid(): int
    {
        return $this->totalPelangganValid;
    }

    public function getTotalPelangganTidakValid(): int
    {
        return $this->totalPelangganTidakValid;
    }

    public function getTotalPelangganAktif(): int
    {
        return $this->totalPelangganAktif;
    }

    public function getTotalPelangganDitangguhkan(): int
    {
        return $this->totalPelangganDitangguhkan;
    }

    public function getTotalPelangganDiDop(): int
    {
        return $this->totalPelangganDiDop;
    }

    /**
     * @param  int  $totalPelanggan
     */
    public function setTotalPelanggan(int $totalPelanggan): void
    {
        $this->totalPelanggan = $totalPelanggan;
    }

    /**
     * @param  int  $totalPelangganValid
     */
    public function setTotalPelangganValid(int $totalPelangganValid): void
    {
        $this->totalPelangganValid = $totalPelangganValid;
    }

    /**
     * @param  int  $totalPelangganAktif
     */
    public function setTotalPelangganAktif(int $totalPelangganAktif): void
    {
        $this->totalPelangganAktif = $totalPelangganAktif;
    }

    /**
     * @param  int  $totalPelangganDiDop
     */
    public function setTotalPelangganDiDop(int $totalPelangganDiDop): void
    {
        $this->totalPelangganDiDop = $totalPelangganDiDop;
    }

    /**
     * @param  int  $totalPelangganDitangguhkan
     */
    public function setTotalPelangganDitangguhkan(int $totalPelangganDitangguhkan): void
    {
        $this->totalPelangganDitangguhkan = $totalPelangganDitangguhkan;
    }

    /**
     * @param  int  $totalPelangganTidakValid
     */
    public function setTotalPelangganTidakValid(int $totalPelangganTidakValid): void
    {
        $this->totalPelangganTidakValid = $totalPelangganTidakValid;
    }

}
