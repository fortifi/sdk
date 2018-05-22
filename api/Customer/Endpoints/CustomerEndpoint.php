<?php
namespace Fortifi\FortifiApi\Customer\Endpoints;

use Fortifi\FortifiApi\Customer\Payloads\AddOfferCustomerPayload;
use Fortifi\FortifiApi\Customer\Payloads\AnonymizeCustomerPayload;
use Fortifi\FortifiApi\Customer\Payloads\CreateCustomerPayload;
use Fortifi\FortifiApi\Customer\Payloads\CustomerAddressFidPayload;
use Fortifi\FortifiApi\Customer\Payloads\CustomerAddressPayload;
use Fortifi\FortifiApi\Customer\Payloads\CustomerEmailFidPayload;
use Fortifi\FortifiApi\Customer\Payloads\CustomerEmailPayload;
use Fortifi\FortifiApi\Customer\Payloads\CustomerPhoneFidPayload;
use Fortifi\FortifiApi\Customer\Payloads\CustomerPhonePayload;
use Fortifi\FortifiApi\Customer\Payloads\CustomerSetAffiliatePayload;
use Fortifi\FortifiApi\Customer\Payloads\CustomerSetLocationPayload;
use Fortifi\FortifiApi\Customer\Payloads\CustomerVisitorPayload;
use Fortifi\FortifiApi\Customer\Payloads\SubjectAccessRequestPayload;
use Fortifi\FortifiApi\Customer\Payloads\UpdateCustomerPayload;
use Fortifi\FortifiApi\Customer\Responses\CustomerBillingDataResponse;
use Fortifi\FortifiApi\Customer\Responses\CustomerOfferResponse;
use Fortifi\FortifiApi\Customer\Responses\CustomerOffersResponse;
use Fortifi\FortifiApi\Customer\Responses\CustomerResponse;
use Fortifi\FortifiApi\Customer\Responses\CustomersResponse;
use Fortifi\FortifiApi\Customer\Responses\CustomerSubjectAccessRequestsResponse;
use Fortifi\FortifiApi\Edge\Payloads\EdgePayload;
use Fortifi\FortifiApi\Foundation\Endpoints\AbstractFortifiEndpoint;
use Fortifi\FortifiApi\Foundation\Payloads\DataNodePropertyPayload;
use Fortifi\FortifiApi\Foundation\Payloads\FidPayload;
use Fortifi\FortifiApi\Foundation\Payloads\MarkDatePayload;
use Fortifi\FortifiApi\Foundation\Payloads\PaginatedDataNodePayload;
use Fortifi\FortifiApi\Foundation\Requests\FortifiApiRequestInterface;
use Fortifi\FortifiApi\Foundation\Responses\BoolResponse;
use Fortifi\FortifiApi\Foundation\Responses\FidResponse;
use Fortifi\FortifiApi\Foundation\Responses\FidsResponse;
use Fortifi\FortifiApi\Messenger\Responses\History\MessengerSendHistoriesResponse;
use Fortifi\FortifiApi\Property\Responses\PropertiesRetrieveResponse;
use Fortifi\FortifiApi\Traffic\Responses\VisitorsResponse;

class CustomerEndpoint extends AbstractFortifiEndpoint
{
  protected $_path = '/customer';

  /**
   * @param CreateCustomerPayload $payload
   *
   * @return FortifiApiRequestInterface|CustomerResponse
   */
  public function createProspect(CreateCustomerPayload $payload)
  {
    return self::_createRequest($payload, 'create/contact');
  }

  /**
   * @param CreateCustomerPayload $payload
   *
   * @return FortifiApiRequestInterface|CustomerResponse
   */
  public function createCustomer(CreateCustomerPayload $payload)
  {
    return self::_createRequest($payload, 'create/customer');
  }

  /**
   * @return FortifiApiRequestInterface|PropertiesRetrieveResponse
   */
  public function properties()
  {
    return self::_createRequest(null, 'properties');
  }

  /**
   * @param MarkDatePayload $payload
   *
   * @return FortifiApiRequestInterface|BoolResponse
   */
  public function open(MarkDatePayload $payload)
  {
    return self::_createRequest($payload, 'open');
  }

  /**
   * @param FidPayload $payload
   *
   * @return FortifiApiRequestInterface|BoolResponse
   */
  public function delete(FidPayload $payload)
  {
    return self::_createRequest($payload, 'delete');
  }

