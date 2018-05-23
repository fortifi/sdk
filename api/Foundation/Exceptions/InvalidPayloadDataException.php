<?php
namespace Fortifi\FortifiApi\Foundation\Exceptions;

class InvalidPayloadDataException extends FortifiApiException
{
  public function __construct($message = "", $code = 400, $previous = null)
  {
    parent::__construct($message, $code, $previous);
  }
}
