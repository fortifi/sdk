<?php
namespace Fortifi\Sdk\Models\Contact;

use Fortifi\FortifiApi\Contact\Payloads\Email\EmailAddressPayload;
use Fortifi\FortifiApi\Contact\Endpoints\EmailEndpoint;
use Fortifi\FortifiApi\Contact\Responses\EmailResponse;
use Fortifi\FortifiApi\Contact\Responses\EmailsResponse;
use Fortifi\FortifiApi\Foundation\Payloads\FidPayload;
use Fortifi\FortifiApi\Foundation\Responses\FidResponse;
use Fortifi\Sdk\Models\Api\FortifiApiModel;

class EmailModel extends FortifiApiModel
{
  /**
   * @param string $emailAddress
   *
   * @return FidResponse
   */
  public function create($emailAddress)
  {
    $payload               = new EmailAddressPayload();
    $payload->emailAddress = $emailAddress;

    $ep = EmailEndpoint::bound($this->getApi());

    return $ep->create($payload)->get();
  }

  /**
   * @param string $fid
   *
   * @return EmailResponse
   */
  public function retrieve($fid)
  {
    $ep = EmailEndpoint::bound($this->getApi());
    return $ep->retrieve(FidPayload::create($fid))->get();
  }

  /**
   * @param $fid
   *
   * @return EmailsResponse
   */
  public function listFromObject($fid)
  {
    $payload      = new FidPayload();
    $payload->fid = $fid;

    $ep = EmailEndpoint::bound($this->getApi());
    return $ep->listFromObject($payload)->get();
  }
}
