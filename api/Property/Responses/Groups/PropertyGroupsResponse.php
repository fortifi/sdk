<?php
namespace Fortifi\FortifiApi\Property\Responses\Groups;

use Fortifi\FortifiApi\Foundation\Responses\FortifiApiResponse;

class PropertyGroupsResponse extends FortifiApiResponse
{
  /**
   * @var PropertyGroupResponse[]
   */
  public $items = [];

  public function hydrate($data)
  {
    parent::hydrate($data);
    $this->_buildProperty(
      'items',
      '\Fortifi\FortifiApi\Property\Responses\Groups\PropertyGroupResponse'
    );
  }
}
