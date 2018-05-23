<?php
namespace Fortifi\FortifiApi\Affiliate\Responses\Pixels;

use Fortifi\FortifiApi\Foundation\Responses\FortifiApiResponse;

class PixelHistoriesResponse extends FortifiApiResponse
{
  /**
   * @var PixelHistoryResponse[]
   */
  public $items = [];

  public function hydrate($data)
  {
    parent::hydrate($data);
    $this->_buildProperty(
      'items',
      '\Fortifi\FortifiApi\Affiliate\Responses\Pixels\PixelHistoryResponse'
    );
  }
}
