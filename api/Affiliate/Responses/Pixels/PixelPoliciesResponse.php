<?php
namespace Fortifi\FortifiApi\Affiliate\Responses\Pixels;

use Fortifi\FortifiApi\Foundation\Responses\FortifiApiResponse;

class PixelPoliciesResponse extends FortifiApiResponse
{
  /**
   * @var PixelPolicyResponse[]
   */
  public $items = [];

  public function hydrate($data)
  {
    parent::hydrate($data);
    $this->_buildProperty(
      'items',
      '\Fortifi\FortifiApi\Affiliate\Responses\Pixels\PixelPolicyResponse'
    );
  }
}
