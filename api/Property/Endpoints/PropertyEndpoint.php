<?php
namespace Fortifi\FortifiApi\Property\Endpoints;

use Fortifi\FortifiApi\Foundation\Endpoints\AbstractFortifiEndpoint;
use Fortifi\FortifiApi\Foundation\Payloads\DataNodePropertyPayload;
use Fortifi\FortifiApi\Foundation\Payloads\FidPayload;
use Fortifi\FortifiApi\Foundation\Requests\FortifiApiRequestInterface;
use Fortifi\FortifiApi\Foundation\Responses\BoolResponse;
use Fortifi\FortifiApi\Property\Payloads\BulkSetPropertiesPayload;
use Fortifi\FortifiApi\Property\Payloads\Definitions\CreatePropertyDefinitionPayload;
use Fortifi\FortifiApi\Property\Payloads\Definitions\UpdatePropertyDefinitionPayload;
use Fortifi\FortifiApi\Property\Payloads\GetPropertyPayload;
use Fortifi\FortifiApi\Property\Payloads\Groups\CreatePropertyGroupPayload;
use Fortifi\FortifiApi\Property\Payloads\Groups\UpdatePropertyGroupPayload;
use Fortifi\FortifiApi\Property\Payloads\ListPropertiesPayload;
use Fortifi\FortifiApi\Property\Payloads\PropertiesRetrievePayload;
use Fortifi\FortifiApi\Property\Payloads\SetPropertyValuePayload;
use Fortifi\FortifiApi\Property\Responses\Definitions\PropertyDefinitionResponse;
use Fortifi\FortifiApi\Property\Responses\Definitions\PropertyDefinitionsResponse;
use Fortifi\FortifiApi\Property\Responses\Groups\PropertyGroupResponse;
use Fortifi\FortifiApi\Property\Responses\Groups\PropertyGroupsResponse;
use Fortifi\FortifiApi\Property\Responses\PropertiesRetrieveResponse;
use Fortifi\FortifiApi\Property\Responses\PropertyValueResponse;
use Fortifi\FortifiApi\Property\Responses\PropertyValuesResponse;

class PropertyEndpoint extends AbstractFortifiEndpoint
{
  protected $_path = '/property/';

  /**
   * @param GetPropertyPayload $payload
   *
   * @return FortifiApiRequestInterface|PropertyValuesResponse
   */
  public function retrieve(GetPropertyPayload $payload)
  {
    return self::_createRequest($payload, 'retrieve');
  }

  /**
   * @param UpdatePropertyDefinitionPayload $payload
   *
   * @return FortifiApiRequestInterface|BoolResponse
   */
  public function update(UpdatePropertyDefinitionPayload $payload)
  {
    return self::_createRequest($payload, 'update');
  }

  /**
   * @param FidPayload $payload
   *
   * @return FortifiApiRequestInterface|BoolResponse
   */
  public function archive(FidPayload $payload)
  {
    return self::_createRequest($payload, 'definitions/archive');
  }

  /**
   * @param FidPayload $payload
   *
   * @return FortifiApiRequestInterface|PropertyDefinitionResponse
   */
  public function retrieveDefinition(FidPayload $payload)
  {
    return self::_createRequest($payload, 'definitions/retrieve');
  }

  /**
   * @param PropertiesRetrievePayload $payload
   *
   * @return FortifiApiRequestInterface|PropertiesRetrieveResponse
   */
  public function data(PropertiesRetrievePayload $payload)
  {
    return self::_createRequest($payload, 'data');
  }

  /**
   * @param ListPropertiesPayload $payload
   *
   * @return FortifiApiRequestInterface|PropertiesRetrieveResponse
   */
  public function used(ListPropertiesPayload $payload)
  {
    return self::_createRequest($payload, 'used');
  }

  /**
   * @param ListPropertiesPayload $payload
   *
   * @return FortifiApiRequestInterface|PropertyDefinitionsResponse
   */
  public function all(ListPropertiesPayload $payload)
  {
    return self::_createRequest($payload, 'all');
  }

  /**
   * @param CreatePropertyDefinitionPayload $payload
   *
   * @return FortifiApiRequestInterface|PropertiesRetrieveResponse
   */
  public function create(CreatePropertyDefinitionPayload $payload)
  {
    return self::_createRequest($payload, 'create');
  }

