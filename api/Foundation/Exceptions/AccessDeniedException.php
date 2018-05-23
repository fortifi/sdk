<?php
namespace Fortifi\FortifiApi\Foundation\Exceptions;

class AccessDeniedException extends FortifiApiException
{
  protected $code = 403;
}
