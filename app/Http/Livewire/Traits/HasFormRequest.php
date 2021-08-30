<?php

namespace App\Http\Livewire\Traits;

trait HasFormRequest {

    public array $rules = [];
    public array $messages = [];

    public function mountHasFormRequest(): void
    {
        $this->formRequest = new $this->formRequest();
        $this->rules = $this->formRequest->rules();
        $this->messages = $this->formRequest->messages();
    }
}