  /**
   * @param ListPropertiesPayload $payload
   *
   * @return FortifiApiRequestInterface|PropertyDefinitionsResponse
   */
  public function defined(ListPropertiesPayload $payload)
  {
    return self::_createRequest($payload, 'definitions/defined');
  }

  /**
   * @param ListPropertiesPayload $payload
   *
   * @return FortifiApiRequestInterface|PropertiesRetrieveResponse
   */
  public function undefined(ListPropertiesPayload $payload)
  {
    return self::_createRequest($payload, 'definitions/undefined');
  }

  /**
   * @param DataNodePropertyPayload $payload
   *
   * @return FortifiApiRequestInterface|BoolResponse
   */
  public function setGroup(DataNodePropertyPayload $payload)
  {
    return self::_createRequest($payload, 'set-group');
  }

  /**
   * @param DataNodePropertyPayload $payload
   *
   * @return FortifiApiRequestInterface|BoolResponse
   */
  public function setType(DataNodePropertyPayload $payload)
  {
    return self::_createRequest($payload, 'set-type');
  }

  /**
   * @param DataNodePropertyPayload $payload
   *
   * @return FortifiApiRequestInterface|BoolResponse
   */
  public function setValues(DataNodePropertyPayload $payload)
  {
    return self::_createRequest($payload, 'set-values');
  }

  /**
   * @param DataNodePropertyPayload $payload
   *
   * @return FortifiApiRequestInterface|BoolResponse
   */
  public function setDisplayName(DataNodePropertyPayload $payload)
  {
    return self::_createRequest($payload, 'set-display-name');
  }

  /**
   * @param DataNodePropertyPayload $payload
   *
   * @return FortifiApiRequestInterface|BoolResponse
   */
  public function setDescription(DataNodePropertyPayload $payload)
  {
    return self::_createRequest($payload, 'set-description');
  }

  /**
   * @param BulkSetPropertiesPayload $payload
   *
   * @return FortifiApiRequestInterface|BoolResponse
   */
  public function bulkSet(BulkSetPropertiesPayload $payload)
  {
    return self::_createRequest($payload, 'bulk');
  }

  /**
   * @param SetPropertyValuePayload $payload
   *
   * @return FortifiApiRequestInterface|BoolResponse
   */
  public function incrementCounter(SetPropertyValuePayload $payload)
  {
    return self::_createRequest($payload, 'counter/increment');
  }

  /**
   * @param SetPropertyValuePayload $payload
   *
   * @return FortifiApiRequestInterface|BoolResponse
   */
  public function decrementCounter(SetPropertyValuePayload $payload)
  {
    return self::_createRequest($payload, 'counter/decrement');
  }

  /**
   * @param GetPropertyPayload $payload
   *
   * @return FortifiApiRequestInterface|PropertyValueResponse
   */
  public function getCounter(GetPropertyPayload $payload)
  {
    return self::_createRequest($payload, 'counter/get');
  }

  /**
   * @param SetPropertyValuePayload $payload
   *
   * @return FortifiApiRequestInterface|BoolResponse
   */
  public function deleteCounter(SetPropertyValuePayload $payload)
  {
    return self::_createRequest($payload, 'counter/delete');
  }

  /**
   * @param SetPropertyValuePayload $payload
   *
   * @return FortifiApiRequestInterface|BoolResponse
   */
  public function setFlag(SetPropertyValuePayload $payload)
  {
    return self::_createRequest($payload, 'flag/set');
  }

  /**
   * @param GetPropertyPayload $payload
   *
   * @return FortifiApiRequestInterface|PropertyValueResponse
   */
  public function getFlag(GetPropertyPayload $payload)
  {
    return self::_createRequest($payload, 'flag/get');
  }

  /**
   * @param SetPropertyValuePayload $payload
   *
   * @return FortifiApiRequestInterface|BoolResponse
   */
  public function deleteFlag(SetPropertyValuePayload $payload)
  {
    return self::_createRequest($payload, 'flag/delete');
  }

  /**
   * @param SetPropertyValuePayload $payload
   *
   * @return FortifiApiRequestInterface|BoolResponse
   */
  public function setValue(SetPropertyValuePayload $payload)
  {
    return self::_createRequest($payload, 'value/set');
  }

