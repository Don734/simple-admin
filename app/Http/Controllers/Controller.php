<?php

namespace App\Http\Controllers;

abstract class Controller
{
    public function alert(string $status, string $message): void
    {
        session()->flash($status, $message);
    }
}
