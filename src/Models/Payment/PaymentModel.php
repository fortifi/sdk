<?php
namespace Fortifi\Sdk\Models\Payment;

use Fortifi\Sdk\Models\Api\FortifiApiModel;

class PaymentModel extends FortifiApiModel
{
  public function process($paymentFid) { }

  public function retrieve($paymentFid) { }

  public function getByService($serviceFid) { }

  public function getByPaymentAccount($paymentAccountFid) { }
}
