<?php
namespace Fortifi\FortifiApi\Messenger\Responses\History;

use Fortifi\FortifiApi\Foundation\Responses\PaginatedResponse;

class MessengerSendHistoriesResponse extends PaginatedResponse
{
  /**
   * @var MessengerSendHistoryResponse[]
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
      '\Fortifi\FortifiApi\Messenger\Responses\History\MessengerSendHistoryResponse'
    );
  }
}
