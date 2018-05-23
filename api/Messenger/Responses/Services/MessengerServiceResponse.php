<?php
namespace Fortifi\FortifiApi\Messenger\Responses\Services;

use Fortifi\FortifiApi\Foundation\Responses\DataNodeResponse;

class MessengerServiceResponse extends DataNodeResponse
{
  public $messageType;
  public $serviceType;
  public $listsCount;
  public $campaignsCount;
  public $messagesCount;
}
