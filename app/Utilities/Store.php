<?php

namespace App\Utilities;

class Store
{
    private $mid = '';

    private $name = '';

    private $address = '';

    private $phone = '';

    private $email = '';

    private $website = '';

    private $kodePengunjung = '';

    private $kodeKendaraan = '';

    public function __construct($mid, $name, $address, $phone, $email, $website, $kodePengunjung, $kodeKendaraan)
    {
        $this->mid = $mid;
        $this->name = $name;
        $this->address = $address;
        $this->phone = $phone;
        $this->email = $email;
        $this->website = $website;
        $this->kodePengunjung = $kodePengunjung;
        $this->kodeKendaraan = $kodeKendaraan;
    }

    public function getMID()
    {
        return $this->mid;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getWebsite()
    {
        return $this->website;
    }

    public function getKodeKendaraan()
    {
        return $this->kodeKendaraan;
    }

    public function getKodePengunjung()
    {
        return $this->kodePengunjung;
    }
}
