<?php
namespace Fortifi\Sdk\Models;

use Fortifi\FortifiApi\Contact\Endpoints\EmailEndpoint;
use Fortifi\FortifiApi\Contact\Enums\UnsubscribeType;
use Fortifi\FortifiApi\Contact\Payloads\Status\UnsubscribeEmailPayload;

class EmailAddress extends FortifiModel
{
  protected $_emailAddress;

  /**
   * @return mixed
   */
  public function getEmailAddress()
  {
    return $this->_emailAddress;
  }

  /**
   * @param $emailAddress
   *
   * @return $this
   */
  public function setEmailAddress($emailAddress)
  {
    $this->_emailAddress = $emailAddress;
    return $this;
  }

  public function unsubscribe($companyFid, $groupFid = null)
  {
    $payload = new UnsubscribeEmailPayload();
    $payload->emailAddress = $this->_emailAddress;
    $payload->groupFid = $groupFid;
    $payload->companyFid = $companyFid;
    $payload->type = UnsubscribeType::UNSUBSCRIBE_HARD;

    $endpoint = EmailEndpoint::bound($this->_getApi());
    return $this->_processRequest($endpoint->unsubscribe($payload));
  }
}
