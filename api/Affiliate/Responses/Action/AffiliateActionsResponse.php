<?php
namespace Fortifi\FortifiApi\Affiliate\Responses\Action;

use Fortifi\FortifiApi\Foundation\Responses\PaginatedResponse;

class AffiliateActionsResponse extends PaginatedResponse
{
  /**
   * @var AffiliateActionResponse[]
   */
  public $items = [];

  public function hydrate($data)
  {
    parent::hydrate($data);
    $this->_buildProperty(
      'items',
      '\Fortifi\FortifiApi\Affiliate\Responses\Action\AffiliateActionResponse'
    );
  }
}
