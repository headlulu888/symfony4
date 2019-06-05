<?php

namespace App\Services;


class TestService
{
    private  $kyrs = 60;

    public function convert($rub)
    {
        return $rub / $this->kyrs;
    }
}