<?php
namespace Fortifi\FortifiApi\Property\Responses;

use Fortifi\FortifiApi\Foundation\Responses\FortifiApiResponse;

class PropertyValuesResponse extends FortifiApiResponse
{
  /**
   * @var PropertyValueResponse[]
   */
  public $properties;

  public function hydrate($data)
  {
    parent::hydrate($data);
    $this->_buildProperty(
      'properties',
      '\Fortifi\FortifiApi\Property\Responses\PropertyValueResponse'
    );
  }
}
