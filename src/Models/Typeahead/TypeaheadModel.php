<?php
namespace Fortifi\Sdk\Models\Typeahead;

use Fortifi\FortifiApi\Typeahead\Endpoints\TypeaheadEndpoint;
use Fortifi\FortifiApi\Typeahead\Payloads\TypeaheadItemPayload;
use Fortifi\FortifiApi\Typeahead\Payloads\TypeaheadQueryPayload;
use Fortifi\FortifiApi\Typeahead\Responses\TypeaheadItemsResponse;
use Fortifi\Sdk\Models\Api\FortifiApiModel;

class TypeaheadModel extends FortifiApiModel
{
  /**
   * @param string $list
   * @param string $item
   *
   * @return bool
   */
  public function add($list, $item)
  {
    $payload = new TypeaheadItemPayload();
    $payload->list = $list;
    $payload->item = $item;

    $ep = TypeaheadEndpoint::bound($this->getApi());
    return $ep->add($payload)->get()->result;
  }

  /**
   * @param string $list
   * @param string $item
   *
   * @return bool
   */
  public function remove($list, $item)
  {
    $payload = new TypeaheadItemPayload();
    $payload->list = $list;
    $payload->item = $item;

    $ep = TypeaheadEndpoint::bound($this->getApi());
    return $ep->remove($payload)->get()->result;
  }

  /**
   * @param string $list
   * @param string $query
   * @param int    $limit
   * @param string $style
   *
   * @return TypeaheadItemsResponse
   */
  public function query(
    $list, $query, $limit = 30, $style = TypeaheadQueryPayload::MATCH_MIDDLE
  )
  {
    $payload = new TypeaheadQueryPayload();
    $payload->list = $list;
    $payload->query = $query;
    $payload->limit = $limit;
    $payload->matchStyle = $style;

    $ep = TypeaheadEndpoint::bound($this->getApi());
    return $ep->query($payload)->get();
  }
}