  /**
   * @param FidPayload $payload
   *
   * @return FortifiApiRequestInterface|BoolResponse
   */
  public function restore(FidPayload $payload)
  {
    return self::_createRequest($payload, 'restore');
  }

  /**
   * @param FidPayload $payload
   *
   * @return FortifiApiRequestInterface|BoolResponse
   */
  public function close(FidPayload $payload)
  {
    return self::_createRequest($payload, 'close');
  }

  /**
   * @param FidPayload $payload
   *
   * @return FortifiApiRequestInterface|CustomerResponse
   */
  public function retrieve(FidPayload $payload)
  {
    return self::_createRequest($payload, 'retrieve');
  }

  /**
   * @param PaginatedDataNodePayload $payload
   *
   * @return FortifiApiRequestInterface|CustomersResponse
   */
  public function all(PaginatedDataNodePayload $payload)
  {
    return self::_createRequest($payload, 'list');
  }

  /**
   * @param UpdateCustomerPayload $payload
   *
   * @return FortifiApiRequestInterface|BoolResponse
   */
  public function update(UpdateCustomerPayload $payload)
  {
    return self::_createRequest($payload, 'update');
  }

  /**
   * @param MarkDatePayload $payload
   *
   * @return FortifiApiRequestInterface|BoolResponse
   */
  public function markChargeback(MarkDatePayload $payload)
  {
    return self::_createRequest($payload, 'mark/chargeback');
  }

  /**
   * @param MarkDatePayload $payload
   *
   * @return FortifiApiRequestInterface|BoolResponse
   */
  public function markDiscount(MarkDatePayload $payload)
  {
    return self::_createRequest($payload, 'mark/discount');
  }

  /**
   * @param MarkDatePayload $payload
   *
   * @return FortifiApiRequestInterface|BoolResponse
   */
  public function markFraud(MarkDatePayload $payload)
  {
    return self::_createRequest($payload, 'mark/fraud');
  }

  /**
   * @param MarkDatePayload $payload
   *
   * @return FortifiApiRequestInterface|BoolResponse
   */
  public function markImpulse(MarkDatePayload $payload)
  {
    return self::_createRequest($payload, 'mark/impulse');
  }

  /**
   * @param MarkDatePayload $payload
   *
   * @return FortifiApiRequestInterface|BoolResponse
   */
  public function markPurchased(MarkDatePayload $payload)
  {
    return self::_createRequest($payload, 'mark/purchased');
  }

  /**
   * @param MarkDatePayload $payload
   *
   * @return FortifiApiRequestInterface|BoolResponse
   */
  public function markQualified(MarkDatePayload $payload)
  {
    return self::_createRequest($payload, 'mark/qualified');
  }

  /**
   * @param MarkDatePayload $payload
   *
   * @return FortifiApiRequestInterface|BoolResponse
   */
  public function markRefunded(MarkDatePayload $payload)
  {
    return self::_createRequest($payload, 'mark/refunded');
  }

  /**
   * @param MarkDatePayload $payload
   *
   * @return FortifiApiRequestInterface|BoolResponse
   */
  public function markRenewing(MarkDatePayload $payload)
  {
    return self::_createRequest($payload, 'mark/renewing');
  }

  /**
   * @param DataNodePropertyPayload $payload
   *
   * @return FortifiApiRequestInterface|BoolResponse
   */
  public function setLanguage(DataNodePropertyPayload $payload)
  {
    return self::_createRequest($payload, 'set/language');
  }

  /**
   * @param DataNodePropertyPayload $payload
   *
   * @return FortifiApiRequestInterface|BoolResponse
   */
  public function setLoyal(DataNodePropertyPayload $payload)
  {
    return self::_createRequest($payload, 'set/loyal');
  }

  /**
   * @param DataNodePropertyPayload $payload
   *
   * @return FortifiApiRequestInterface|BoolResponse
   */
  public function setVip(DataNodePropertyPayload $payload)
  {
    return self::_createRequest($payload, 'set/vip');
  }

  /**
   * @param DataNodePropertyPayload $payload
   *
   * @return FortifiApiRequestInterface|BoolResponse
   */
  public function setTestAccount(DataNodePropertyPayload $payload)
  {
    return self::_createRequest($payload, 'set/testAccount');
  }

