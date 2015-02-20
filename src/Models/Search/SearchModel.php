<?php
namespace Fortifi\Sdk\Models\Search;

use Fortifi\FortifiApi\Search\Endpoints\SearchEndpoint;
use Fortifi\FortifiApi\Search\Payloads\SearchPayload;
use Fortifi\FortifiApi\Search\Responses\SearchResponse;
use Fortifi\Sdk\Models\Api\FortifiApiModel;

class SearchModel extends FortifiApiModel
{
  /**
   * Search for something
   *
   * @param      $query
   * @param null $type
   * @param null $subType
   *
   * @return SearchResponse
   */
  public function search($query, $type = null, $subType = null)
  {
    $payload = new SearchPayload();
    $payload->query = $query;
    $payload->fidType = $type;
    $payload->fidSubType = $subType;
    $ep = SearchEndpoint::bound($this->getApi());
    return $ep->search($payload)->get();
  }
}
