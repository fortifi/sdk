<?php
namespace Fortifi\FortifiApi\Foundation\Enums;

class UserSourceType extends AbstractFortifiEnum
{
  const SETUP = 'setup';
  const UPGRADE = 'upgrade';
  const MIGRATION = 'migration';
  const SSO_REGISTRATION = 'sso';
  const CRON_JOB = 'cron-job';

  public static function getDisplayValue($value)
  {
    switch($value)
    {
      case self::SETUP:
        return 'Organisation Setup';
      case self::UPGRADE:
        return 'Account Upgrade';
      case self::MIGRATION:
        return 'Data Migration';
      case self::SSO_REGISTRATION:
        return 'Single Sign-on Registration';
      case self::CRON_JOB:
        return 'Cron Job';
      default:
        return $value;
    }
  }
}
