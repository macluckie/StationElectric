<?php

namespace App\Security;

use Symfony\Component\HttpFoundation\Request;

interface ClientHttpInterface {
    public function urlAUTH();
    public function getTokenAccess(Request $request);
}