<?php
namespace Fortifi\FortifiApi\Customer\Payloads;

use Packaged\Api\Abstracts\AbstractApiPayload;

class CustomerVisitorPayload extends AbstractApiPayload
{
  /**
   * @length 32 64
   */
  public $customerFid;

  public $visitorId;
}