  /**
   * @param DataNodePropertyPayload $payload
   *
   * @return FortifiApiRequestInterface|BoolResponse
   */
  public function setSubscription(DataNodePropertyPayload $payload)
  {
    return self::_createRequest($payload, 'set/subscription');
  }

  /**
   * @param DataNodePropertyPayload $payload
   *
   * @return FortifiApiRequestInterface|BoolResponse
   */
  public function setAccountStatus(DataNodePropertyPayload $payload)
  {
    return self::_createRequest($payload, 'set/accountStatus');
  }

  /**
   * @param DataNodePropertyPayload $payload
   *
   * @return FortifiApiRequestInterface|BoolResponse
   */
  public function setAccountType(DataNodePropertyPayload $payload)
  {
    return self::_createRequest($payload, 'set/accountType');
  }

  /**
   * @param CustomerSetAffiliatePayload $payload
   *
   * @return FortifiApiRequestInterface|BoolResponse
   */
  public function setAffiliate(CustomerSetAffiliatePayload $payload)
  {
    return self::_createRequest($payload, 'set/affiliate');
  }

  /**
   * @param DataNodePropertyPayload $payload
   *
   * @return FortifiApiRequestInterface|BoolResponse
   */
  public function setCurrency(DataNodePropertyPayload $payload)
  {
    return self::_createRequest($payload, 'set/currency');
  }

  /**
   * @param CustomerSetLocationPayload $payload
   *
   * @return FortifiApiRequestInterface|BoolResponse
   */
  public function setLocation(CustomerSetLocationPayload $payload)
  {
    return self::_createRequest($payload, 'set/location');
  }

  /**
   * @param DataNodePropertyPayload $payload
   *
   * @return FortifiApiRequestInterface|BoolResponse
   */
  public function setSubscriptionType(DataNodePropertyPayload $payload)
  {
    return self::_createRequest($payload, 'set/subscriptionType');
  }

  /**
   * @param DataNodePropertyPayload $payload
   *
   * @return FortifiApiRequestInterface|BoolResponse
   */
  public function setUnsubscribed(DataNodePropertyPayload $payload)
  {
    return self::_createRequest($payload, 'set/unsubscribed');
  }

  /**
   * @param DataNodePropertyPayload $payload
   *
   * @return FortifiApiRequestInterface|BoolResponse
   */
  public function setCompany(DataNodePropertyPayload $payload)
  {
    return self::_createRequest($payload, 'set/company');
  }

  /**
   * @param DataNodePropertyPayload $payload
   *
   * @return FortifiApiRequestInterface|BoolResponse
   */
  public function setAccountManager(DataNodePropertyPayload $payload)
  {
    return self::_createRequest($payload, 'set/accountManager');
  }

  /**
   * @param CustomerEmailPayload $payload
   *
   * @return FortifiApiRequestInterface|BoolResponse
   */
  public function addEmail(CustomerEmailPayload $payload)
  {
    return self::_createRequest($payload, 'add-email');
  }

  /**
   * @param CustomerEmailFidPayload $payload
   *
   * @return FortifiApiRequestInterface|BoolResponse
   */
  public function removeEmail(CustomerEmailFidPayload $payload)
  {
    return self::_createRequest($payload, 'remove-email');
  }

  /**
   * @param CustomerPhonePayload $payload
   *
   * @return FortifiApiRequestInterface|BoolResponse
   */
  public function addPhone(CustomerPhonePayload $payload)
  {
    return self::_createRequest($payload, 'add-phone');
  }

  /**
   * @param CustomerPhoneFidPayload $payload
   *
   * @return FortifiApiRequestInterface|BoolResponse
   */
  public function removePhone(CustomerPhoneFidPayload $payload)
  {
    return self::_createRequest($payload, 'remove-phone');
  }

  /**
   * @param CustomerAddressPayload $payload
   *
   * @return FortifiApiRequestInterface|FidResponse
   */
  public function addAddress(CustomerAddressPayload $payload)
  {
    return self::_createRequest($payload, 'add-address');
  }

  /**
   * @param CustomerAddressFidPayload $payload
   *
   * @return FortifiApiRequestInterface|BoolResponse
   */
  public function removeAddress(CustomerAddressFidPayload $payload)
  {
    return self::_createRequest($payload, 'remove-address');
  }

  // billing data

