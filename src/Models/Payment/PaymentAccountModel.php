<?php
namespace Fortifi\Sdk\Models\Payment;

use Fortifi\Sdk\Models\Api\FortifiApiModel;

class PaymentAccountModel extends FortifiApiModel
{
  public function create($ownerFid, $serviceFid, $configuration) { }

  public function all($ownerFid) { }

  public function getByProcessor($processor) { }

  public function retrieve($accountFid) { }

  public function archive($accountFid) { }

  public function restore($accountFid) { }

  public function setConfiguration($accountFid, $configuration) { }
}
