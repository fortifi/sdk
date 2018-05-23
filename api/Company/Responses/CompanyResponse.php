<?php
namespace Fortifi\FortifiApi\Company\Responses;

use Fortifi\FortifiApi\Company\Enums\CompanyType;
use Fortifi\FortifiApi\Foundation\Responses\DataNodeResponse;

class CompanyResponse extends DataNodeResponse
{
  public $legalName;
  public $domain;

  public $companyType = CompanyType::BRAND;
  public $ownerFid;
  public $externalReference;
}
