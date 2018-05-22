<?php
namespace Fortifi\FortifiApi\Customer\Responses;

use Fortifi\FortifiApi\Foundation\Responses\PaginatedResponse;

class CustomersResponse extends PaginatedResponse
{
  /**
   * @var CustomerResponse[]
   */
  public $items = [];

  public function hydrate($data)
  {
    parent::hydrate($data);
    $this->_buildProperty(
      'items',
      '\Fortifi\FortifiApi\Customer\Responses\CustomerResponse'
    );
  }
}
