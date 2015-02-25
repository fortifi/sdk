<?php
namespace Fortifi\Sdk\Models\Search;

use Fortifi\FortifiApi\Search\Endpoints\SearchLookupEndpoint;
use Fortifi\FortifiApi\Search\Payloads\SearchLookupPayload;
use Fortifi\FortifiApi\Search\Responses\SearchLookupResponse;
use Fortifi\Sdk\Models\Api\FortifiApiModel;

class SearchLookupModel extends FortifiApiModel
{
  /**
   * Search for something
   *
   * @param string $term
   * @param string $type
   *
   * @return SearchLookupResponse
   */
  public function searchLookup($term, $type)
  {
    $payload = new SearchLookupPayload();
    $payload->term = $term;
    $payload->type = $type;

    $ep = SearchLookupEndpoint::bound($this->getApi());
    return $ep->searchLookup($payload)->get();
  }
}
