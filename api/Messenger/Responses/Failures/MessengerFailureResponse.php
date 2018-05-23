<?php
namespace Fortifi\FortifiApi\Messenger\Responses\Failures;

use Fortifi\FortifiApi\Foundation\Responses\FortifiApiResponse;

class MessengerFailureResponse extends FortifiApiResponse
{
  public $objectFid;
  public $type;
  public $microtime;
  public $message;
  public $deliveryFid;
}
