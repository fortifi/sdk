<?php
namespace Fortifi\FortifiApi\Foundation\Enums;

class InUseLocation extends AbstractFortifiEnum
{
  const SUPPORT_CHAT_DEPARTMENTS = 1;
  const WORKFLOW_RULES = 2;
  const WORKFLOW_ACTIONS = 3;
  const SUPPORT_TICKETS = 4;
  const SUBSCRIPTIONS = 5;
  const PENDING_INVOICES = 6;
  const SUPPORT_CHAT_SESSIONS = 7;
  const PAYMENT_GATEWAY_POLICIES = 8;
  const PAYMENT_GATEWAY_CONFIGS = 9;

  public static function getDisplayValue($value)
  {
    switch($value)
    {
      case self::SUPPORT_CHAT_DEPARTMENTS:
        return 'Chat Support Departments';
      case self::WORKFLOW_RULES:
        return 'Workflow Rules';
      case self::WORKFLOW_ACTIONS:
        return 'Workflow Actions';
      case self::SUPPORT_TICKETS:
        return 'Support Tickets';
      case self::SUBSCRIPTIONS:
        return 'Subscriptions';
      case self::PENDING_INVOICES:
        return 'Pending Invoices for Subscription';
      case self::SUPPORT_CHAT_SESSIONS;
        return 'Support chat sessions';
      case self::PAYMENT_GATEWAY_POLICIES:
        return 'Payment gateway policies';
      case self::PAYMENT_GATEWAY_CONFIGS:
        return 'Payment gateway configurations';
      default:
        return parent::getDisplayValue($value);
    }
  }
}
