<?php
require_once(dirname(__DIR__) . '/vendor/autoload.php');
use Fortifi\Sdk\Fortifi;

//Create a fortifi instance
$fortifi = Fortifi::getInstance(
  'ORG:DC:1448:6f535',
  'ZGVmZWViNDI3-SDKT-MDNiOTc0OTVh',
  'MjgyYjRmMzdhODM0Y2U2YmZhYTM5NTYyY2I1OWQ2'
);

var_dump_json($fortifi->visitor()->triggerAction('lead', 'LEAD-123'));

//Create a new customer
$customer = $fortifi->customer()
  ->create('test@test.com', 'John', 'Smith', '036486346', 'TEST-123');

//Customer FID applied to this customer object, for future requests do:
$customer = $fortifi->customer('CustomerFid');

//Get any pixels required for this visitor
$pixels = $fortifi->visitor()->getPixels();
if($pixels)
{
  foreach($pixels as $pixel)
  {
    //Output $pixel to page
    var_dump_json($pixel);
  }
}

//Mark Customer Conversion to paid account
$customer->purchase(
  'ORDER-123',
  12.98,
  ['product_id' => 'SUBSCRIP', 'product_name' => 'Account Subscription']
);

//Customer purchased an account addon (upsell)
$customer->purchaseUpsell('UPS-1', 1.95, ['products' => ['PREMIUM_SUPPORT']]);

//Mark Renewals
$customer->renewed('RENEWAL-123', 15.98, ['renewal_count' => 1]);
$customer->renewed('RENEWAL-456', 15.98, ['renewal_count' => 2]);

//Customer cancelled their renewal
$customer->cancel('RENEWAL-456');

//Customer did a chargeback on their first renewal
$customer->chargeback(
  'RENEWAL-123',
  15.98,
  ['chargeback_id' => 'FKJDK-EWKH-4438-FJ']
);

//Account picked up as credit card fraud from chargeback investifation
$customer->markAsFraud('ORDER-123', 12.98, ['reason' => 'Credit Card Fraud']);
