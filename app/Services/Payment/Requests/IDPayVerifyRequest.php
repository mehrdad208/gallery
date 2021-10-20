<?php

namespace App\Services\Payment\Requests;

use App\Services\Payment\Contracts\RequestInterface;

class IDPayVerifyRequest implements RequestInterface
{
    private $id;
    private $orderId;
    private $apiKey;



    public function __construct(array $data)
    {
        
        $this->orderId=$data['orderId'];
        $this->id=$data['id'];
        $this->apiKey=$data['apiKey'];

    }
    public function getApiKey(){
        return $this->apiKey;
    }
    public function getId(){
        return $this->Id;
    }
    public function getOrderId(){
        return $this->orderId;
    } 
  

}
