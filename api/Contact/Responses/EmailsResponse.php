<?php
namespace Fortifi\FortifiApi\Contact\Responses;

use Fortifi\FortifiApi\Foundation\Responses\PaginatedResponse;

class EmailsResponse extends PaginatedResponse
{
  /**
   * @var EmailResponse[]
   */
  public $items = [];

  public function hydrate($data)
  {
    parent::hydrate($data);
    $this->_buildProperty(
      'items',
      '\Fortifi\FortifiApi\Contact\Responses\EmailResponse'
    );
  }
}
