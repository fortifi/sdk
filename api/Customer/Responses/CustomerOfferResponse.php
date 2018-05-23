<?php
namespace Fortifi\FortifiApi\Customer\Responses;

use Fortifi\FortifiApi\Foundation\Responses\DataNodeResponse;

class CustomerOfferResponse extends DataNodeResponse
{
  public $customerFid;
  public $offerFid;
  public $appliedDate;
}
