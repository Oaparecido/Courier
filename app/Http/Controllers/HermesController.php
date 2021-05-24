<?php

namespace App\Http\Controllers;

use App\Services\MailService;
use Illuminate\Http\Request;

class HermesController extends Controller
{
    public function send()
    {
        return Hermes::dispatcher(MailService);
    }
}
