<?php
namespace Fortifi\Sdk\Models\Payment;

use Fortifi\FortifiApi\Payment\Enums\PaymentServiceDirection;
use Fortifi\Sdk\Models\Api\FortifiApiModel;

class PaymentServiceModel extends FortifiApiModel
{
  public function create(
    $name, $direction, $processor, $configuration, $selectable = false,
    $enabled = true, array $requiredForms = []
  )
  {
  }

  public function all(
    $limit = null, $page = null, $sortField = null, $sortDirection = null,
    $showDeleted = null, $filter = null
  )
  {
  }

  public function getByProcessor($processor) { }

  public function getByDirection(
    $direction = PaymentServiceDirection::INBOUND
  )
  {
  }

  public function retrieve($serviceFid) { }

  public function archive($serviceFid) { }

  public function restore($serviceFid) { }

  public function enable($serviceFid) { }

  public function disable($serviceFid) { }

  public function setSelectable($serviceFid, $selectable = true) { }

  public function setConfiguration($serviceFid, $configuration) { }
}
