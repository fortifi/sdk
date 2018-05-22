<?php
namespace Fortifi\FortifiApi\Event\Responses;

use Fortifi\FortifiApi\Foundation\Responses\PaginatedResponse;

class EventPropertiesResponse extends PaginatedResponse
{
  /**
   * @var EventPropertyResponse[]
   */
  public $items = [];

  public function hydrate($data)
  {
    parent::hydrate($data);
    $this->_buildProperty(
      'items',
      '\Fortifi\FortifiApi\Event\Responses\EventPropertyResponse'
    );
  }
}
