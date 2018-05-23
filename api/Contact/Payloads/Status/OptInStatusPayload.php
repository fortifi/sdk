<?php
namespace Fortifi\FortifiApi\Contact\Payloads\Status;

class OptInStatusPayload extends ContactStatusPayload
{
  public $optIn;
  //Additional Data
  public $data = [];
}
