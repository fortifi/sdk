<?php
namespace Fortifi\FortifiApi\Property\Payloads;

use Fortifi\FortifiApi\Foundation\Payloads\FidPayload;

class PropertiesRetrievePayload extends FidPayload
{
  public $counter = [];
  public $flag = [];
  public $list = [];
  public $set = [];
  public $value = [];
}
