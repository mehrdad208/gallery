<?php
namespace App\Services\Payment;

use App\Services\Payment\Requests\IdPayRequest;
use  App\Services\Payment\Providers\IDPayProvider;
use App\Services\Payment\Contracts\RequestInterface;
use App\Services\Payment\Exception\ProviderNotFoundException;
use Exception;

class PaymentService
{
    public const IDPAY='IDPayProvider';
    public const ZARINPAL='ZarinpalProvider';
 
    public function __construct( private string $providerName,private RequestInterface $request)
    {

    }
    public function pay()
    {
     $this->findProvider()->pay();   

    }
    private function findProvider()
    {
        $className='App\Services\Payment\Providers\\'.$this->providerName;
        if(!class_exists($className)){
            throw new ProviderNotFoundException('درگاه پرداخت انتخاب شده یافت نشد.');
        }
        return new $className($this->request);

    }
}



// $idPayRequest=new IDPayRequest();
// $paymentService=new PaymentService(PaymentService::IDPAY,$idPayRequest);