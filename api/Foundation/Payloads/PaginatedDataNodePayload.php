<?php
namespace Fortifi\FortifiApi\Foundation\Payloads;

class PaginatedDataNodePayload extends FilteredPaginatedPayload
{
  public $showDeleted = false;
}
