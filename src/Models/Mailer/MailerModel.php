<?php
namespace Fortifi\Sdk\Models\Mailer;

use Fortifi\FortifiApi\Mailer\Endpoints\MailerEndpoint;
use Fortifi\FortifiApi\Mailer\Payloads\CreateMailerEmailPayload;
use Fortifi\FortifiApi\Mailer\Payloads\UpdateMailerEmailPayload;
use Fortifi\FortifiApi\Mailer\Payloads\MailerPaginatedPayload;
use Fortifi\FortifiApi\Mailer\Payloads\MailerPayload;
use Fortifi\FortifiApi\Mailer\Responses\CreateMailerEmailResponse;
use Fortifi\FortifiApi\Mailer\Responses\MailerEmailResponse;
use Fortifi\FortifiApi\Mailer\Responses\MailerEmailsResponse;
use Fortifi\FortifiApi\Foundation\Requests\FortifiApiRequestInterface;
use Fortifi\FortifiApi\Foundation\Responses\BoolResponse;
use Fortifi\Sdk\Models\Api\FortifiApiModel;

class MailerModel extends FortifiApiModel
{
  /**
   * @param int    $limit
   * @param int    $page
   * @param string $sortField
   * @param string $sortDirection
   * @param int    $showDeleted
   * @param int    $showDisabled
   * @param string $filter
   *
   * @return FortifiApiRequestInterface|MailerEmailsResponse
   */
  public function all(
    $limit = null, $page = null, $sortField = null, $sortDirection = null,
    $showDeleted = 0, $showDisabled = 1, $filter = null
  )
  {
    $payload                = new MailerPaginatedPayload();
    $payload->limit         = $limit;
    $payload->page          = $page;
    $payload->sortField     = $sortField;
    $payload->sortDirection = $sortDirection;
    $payload->showDeleted   = $showDeleted;
    $payload->showDisabled  = $showDisabled;
    $payload->filter        = $filter;

    $ep = MailerEndpoint::bound($this->getApi());
    return $ep->all($payload)->get();
  }

  /**
   * @param string $fid
   *
   * @return FortifiApiRequestInterface|MailerEmailResponse
   */
  public function retrieve($fid)
  {
    $payload = MailerPayload::create($fid);

    $ep = MailerEndpoint::bound($this->getApi());
    return $ep->retrieve($payload)->get();
  }

  /**
   * @param string $name
   * @param string $subject
   * @param string $content
   * @param string $sender
   *
   * @return FortifiApiRequestInterface|CreateMailerEmailResponse
   */
  public function create($name, $subject, $content, $sender)
  {
    $payload          = new CreateMailerEmailPayload();
    $payload->name    = $name;
    $payload->subject = $subject;
    $payload->content = $content;
    $payload->sender  = $sender;

    $ep = MailerEndpoint::bound($this->getApi());
    return $ep->create($payload)->get();
  }

  /**
   * @param string $fid
   * @param string $name
   * @param string $subject
   * @param string $content
   * @param string $sender
   *
   * @return FortifiApiRequestInterface|BoolResponse
   */
  public function update($fid, $name, $subject, $content, $sender)
  {
    $payload          = new UpdateMailerEmailPayload();
    $payload->fid     = $fid;
    $payload->name    = $name;
    $payload->subject = $subject;
    $payload->content = $content;
    $payload->sender  = $sender;

    $ep = MailerEndpoint::bound($this->getApi());
    return $ep->update($payload)->get();
  }

  /**
   * @param string $fid
   *
   * @return FortifiApiRequestInterface|BoolResponse
   */
  public function delete($fid)
  {
    $payload = MailerPayload::create($fid);

    $ep = MailerEndpoint::bound($this->getApi());
    return $ep->delete($payload)->get();
  }

  /**
   * @param string $fid
   *
   * @return FortifiApiRequestInterface|BoolResponse
   */
  public function restore($fid)
  {
    $payload = MailerPayload::create($fid);

    $ep = MailerEndpoint::bound($this->getApi());
    return $ep->restore($payload)->get();
  }
}
