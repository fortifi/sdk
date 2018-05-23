<?php
namespace Fortifi\FortifiApi\Foundation\Payloads;

use Packaged\Api\Abstracts\AbstractApiPayload;

class PaginatedPayload extends AbstractApiPayload
{
  /**
   * @gotype int64
   */
  public $limit = 20;
  /**
   * @gotype int64
   */
  public $page = 1;
  public $sortField;
  public $sortDirection;

  public function getOffset()
  {
    return max(0, ($this->getPage() - 1) * $this->getLimit());
  }

  public function getLimit()
  {
    return empty($this->limit) ? 20 : (int)$this->limit;
  }

  public function getPage()
  {
    return empty($this->page) ? 1 : (int)$this->page;
  }
}
