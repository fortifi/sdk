<?php
namespace Fortifi\FortifiApi\Event\Responses;

use Fortifi\FortifiApi\Foundation\Responses\PaginatedResponse;

class EventsResponse extends PaginatedResponse
{
  /**
   * @var EventResponse[]
   */
  public $items = [];

  public function hydrate($data)
  {
    parent::hydrate($data);
    $this->_buildProperty(
      'items',
      '\Fortifi\FortifiApi\Event\Responses\EventResponse'
    );
  }
}
