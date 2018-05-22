<?php
namespace Fortifi\FortifiApi\Contact\Endpoints;

use Fortifi\FortifiApi\Contact\Payloads\Email\EmailAddressPayload;
use Fortifi\FortifiApi\Contact\Payloads\Status\ContactStatusPayload;
use Fortifi\FortifiApi\Contact\Payloads\Status\OptInStatusPayload;
use Fortifi\FortifiApi\Contact\Payloads\Status\UnsubscribeEmailPayload;
use Fortifi\FortifiApi\Contact\Responses\EmailResponse;
use Fortifi\FortifiApi\Contact\Responses\EmailsResponse;
use Fortifi\FortifiApi\Foundation\Endpoints\AbstractFortifiEndpoint;
use Fortifi\FortifiApi\Foundation\Payloads\FidPayload;
use Fortifi\FortifiApi\Foundation\Requests\FortifiApiRequestInterface;
use Fortifi\FortifiApi\Foundation\Responses\BoolResponse;
use Fortifi\FortifiApi\Foundation\Responses\FidResponse;

class EmailEndpoint extends AbstractFortifiEndpoint
{
  protected $_path = '/contact/email/';

  /**
   * @param EmailAddressPayload $payload
   *
   * @return FortifiApiRequestInterface|FidResponse
   */
  public function create(EmailAddressPayload $payload)
  {
    return self::_createRequest($payload, 'create');
  }

  /**
   * @param FidPayload $payload
   *
   * @return FortifiApiRequestInterface|EmailResponse
   */
  public function retrieve(FidPayload $payload)
  {
    return self::_createRequest($payload, 'retrieve');
  }

  /**
   * Get a list of all email addresses for a data node
   *
   * @param FidPayload $payload
   *
   * @return FortifiApiRequestInterface|EmailsResponse
   */
  public function listFromObject(FidPayload $payload)
  {
    return self::_createRequest($payload, 'list-from-object');
  }

  /**
   * @param UnsubscribeEmailPayload $payload
   *
   * @return FortifiApiRequestInterface|BoolResponse
   */
  public function unsubscribe(UnsubscribeEmailPayload $payload)
  {
    return self::_createRequest($payload, 'unsubscribe');
  }

  /**
   * @param ContactStatusPayload $payload
   *
   * @return FortifiApiRequestInterface|BoolResponse
   */
  public function resubscribe(ContactStatusPayload $payload)
  {
    return self::_createRequest($payload, 'resubscribe');
  }

  /**
   * @param OptInStatusPayload $payload
   *
   * @return FortifiApiRequestInterface|BoolResponse
   */
  public function optInStatus(OptInStatusPayload $payload)
  {
    return self::_createRequest($payload, 'opt-in');
  }
}
