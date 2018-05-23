<?php
namespace Fortifi\FortifiApi\Customer\Responses;

use Fortifi\FortifiApi\Foundation\Responses\FortifiApiResponse;

class CustomerSubjectAccessRequestsResponse extends FortifiApiResponse
{
  /**
   * @var CustomerSubjectAccessRequestResponse[]
   */
  public $items = [];

  public function hydrate($data)
  {
    parent::hydrate($data);
    $this->_buildProperty(
      'items',
      '\Fortifi\FortifiApi\Customer\Responses\CustomerSubjectAccessRequestResponse'
    );
  }
}
