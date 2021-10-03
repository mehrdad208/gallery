<?php

namespace App\Services\Payment\Providers;

use App\Services\Payment\Contracts\AbstractProviderInterface;
use App\Services\Payment\Contracts\PayableInterface;
use App\Services\Payment\Contracts\VerifaibleInterface;
use Ramsey\Collection\Map\AbstractMap;

class IDPayProvider extends AbstractProviderInterface implements payableInterface, verifaibleInterface
{
    public function pay()
    {
    }
    public function verify()
    {
    }
}
