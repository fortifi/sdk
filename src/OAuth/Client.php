<?php
namespace Fortifi\Sdk\OAuth;

class Client
{
  protected $_secret;
  protected $_id;

  public function __construct($id, $secret)
  {
    $this->_secret = $secret;
    $this->_id = $id;
  }

  public function getId()
  {
    return $this->_id;
  }

  public function getSecret()
  {
    return $this->_secret;
  }
}
