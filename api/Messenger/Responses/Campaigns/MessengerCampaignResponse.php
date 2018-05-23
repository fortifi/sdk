<?php
namespace Fortifi\FortifiApi\Messenger\Responses\Campaigns;

use Fortifi\FortifiApi\Foundation\Responses\DataNodeResponse;
use Fortifi\FortifiApi\Messenger\Responses\Contacts\MessengerContactResponse;
use Fortifi\FortifiApi\Messenger\Responses\Lists\MessengerListResponse;
use Fortifi\FortifiApi\Messenger\Responses\Services\MessengerServiceResponse;

class MessengerCampaignResponse extends DataNodeResponse
{
  public $listFid;
  /**
   * @var MessengerListResponse
   */
  public $list;
  public $contactFid;
  /**
   * @var MessengerContactResponse
   */
  public $contact;
  public $serviceFid;
  /**
   * @var MessengerServiceResponse
   */
  public $service;
  public $campaignType;
  public $autoResponderEvent;
  public $propertyFilters;
  public $dataNodeFilters;
  public $eventFilters;

  public function hydrate($data)
  {
    parent::hydrate($data);
    if(!empty($this->contact))
    {
      $this->contact = MessengerContactResponse::make($this->contact);
    }
    if(!empty($this->list))
    {
      $this->list = MessengerListResponse::make($this->list);
    }
    if(!empty($this->service))
    {
      $this->service = MessengerServiceResponse::make($this->service);
    }
  }
}
