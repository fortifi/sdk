<?php
namespace Fortifi\FortifiApi\Traffic\Responses;

use Fortifi\FortifiApi\Foundation\Responses\PaginatedResponse;

class VisitorsResponse extends PaginatedResponse
{
  /**
   * @var VisitorResponse[]
   */
  public $items = [];

  /**
   * @param $data
   */
  public function hydrate($data)
  {
    parent::hydrate($data);
    $this->_buildProperty(
      'items',
      '\Fortifi\FortifiApi\Traffic\Responses\VisitorResponse'
    );
  }
}
