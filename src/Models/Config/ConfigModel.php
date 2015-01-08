<?php
namespace Fortifi\Sdk\Models\Config;

use Fortifi\FortifiApi\Config\Payloads\ConfigItemPayload;
use Fortifi\FortifiApi\Config\Payloads\GetConfigurationPayload;
use Fortifi\FortifiApi\Config\Payloads\GetUserConfigurationPayload;
use Fortifi\FortifiApi\Config\Endpoints\ConfigEndpoint;
use Fortifi\FortifiApi\Config\Responses\ConfigItemResponse;
use Fortifi\FortifiApi\Config\Responses\ConfigurationResponse;
use Fortifi\FortifiApi\Foundation\Requests\FortifiApiRequestInterface;
use Fortifi\FortifiApi\Foundation\Responses\BoolResponse;
use Fortifi\Sdk\Models\Api\FortifiApiModel;

class ConfigModel extends FortifiApiModel
{
  /**
   * @param $fid
   * @param $objectFid
   * @param $section
   * @param $name
   * @param $value
   *
   * @return ConfigItemResponse|FortifiApiRequestInterface
   */
  public function getItem($fid, $objectFid, $section, $name, $value)
  {
    $payload                = new ConfigItemPayload();
    $payload->fid           = $fid;
    $payload->objectFid     = $objectFid;
    $payload->section       = $section;
    $payload->name          = $name;
    $payload->value         = $value;

    $ep = ConfigEndpoint::bound($this->getApi());
    return $ep->getItem($payload)->get();
  }

  /**
   * @param $objectFid
   * @param $section
   *
   * @return ConfigurationResponse|FortifiApiRequestInterface
   */
  public function getConfiguration(
    $objectFid, $section
  )
  {
    $payload               = new GetConfigurationPayload();
    $payload->objectFid    = $objectFid;
    $payload->section      = $section;

    $ep = ConfigEndpoint::bound($this->getApi());
    return $ep->getConfiguration($payload)->get();
  }

  /**
   * @param $companyFid
   * @param $userFid
   * @param $organisation
   * @param $blend
   * @param $section
   *
   * @return ConfigurationResponse|FortifiApiRequestInterface
   */
  public function getUserConfiguration(
    $companyFid, $userFid, $organisation, $blend, $section
  )
  {
    $payload               = new GetUserConfigurationPayload();
    $payload->companyFid   = $companyFid;
    $payload->userFid      = $userFid;
    $payload->organisation = $organisation;
    $payload->blend        = $blend;
    $payload->section      = $section;

    $ep = ConfigEndpoint::bound($this->getApi());
    return $ep->getUserConfiguration($payload)->get();
  }

  /**
   * @param $fid
   * @param $objectFid
   * @param $section
   * @param $name
   * @param $value
   *
   * @return FortifiApiRequestInterface|BoolResponse
   */
  public function setConfigItem($fid, $objectFid, $section, $name, $value)
  {
    $payload            = new ConfigItemPayload();
    $payload->fid       = $fid;
    $payload->objectFid = $objectFid;
    $payload->section   = $section;
    $payload->name      = $name;
    $payload->value     = $value;

    $ep = ConfigEndpoint::bound($this->getApi());
    return $ep->setConfigItem($payload)->get();
  }

  /**
   * @param $fid
   * @param $objectFid
   * @param $section
   * @param $name
   * @param $value
   *
   * @return FortifiApiRequestInterface|BoolResponse
   */
  public function deleteConfigItem($fid, $objectFid, $section, $name, $value)
  {
    $payload            = new ConfigItemPayload();
    $payload->fid       = $fid;
    $payload->objectFid = $objectFid;
    $payload->section   = $section;
    $payload->name      = $name;
    $payload->value     = $value;

    $ep = ConfigEndpoint::bound($this->getApi());
    return $ep->deleteConfigItem($payload)->get();
  }
}