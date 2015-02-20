<?php
namespace Fortifi\Sdk\Models\Contact;

use Fortifi\FortifiApi\Contact\Endpoints\PhoneEndpoint;
use Fortifi\FortifiApi\Contact\Payloads\Phone\PhoneNumberPayload;
use Fortifi\FortifiApi\Contact\Responses\PhoneResponse;
use Fortifi\FortifiApi\Contact\Responses\PhonesResponse;
use Fortifi\FortifiApi\Foundation\Payloads\FidPayload;
use Fortifi\FortifiApi\Foundation\Responses\FidResponse;
use Fortifi\Sdk\Models\Api\FortifiApiModel;

class PhoneModel extends FortifiApiModel
{
  /**
   * @param string $phoneNumber
   *
   * @return FidResponse
   */
  public function create($phoneNumber)
  {
    $payload = new PhoneNumberPayload();
    $payload->phoneNumber = $phoneNumber;

    $ep = PhoneEndpoint::bound($this->getApi());

    return $ep->create($payload)->get();
  }

  /**
   * @param string $fid
   *
   * @return PhoneResponse
   */
  public function retrieve($fid)
  {
    $ep = PhoneEndpoint::bound($this->getApi());
    return $ep->retrieve(FidPayload::create($fid))->get();
  }

  /**
   * @param $fid
   *
   * @return PhonesResponse
   */
  public function listFromObject($fid)
  {
    $payload = new FidPayload();
    $payload->fid = $fid;

    $ep = PhoneEndpoint::bound($this->getApi());
    return $ep->listFromObject($payload)->get();
  }
}
