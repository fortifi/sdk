<?php
namespace Fortifi\Sdk\Models\Marketing;

use Fortifi\FortifiApi\Foundation\Responses\FidResponse;
use Fortifi\FortifiApi\Marketing\Payloads\CreateBannerAdvertPayload;
use Fortifi\FortifiApi\Marketing\Payloads\UpdateBannerAdvertPayload;
use Fortifi\FortifiApi\Marketing\Endpoints\BannerAdvertEndpoint;
use Fortifi\FortifiApi\Marketing\Responses\BannerAdvertResponse;
use Fortifi\FortifiApi\Marketing\Responses\BannerAdvertsResponse;
use Fortifi\FortifiApi\Foundation\Payloads\FidPayload;
use Fortifi\FortifiApi\Foundation\Payloads\PaginatedDataNodePayload;
use Fortifi\FortifiApi\Foundation\Responses\BoolResponse;
use Fortifi\Sdk\Models\Api\FortifiApiModel;

class BannerAdvertModel extends FortifiApiModel
{
  /**
   * @param int    $limit
   * @param int    $page
   * @param string $sortField
   * @param string $sortDirection
   * @param int    $showDeleted
   * @param string $filter
   *
   * @return BannerAdvertsResponse
   */
  public function all(
    $limit = null, $page = null, $sortField = null, $sortDirection = null,
    $showDeleted = null, $filter = null
  )
  {
    $payload                = new PaginatedDataNodePayload();
    $payload->limit         = $limit;
    $payload->page          = $page;
    $payload->sortField     = $sortField;
    $payload->sortDirection = $sortDirection;
    $payload->showDeleted   = $showDeleted;
    $payload->filter        = $filter;

    $ep = BannerAdvertEndpoint::bound($this->getApi());
    return $ep->all($payload)->get();
  }

  /**
   * @param string $fid
   *
   * @return BannerAdvertResponse
   */
  public function retrieve($fid)
  {
    $payload      = new FidPayload();
    $payload->fid = $fid;

    $ep = BannerAdvertEndpoint::bound($this->getApi());
    return $ep->retrieve($payload)->get();
  }

  /**
   * @param string $title
   * @param string $action
   * @param string $company
   * @param string $language
   * @param string $type
   * @param string $imageUrl
   * @param string $rawCode
   * @param string $height
   * @param string $width
   *
   * @return FidResponse
   */
  public function create($title, $action, $company, $language,
                         $type, $imageUrl, $rawCode, $height, $width
  )
  {
    $payload              = new CreateBannerAdvertPayload();
    $payload->title       = $title;
    $payload->action      = $action;
    $payload->company     = $company;
    $payload->language    = $language;
    $payload->type        = $type;
    $payload->imageUrl    = $imageUrl;
    $payload->rawCode     = $rawCode;
    $payload->height      = $height;
    $payload->width       = $width;

    $ep = BannerAdvertEndpoint::bound($this->getApi());
    return $ep->create($payload)->get();
  }

  /**
   * @param string $fid
   * @param string $title
   * @param string $action
   * @param string $company
   * @param string $language
   * @param string $type
   * @param string $imageUrl
   * @param string $rawCode
   * @param string $height
   * @param string $width
   *
   * @return BoolResponse
   */
  public function update($fid, $title, $action, $company, $language,
                         $type, $imageUrl, $rawCode, $height, $width
  )
  {
    $payload              = new UpdateBannerAdvertPayload();
    $payload->fid         = $fid;
    $payload->title       = $title;
    $payload->action      = $action;
    $payload->company     = $company;
    $payload->language    = $language;
    $payload->type        = $type;
    $payload->imageUrl    = $imageUrl;
    $payload->rawCode     = $rawCode;
    $payload->height      = $height;
    $payload->width       = $width;

    $ep = BannerAdvertEndpoint::bound($this->getApi());
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

    $ep = BannerAdvertEndpoint::bound($this->getApi());
    return $ep->delete($payload)->get();
  }

  /**
   * @param string $fid
   *
   * @return BoolResponse
   */
  public function restore($fid)
  {
    $payload = FidPayload::create($fid);

    $ep = BannerAdvertEndpoint::bound($this->getApi());
    return $ep->restore($payload)->get();
  }
}
