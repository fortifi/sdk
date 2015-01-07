<?php
namespace Fortifi\Sdk\Models\Pages;

use Fortifi\FortifiApi\Pages\Payloads\CreatePagePayload;
use Fortifi\FortifiApi\Pages\Payloads\UpdatePagePayload;
use Fortifi\FortifiApi\Pages\Endpoints\PagesEndpoint;
use Fortifi\FortifiApi\Pages\Responses\PageResponse;
use Fortifi\FortifiApi\Pages\Responses\PagesResponse;
use Fortifi\FortifiApi\Foundation\Payloads\FidPayload;
use Fortifi\FortifiApi\Foundation\Payloads\PaginatedDataNodePayload;
use Fortifi\FortifiApi\Foundation\Responses\BoolResponse;
use Fortifi\Sdk\Models\Api\FortifiApiModel;

class PagesModel extends FortifiApiModel
{
  /**
   * @param int    $limit
   * @param int    $page
   * @param string $sortField
   * @param string $sortDirection
   * @param string $filter
   *
   * @return PagesResponse
   */
  public function all(
    $limit = null, $page = null, $sortField = null, $sortDirection = null,
    $filter = null
  )
  {
    $payload                = new PaginatedDataNodePayload();
    $payload->limit         = $limit;
    $payload->page          = $page;
    $payload->sortField     = $sortField;
    $payload->sortDirection = $sortDirection;
    $payload->filter        = $filter;

    $ep = PagesEndpoint::bound($this->getApi());
    return $ep->all($payload)->get();
  }

  /**
   * @param string $fid
   *
   * @return PageResponse
   */
  public function retrieve($fid)
  {
    $payload      = new FidPayload();
    $payload->fid = $fid;

    $ep = PagesEndpoint::bound($this->getApi());
    return $ep->retrieve($payload)->get();
  }

  /**
   * @param string $title
   * @param string $content
   * @param string $type
   * @param int    $isDisabled
   * @param string $notes
   *
   * @return $this
   */
  public function create($title, $content, $type, $isDisabled, $notes)
  {
    $payload              = new CreatePagePayload();
    $payload->title       = $title;
    $payload->content     = $content;
    $payload->type        = $type;
    $payload->isDisabled  = $isDisabled;
    $payload->notes       = $notes;

    $ep = PagesEndpoint::bound($this->getApi());
    return $ep->create($payload)->get();
  }

  /**
   * @param string $fid
   * @param string $title
   * @param string $content
   * @param string $type
   * @param int    $isDisabled
   * @param string $notes
   *
   * @return $this
   */
  public function update($fid, $title, $content, $type, $isDisabled, $notes)
  {
    $payload              = new UpdatePagePayload();
    $payload->fid         = $fid;
    $payload->title       = $title;
    $payload->content     = $content;
    $payload->type        = $type;
    $payload->isDisabled  = $isDisabled;
    $payload->notes       = $notes;

    $ep = PagesEndpoint::bound($this->getApi());
    return $ep->update($payload)->get();
  }

  /**
   * @param string $fid
   *
   * @return BoolResponse
   */
  public function delete($fid)
  {
    $payload      = new FidPayload();
    $payload->fid = $fid;

    $ep = PagesEndpoint::bound($this->getApi());
    return $ep->delete($payload)->get();
  }

  /**
   * @param string $fid
   *
   * @return BoolResponse
   */
  public function disable($fid)
  {
    $payload = FidPayload::create($fid);

    $ep = PagesEndpoint::bound($this->getApi());
    return $ep->disable($payload)->get();
  }

  /**
   * @param string $fid
   *
   * @return BoolResponse
   */
  public function enable($fid)
  {
    $payload = FidPayload::create($fid);

    $ep = PagesEndpoint::bound($this->getApi());
    return $ep->enable($payload)->get();
  }

  /**
   * @param string $fid
   *
   * @return BoolResponse
   */
  public function restore($fid)
  {
    $payload = FidPayload::create($fid);

    $ep = PagesEndpoint::bound($this->getApi());
    return $ep->restore($payload)->get();
  }
}
