<?php
namespace Fortifi\FortifiApi\Foundation\Responses;

class PaginatedResponse extends FortifiApiResponse
{
  /**
   * @gotype int64
   */
  public $totalItems;
  /**
   * @gotype int64
   */
  public $page;
  /**
   * @gotype int64
   */
  public $limit;
}
