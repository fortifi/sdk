<?php
namespace Fortifi\Sdk\OAuth;

interface FortifiGrant
{
  public function handleResponse($response = []);
}
