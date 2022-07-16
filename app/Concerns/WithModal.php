<?php

namespace App\Concerns;

trait WithModal
{
    public string $modalId = 'modal-catatmeter';
    public bool $show = true;
    public array $options = [];

    public function sendNotifikasi($model, $message): void
    {
        if ($model) {
            $this->alert('success', $message.' Berhasil Disimpan');
        } else {
            $this->alert('danger', $message.' Gagal Disimpan');
        }
    }

    private function closeModal(): void
    {
        $this->dispatchBrowserEvent('closeModal', $this->options);
    }

    private function openModal(): void
    {
        $this->dispatchBrowserEvent('openModal', $this->options);
    }
}
