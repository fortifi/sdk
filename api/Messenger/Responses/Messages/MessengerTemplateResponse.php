<?php
namespace Fortifi\FortifiApi\Messenger\Responses\Messages;

use Fortifi\FortifiApi\Foundation\Responses\DataNodeResponse;

class MessengerTemplateResponse extends DataNodeResponse
{
  public $messageFid;
  public $contactFid;
  public $language;

  public $subject;
  public $textContent;
  public $htmlContent;
  public $brandingEnabled;
  public $isDisabled;
}
