<?php
namespace Fortifi\FortifiApi\Customer\Responses;

use Fortifi\FortifiApi\Foundation\Responses\FortifiApiResponse;

class CustomerSubjectAccessRequestResponse extends FortifiApiResponse
{
  public $customerFid;
  public $dateCreated;
  public $displayName;
  public $requestTypes;
  public $isReady;
  public $signedUrl;
}