  /**
   * @param FidPayload $payload
   *
   * @return FortifiApiRequestInterface|CustomerBillingDataResponse
   */
  public function retrieveBilling(FidPayload $payload)
  {
    return self::_createRequest($payload, 'billing/retrieve');
  }

  /**
   * @param DataNodePropertyPayload $payload
   *
   * @return FortifiApiRequestInterface|BoolResponse
   */
  public function setBillingType(DataNodePropertyPayload $payload)
  {
    return self::_createRequest($payload, 'billing/set-billing-type');
  }

  /**
   * @param DataNodePropertyPayload $payload
   *
   * @return FortifiApiRequestInterface|BoolResponse
   */
  public function setTaxNumber(DataNodePropertyPayload $payload)
  {
    return self::_createRequest($payload, 'billing/set-tax-number');
  }

  /**
   * @param DataNodePropertyPayload $payload
   *
   * @return FortifiApiRequestInterface|BoolResponse
   */
  public function setCompanyNumber(DataNodePropertyPayload $payload)
  {
    return self::_createRequest($payload, 'billing/set-company-number');
  }

  /**
   * @param DataNodePropertyPayload $payload
   *
   * @return FortifiApiRequestInterface|BoolResponse
   */
  public function setKnownIP(DataNodePropertyPayload $payload)
  {
    return self::_createRequest($payload, 'billing/set-ip');
  }

  // Offers

  /**
   * @param AddOfferCustomerPayload $payload
   *
   * @return FortifiApiRequestInterface|BoolResponse
   */
  public function addOffer(AddOfferCustomerPayload $payload)
  {
    return self::_createRequest($payload, 'offers/add');
  }

  /**
   * @param DataNodePropertyPayload $payload
   *
   * @return FortifiApiRequestInterface|BoolResponse
   */
  public function removeOffer(DataNodePropertyPayload $payload)
  {
    return self::_createRequest($payload, 'offers/remove');
  }

  /**
   * @param PaginatedDataNodePayload $payload
   *
   * @return FortifiApiRequestInterface|CustomerOffersResponse
   */
  public function listOffers(PaginatedDataNodePayload $payload)
  {
    return self::_createRequest($payload, 'offers/list');
  }

  /**
   * @param FidPayload $payload
   *
   * @return FortifiApiRequestInterface|CustomerOfferResponse
   */
  public function retrieveOffer(FidPayload $payload)
  {
    return self::_createRequest($payload, 'offers/retrieve');
  }

  // Emails the customer has recieved

  /**
   * @param FidPayload $payload
   *
   * @return FortifiApiRequestInterface|MessengerSendHistoriesResponse
   */
  public function listEmails(FidPayload $payload)
  {
    return self::_createRequest($payload, 'list-emails');
  }

  // Visitors

  /**
   * @param CustomerVisitorPayload $payload
   *
   * @return FortifiApiRequestInterface|BoolResponse
   */
  public function link(CustomerVisitorPayload $payload)
  {
    return self::_createRequest($payload, 'link');
  }

  /**
   * @param EdgePayload $payload
   *
   * @return FortifiApiRequestInterface|VisitorsResponse|FidsResponse
   */
  public function listVisitorsByCustomer(EdgePayload $payload)
  {
    return self::_createRequest($payload, 'list-visitors');
  }

  /**
   * @param EdgePayload $payload
   *
   * @return FortifiApiRequestInterface|CustomersResponse|FidsResponse
   */
  public function listCustomersByVisitor(EdgePayload $payload)
  {
    return self::_createRequest($payload, 'list-customers');
  }

  /**
   * @param SubjectAccessRequestPayload $payload Customer Fid
   *
   * @return FortifiApiRequestInterface|BoolResponse SAR Initiated
   */
  public function initSubjectAccessRequest(SubjectAccessRequestPayload $payload)
  {
    return self::_createRequest($payload, 'sar/init');
  }

  /**
   * @param FidPayload $payload Customer Fid
   *
   * @return FortifiApiRequestInterface|CustomerSubjectAccessRequestsResponse
   */
  public function listSubjectAccessRequest(FidPayload $payload)
  {
    return self::_createRequest($payload, 'sar/list');
  }

  /**
   * @param AnonymizeCustomerPayload $payload Customer Fid
   *
   * @return FortifiApiRequestInterface|BoolResponse
   */
  public function anonymize(AnonymizeCustomerPayload $payload)
  {
    return self::_createRequest($payload, 'anonymize');
  }
}
