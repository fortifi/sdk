<?php
namespace Fortifi\FortifiApi\Messenger\Responses\Failures;

use Fortifi\FortifiApi\Foundation\Responses\FortifiApiResponse;

class MessengerFailuresResponse extends FortifiApiResponse
{
  /**
   * @var MessengerFailureResponse[]
   */
  public $items = [];

  public function hydrate($data)
  {
    parent::hydrate($data);
    $this->_buildProperty(
      'items',
      '\Fortifi\FortifiApi\Messenger\Responses\Failures\MessengerFailureResponse'
    );
  }
}
