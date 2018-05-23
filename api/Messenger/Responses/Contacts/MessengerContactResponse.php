<?php
namespace Fortifi\FortifiApi\Messenger\Responses\Contacts;

use Fortifi\FortifiApi\Foundation\Responses\DataNodeResponse;

class MessengerContactResponse extends DataNodeResponse
{
  public $title;
  public $senderName;
  public $firstName;
  public $middleNames = '';
  public $lastName;
  public $email;
  public $position = '';
  public $signature = '';
  public $signatureHtml = '';
}
