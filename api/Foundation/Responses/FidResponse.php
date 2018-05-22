<?php
namespace Fortifi\FortifiApi\Foundation\Responses;

class FidResponse extends FortifiApiResponse
{
  public $fid;

  public function __construct($fid = null)
  {
    $this->fid = $fid;
  }
}
