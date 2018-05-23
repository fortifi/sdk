<?php
namespace Fortifi\FortifiApi\Property\Responses\Definitions;

use Fortifi\FortifiApi\Foundation\Responses\FortifiApiResponse;

class PropertyDefinitionsResponse extends FortifiApiResponse
{
  /**
   * @var PropertyDefinitionResponse[]
   */
  public $items = [];

  public function hydrate($data)
  {
    parent::hydrate($data);
    $this->_buildProperty(
      'items',
      '\Fortifi\FortifiApi\Property\Responses\Definitions\PropertyDefinitionResponse'
    );
  }
}
