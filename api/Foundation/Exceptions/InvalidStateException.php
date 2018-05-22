<?php
namespace Fortifi\FortifiApi\Foundation\Exceptions;

class InvalidStateException extends FortifiApiException
{
  public function __construct($message = "", $code = 400, \Throwable $previous = null)
  {
    parent::__construct($message, $code, $previous);
  }
}
