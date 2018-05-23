<?php
namespace Fortifi\FortifiApi\Property\Responses;

use Fortifi\FortifiApi\Foundation\Responses\FortifiApiResponse;

class PropertyValueResponse extends FortifiApiResponse
{
  public $objectFid;
  public $property;
  public $value; //When requesting a property, the value is returned, when requesting a property list, the type is returned
  public $lastModified; //Used only when retieving property lists
}
