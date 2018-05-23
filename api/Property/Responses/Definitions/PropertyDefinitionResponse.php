<?php
namespace Fortifi\FortifiApi\Property\Responses\Definitions;

use Fortifi\FortifiApi\Foundation\Responses\DataNodeResponse;
use Fortifi\FortifiApi\Property\Responses\Groups\PropertyGroupResponse;
use Packaged\Helpers\ValueAs;

class PropertyDefinitionResponse extends DataNodeResponse
{
  public $fidType;
  public $fidSubType;
  public $baseFid;

  public $key;

  public $groupFid;
  /**
   * @var PropertyGroupResponse
   */
  public $group;

  public $type;
  public $values;

  /**
   * Hydrate the public properties
   *
   * @param $data
   */
  public function hydrate($data)
  {
    parent::hydrate($data);
    $this->values = ValueAs::arr($this->values);
  }
}
