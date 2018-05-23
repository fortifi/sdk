<?php
namespace Fortifi\FortifiApi\Foundation\Exceptions;

class NotFoundException extends FortifiApiException
{
  public function __construct($message = "", $code = 404, $previous = null)
  {
    parent::__construct($message, $code, $previous);
  }
}
