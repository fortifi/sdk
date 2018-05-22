<?php
namespace Fortifi\FortifiApi\Messenger\Responses\History;

use Fortifi\FortifiApi\Foundation\Responses\FortifiApiResponse;
use Fortifi\FortifiApi\Messenger\Responses\Campaigns\MessengerCampaignResponse;
use Fortifi\FortifiApi\Messenger\Responses\Messages\MessengerTemplateResponse;

class MessengerSendHistoryResponse extends FortifiApiResponse
{
  public $deliveryFid;

  public $runFid;
  public $companyFid;
  public $messageFid;
  public $groupFid;
  public $dataNodeFid;
  public $contactFid;
  public $serviceFid;
  public $listFid;
  public $campaignFid;
  public $templateFid;
  public $recipients;

  public $messageData;
  public $opened = false;
  public $clicked = false;
  public $bounced = false;
  public $unsubscribed = false;
  public $complained = false;
  public $converted = false;

  /**
   * @var MessengerTemplateResponse
   */
  public $template;
  /**
   * @var MessengerCampaignResponse
   */
  public $campaign;

  /**
   * @param $data
   */
  public function hydrate($data)
  {
    parent::hydrate($data);

    if(!empty($this->template))
    {
      $this->template = MessengerTemplateResponse::make($this->template);
    }

    if(!empty($this->campaign))
    {
      $this->campaign = MessengerCampaignResponse::make($this->campaign);
    }
  }
}
