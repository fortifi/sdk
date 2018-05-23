<?php
namespace Fortifi\FortifiApi\Messenger\Responses\Lists;

use Fortifi\FortifiApi\Foundation\Responses\DataNodeResponse;
use Fortifi\FortifiApi\Messenger\Responses\Contacts\MessengerContactResponse;
use Fortifi\FortifiApi\Messenger\Responses\Services\MessengerServiceResponse;

class MessengerListResponse extends DataNodeResponse
{
  public $dataNodeType;
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
  public $propertyFilters;
  public $dataNodeFilters;
  public $promosCount;
  public $autoRespondersCount;

  public $isBuiltIn;

  public function hydrate($data)
  {
    parent::hydrate($data);
    if(!empty($this->contact))
    {
      $this->contact = MessengerContactResponse::make($this->contact);
    }
    if(!empty($this->service))
    {
      $this->service = MessengerServiceResponse::make($this->service);
    }
  }
}