  /**
   * @param GetPropertyPayload $payload
   *
   * @return FortifiApiRequestInterface|PropertyValueResponse
   */
  public function getValue(GetPropertyPayload $payload)
  {
    return self::_createRequest($payload, 'value/get');
  }

  /**
   * @param SetPropertyValuePayload $payload
   *
   * @return FortifiApiRequestInterface|BoolResponse
   */
  public function deleteValue(SetPropertyValuePayload $payload)
  {
    return self::_createRequest($payload, 'value/delete');
  }

  //  /**
  //   * @param $payload
  //   *
  //   * @return FortifiApiRequestInterface|
  //   */
  //  public function addSetValue($payload)
  //  {
  //    return self::_createRequest($payload, 'sets/add');
  //  }
  //
  //  /**
  //   * @param $payload
  //   *
  //   * @return FortifiApiRequestInterface|
  //   */
  //  public function removeSetValue($payload)
  //  {
  //    return self::_createRequest($payload, 'sets/remove');
  //  }

  /**
   * @param GetPropertyPayload $payload
   *
   * @return FortifiApiRequestInterface|PropertyValueResponse
   */
  public function getSet(GetPropertyPayload $payload)
  {
    return self::_createRequest($payload, 'sets/get');
  }

  //  /**
  //   * @param $payload
  //   *
  //   * @return FortifiApiRequestInterface|
  //   */
  //  public function setContains($payload)
  //  {
  //    return self::_createRequest($payload, 'sets/contains');
  //  }

  /**
   * @param SetPropertyValuePayload $payload
   *
   * @return FortifiApiRequestInterface|BoolResponse
   */
  public function deleteSet(SetPropertyValuePayload $payload)
  {
    return self::_createRequest($payload, 'sets/delete');
  }

  //  /**
  //   * @param $payload
  //   *
  //   * @return FortifiApiRequestInterface|
  //   */
  //  public function addListValue($payload)
  //  {
  //    return self::_createRequest($payload, 'list/add');
  //  }

  //  /**
  //   * @param $payload
  //   *
  //   * @return FortifiApiRequestInterface|
  //   */
  //  public function removeListValue($payload)
  //  {
  //    return self::_createRequest($payload, 'list/remove');
  //  }

  /**
   * @param GetPropertyPayload $payload
   *
   * @return FortifiApiRequestInterface|PropertyValueResponse
   */
  public function getList(GetPropertyPayload $payload)
  {
    return self::_createRequest($payload, 'list/get');
  }

  //  /**
  //   * @param $payload
  //   *
  //   * @return FortifiApiRequestInterface|
  //   */
  //  public function listContains($payload)
  //  {
  //    return self::_createRequest($payload, 'list/contains');
  //  }

  /**
   * @param SetPropertyValuePayload $payload
   *
   * @return FortifiApiRequestInterface|BoolResponse
   */
  public function deleteList(SetPropertyValuePayload $payload)
  {
    return self::_createRequest($payload, 'list/delete');
  }

  /**
   * @param FidPayload $payload
   *
   * @return FortifiApiRequestInterface|PropertyGroupResponse
   */
  public function retrieveGroup(FidPayload $payload)
  {
    return self::_createRequest($payload, 'groups/retrieve');
  }

  /**
   * @param CreatePropertyGroupPayload $payload
   *
   * @return FortifiApiRequestInterface|PropertyGroupResponse
   */
  public function createGroup(CreatePropertyGroupPayload $payload)
  {
    return self::_createRequest($payload, 'groups/create');
  }

  /**
   * @param UpdatePropertyGroupPayload $payload
   *
   * @return FortifiApiRequestInterface|PropertyGroupResponse
   */
  public function updateGroup(UpdatePropertyGroupPayload $payload)
  {
    return self::_createRequest($payload, 'groups/update');
  }

  /**
   * @param FidPayload $payload
   *
   * @return FortifiApiRequestInterface|BoolResponse
   */
  public function deleteGroup(FidPayload $payload)
  {
    return self::_createRequest($payload, 'groups/delete');
  }

  /**
   * @return FortifiApiRequestInterface|PropertyGroupsResponse
   */
  public function listGroups()
  {
    return self::_createRequest(null, 'groups/list');
  }
}
