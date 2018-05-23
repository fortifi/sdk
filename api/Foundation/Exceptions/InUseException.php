<?php
namespace Fortifi\FortifiApi\Foundation\Exceptions;

use Fortifi\FortifiApi\Foundation\Enums\InUseLocation;

class InUseException extends FortifiApiException
{
  // Must be public to be able to be serialised and sent with the API call
  public $locations = [];

  /**
   * @param int   $location InUseLocation
   * @param mixed $data
   *
   * @return $this
   */
  public function addLocation($location, $data = null)
  {
    if(InUseLocation::isValid($location))
    {
      $this->locations[] = [$location, $data];
    }
    return $this;
  }

  public function hasLocations()
  {
    return count($this->locations) > 0;
  }
}
