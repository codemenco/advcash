<?php


namespace Codemenco\Advcash\Service;


use Codemenco\Advcash\Mappers\authDTO;
use Codemenco\Advcash\Mappers\createBitcoinInvoice;
use Codemenco\Advcash\Mappers\createBitcoinInvoiceRequest;
use Codemenco\Advcash\Mappers\createBitcoinInvoiceResponse;
use Codemenco\Advcash\Mappers\createBitcoinInvoiceResult;
use Codemenco\Advcash\Mappers\validationSendMoney;
use Codemenco\Advcash\Mappers\validationSendMoneyResponse;
use Codemenco\Advcash\Mappers\sendMoney;
use Codemenco\Advcash\Mappers\sendMoneyResponse;

use Exception;

class MerchantWebService extends \SoapClient
{
	/**
	 * Default class map for wsdl=>php
	 * @access private
	 * @var array
	 */
	private static $classmap = [
		"validationSendMoneyToAdvcashCard" => "validationSendMoneyToAdvcashCard",
		"authDTO" => authDTO::class,
		"advcashCardTransferRequest" => "advcashCardTransferRequest",
		"moneyRequest" => "moneyRequest",
		"validationSendMoneyToAdvcashCardResponse" => "validationSendMoneyToAdvcashCardResponse",
		"sendMoneyToEcoinEU" => "sendMoneyToEcoinEU",
		"withdrawToEcurrencyRequest" => "withdrawToEcurrencyRequest",
		"sendMoneyToEcoinEUResponse" => "sendMoneyToEcoinEUResponse",
		"sendMoneyToEcoinEUResultHolder" => "sendMoneyToEcoinEUResultHolder",
		"sendMoneyToMarketResultHolder" => "sendMoneyToMarketResultHolder",
		"validationCurrencyExchange" => "validationCurrencyExchange",
		"currencyExchangeRequest" => "currencyExchangeRequest",
		"validationCurrencyExchangeResponse" => "validationCurrencyExchangeResponse",
		"history" => "history",
		"MerchantAPITransactionFilter" => "MerchantAPITransactionFilter",
		"historyResponse" => "historyResponse",
		"outcomingTransactionDTO" => "outcomingTransactionDTO",
		"abstractBaseDTO" => "abstractBaseDTO",
		"validateAccount" => "validateAccount",
		"validateAccountRequestDTO" => "validateAccountRequestDTO",
		"validateAccountResponse" => "validateAccountResponse",
		"validateAccountResultDTO" => "validateAccountResultDTO",
		"validateAccounts" => "validateAccounts",
		"validateAccountsResponse" => "validateAccountsResponse",
		"accountPresentDTO" => "accountPresentDTO",
		"validateCurrencyExchange" => "validateCurrencyExchange",
		"transferRequestDTO" => "transferRequestDTO",
		"validateCurrencyExchangeResponse" => "validateCurrencyExchangeResponse",
		"sendMoneyToExmo" => "sendMoneyToExmo",
		"sendMoneyToExmoResponse" => "sendMoneyToExmoResponse",
		"sendMoneyToExmoResultHolder" => "sendMoneyToExmoResultHolder",
		"register" => "register",
		"registrationRequest" => "registrationRequest",
		"registerResponse" => "registerResponse",
		"validationSendMoneyToWex" => "validationSendMoneyToWex",
		"validationSendMoneyToWexResponse" => "validationSendMoneyToWexResponse",
		"findTransaction" => "findTransaction",
		"findTransactionResponse" => "findTransactionResponse",
		"confirmCryptoCurrencyWithdrawalInvoice" => "confirmCryptoCurrencyWithdrawalInvoice",
		"confirmCryptoCurrencyWithdrawalInvoiceRequest" => "confirmCryptoCurrencyWithdrawalInvoiceRequest",
		"confirmCryptoCurrencyWithdrawalInvoiceResponse" => "confirmCryptoCurrencyWithdrawalInvoiceResponse",
		"findCryptoCurrencyWithdrawalInvoiceByOrderId" => "findCryptoCurrencyWithdrawalInvoiceByOrderId",
		"findCryptoCurrencyWithdrawalInvoiceByOrderIdResponse" => "findCryptoCurrencyWithdrawalInvoiceByOrderIdResponse",
		"cryptoCurrencyWithdrawalInvoiceDTO" => "cryptoCurrencyWithdrawalInvoiceDTO",
		"makeCurrencyExchange" => "makeCurrencyExchange",
		"makeCurrencyExchangeResponse" => "makeCurrencyExchangeResponse",
		"sendMoneyToEmail" => "sendMoneyToEmail",
		"sendMoneyRequest" => "sendMoneyRequest",
		"sendMoneyToEmailResponse" => "sendMoneyToEmailResponse",
		"validationSendMoneyToBankCard" => "validationSendMoneyToBankCard",
		"bankCardTransferRequest" => "bankCardTransferRequest",
		"validationSendMoneyToBankCardResponse" => "validationSendMoneyToBankCardResponse",
		"sendMoneyToAdvcashCard" => "sendMoneyToAdvcashCard",
		"sendMoneyToAdvcashCardResponse" => "sendMoneyToAdvcashCardResponse",
		"transferBankCard" => "transferBankCard",
		"bankCardTransferRequestDTO" => "bankCardTransferRequestDTO",
		"transferBankCardResponse" => "transferBankCardResponse",
		"currencyExchange" => "currencyExchange",
		"currencyExchangeResponse" => "currencyExchangeResponse",
		"sendMoney" => sendMoney::class,
		"sendMoneyResponse" => sendMoneyResponse::class,
		"validationSendMoneyToEcurrency" => "validationSendMoneyToEcurrency",
		"validationSendMoneyToEcurrencyResponse" => "validationSendMoneyToEcurrencyResponse",
		"sendMoneyToEcurrency" => "sendMoneyToEcurrency",
		"sendMoneyToEcurrencyResponse" => "sendMoneyToEcurrencyResponse",
		"transferAdvcashCard" => "transferAdvcashCard",
		"advcashCardTransferRequestDTO" => "advcashCardTransferRequestDTO",
		"transferAdvcashCardResponse" => "transferAdvcashCardResponse",
		"createCryptoCurrencyWithdrawalInvoice" => "createCryptoCurrencyWithdrawalInvoice",
		"createCryptoCurrencyWithdrawalInvoiceResponse" => "createCryptoCurrencyWithdrawalInvoiceResponse",
		"validateBankCardTransfer" => "validateBankCardTransfer",
		"validateBankCardTransferResponse" => "validateBankCardTransferResponse",
		"emailTransfer" => "emailTransfer",
		"emailTransferRequestDTO" => "emailTransferRequestDTO",
		"emailTransferResponse" => "emailTransferResponse",
		"makeTransfer" => "makeTransfer",
		"makeTransferResponse" => "makeTransferResponse",
		"validationSendMoneyToEmail" => "validationSendMoneyToEmail",
		"validationSendMoneyToEmailResponse" => "validationSendMoneyToEmailResponse",
		"withdrawalThroughExternalPaymentSystem" => "withdrawalThroughExternalPaymentSystem",
		"withdrawalThroughExternalPaymentSystemRequestDTO" => "withdrawalThroughExternalPaymentSystemRequestDTO",
		"withdrawalThroughExternalPaymentSystemResponse" => "withdrawalThroughExternalPaymentSystemResponse",
		"sendMoneyToBankCard" => "sendMoneyToBankCard",
		"sendMoneyToBankCardResponse" => "sendMoneyToBankCardResponse",
		"validationSendMoneyToEcoinEU" => "validationSendMoneyToEcoinEU",
		"validationSendMoneyToEcoinEUResponse" => "validationSendMoneyToEcoinEUResponse",
		"validationSendMoneyToExmo" => "validationSendMoneyToExmo",
		"validationSendMoneyToExmoResponse" => "validationSendMoneyToExmoResponse",
		"validateAdvcashCardTransfer" => "validateAdvcashCardTransfer",
		"validateAdvcashCardTransferResponse" => "validateAdvcashCardTransferResponse",
		"findPaymentByOrderId" => "findPaymentByOrderId",
		"paymentOrderRequest" => "paymentOrderRequest",
		"findPaymentByOrderIdResponse" => "findPaymentByOrderIdResponse",
		"paymentOrderResult" => "paymentOrderResult",
		"findCryptoCurrencyWithdrawalInvoiceById" => "findCryptoCurrencyWithdrawalInvoiceById",
		"findCryptoCurrencyWithdrawalInvoiceByIdResponse" => "findCryptoCurrencyWithdrawalInvoiceByIdResponse",
		"validateWithdrawalThroughExternalPaymentSystem" => "validateWithdrawalThroughExternalPaymentSystem",
		"validateWithdrawalThroughExternalPaymentSystemResponse" => "validateWithdrawalThroughExternalPaymentSystemResponse",
		"cancelProtectedTransfer" => "cancelProtectedTransfer",
		"cancelProtectedTransferResponse" => "cancelProtectedTransferResponse",
		"cancelProtectedTransferResultHolder" => "cancelProtectedTransferResultHolder",
		"createApi" => "createApi",
		"createApiRequest" => "createApiRequest",
		"createApiResponse" => "createApiResponse",
		"createCryptoCurrencyInvoice" => "createCryptoCurrencyInvoice",
		"createCryptoCurrencyInvoiceRequest" => "createCryptoCurrencyInvoiceRequest",
		"createCryptoCurrencyInvoiceResponse" => "createCryptoCurrencyInvoiceResponse",
		"createCryptoCurrencyInvoiceResult" => "createCryptoCurrencyInvoiceResult",
		"validateEmailTransfer" => "validateEmailTransfer",
		"validateEmailTransferResponse" => "validateEmailTransferResponse",
		"validateTransfer" => "validateTransfer",
		"validateTransferResponse" => "validateTransferResponse",
		"validationSendMoney" => validationSendMoney::class,
		"validationSendMoneyResponse" => validationSendMoneyResponse::class,
		"createBitcoinInvoice"         => createBitcoinInvoice::class,
		"createBitcoinInvoiceRequest"  => createBitcoinInvoiceRequest::class,
		"createBitcoinInvoiceResponse" => createBitcoinInvoiceResponse::class,
		"createBitcoinInvoiceResult"   => createBitcoinInvoiceResult::class,
		"checkCurrencyExchange" => "checkCurrencyExchange",
		"checkCurrencyExchangeRequest" => "checkCurrencyExchangeRequest",
		"checkCurrencyExchangeResponse" => "checkCurrencyExchangeResponse",
		"checkCurrencyExchangeResultHolder" => "checkCurrencyExchangeResultHolder",
		"getBalances" => "getBalances",
		"getBalancesResponse" => "getBalancesResponse",
		"walletBalanceDTO" => "walletBalanceDTO",
		"sendMoneyToWex" => "sendMoneyToWex",
		"sendMoneyToWexResponse" => "sendMoneyToWexResponse",
		"sendMoneyToWexResultHolder" => "sendMoneyToWexResultHolder",
		"cardType" => "cardType",
		"currency" => "currency",
		"exceptionType" => "exceptionType",
		"coinName" => "coinName",
		"depositPaymentMethodType" => "depositPaymentMethodType",
		"dateIntervals" => "dateIntervals",
		"ecurrency" => "ecurrency",
		"currencyExchangeAction" => "currencyExchangeAction",
		"sortOrder" => "sortOrder",
		"transactionDirection" => "transactionDirection",
		"transactionName" => "transactionName",
		"transactionStatus" => "transactionStatus",
		"verificationStatus" => "verificationStatus",
		"supportedLanguage" => "supportedLanguage",
		"sciAllowedPaymentSystems" => "sciAllowedPaymentSystems",
		"cryptoCurrencyWithdrawalInvoiceStatus" => "cryptoCurrencyWithdrawalInvoiceStatus",
		"typeOfTransaction" => "typeOfTransaction",
		"externalSystemWithdrawalType" => "externalSystemWithdrawalType",
		"cryptoCurrencyDepositPaymentStatus" => "cryptoCurrencyDepositPaymentStatus",
		"paymentRequestStatus" => "paymentRequestStatus",
		"operationResult" => "operationResult",
		"tetherTransportProtocol" => "tetherTransportProtocol",
		"InternalException" => "InternalException",
		"BadParametersException" => "BadParametersException",
		"CardIsNotActiveException" => "CardIsNotActiveException",
		"LimitPerTransactionException" => "LimitPerTransactionException",
		"LimitPerMonthException" => "LimitPerMonthException",
		"WrongParamsException" => "WrongParamsException",
		"WrongIpException" => "WrongIpException",
		"UserBlockedException" => "UserBlockedException",
		"MerchantDisabledException" => "MerchantDisabledException",
		"CountLimitException" => "CountLimitException",
		"AdvcashCardMaxAllowedBalanceExceededException" => "AdvcashCardMaxAllowedBalanceExceededException",
		"AccessDeniedException" => "AccessDeniedException",
		"TransactionIsNotAvailableException" => "TransactionIsNotAvailableException",
		"LimitPerDayException" => "LimitPerDayException",
		"DatabaseException" => "DatabaseException",
		"CardDoesNotExistException" => "CardDoesNotExistException",
		"LifetimeLimitException" => "LifetimeLimitException",
		"WalletDoesNotExist" => "WalletDoesNotExist",
		"NotAuthException" => "NotAuthException",
		"NotEnoughMoneyException" => "NotEnoughMoneyException",
		"TransactionFailureException" => "TransactionFailureException",
		"LimitPerCardPerDayException" => "LimitPerCardPerDayException",
		"TransactionTemporaryNotAvailableException" => "TransactionTemporaryNotAvailableException",
		"ApiException" => "ApiException",
		"ExchangeCurrencyException" => "ExchangeCurrencyException",
		"NotEnoughMoneyApiException" => "NotEnoughMoneyApiException",
		"CallRestrictionException" => "CallRestrictionException",
		"LimitsException" => "LimitsException",
		"UserDoesNotExistException" => "UserDoesNotExistException",
		"EmailAlreadyExistException" => "EmailAlreadyExistException",
		"RegistrationException" => "RegistrationException",
		"JAXBException" => "JAXBException",
		"WrongEmailException" => "WrongEmailException",
		"AdditionalDataRequiredException" => "AdditionalDataRequiredException",
		"CardNumberIsNotValidException" => "CardNumberIsNotValidException",
		"NotSupportedBankBinException" => "NotSupportedBankBinException",
		"NotSupportedCountryException" => "NotSupportedCountryException",
		"WalletCurrencyIncorrectException" => "WalletCurrencyIncorrectException",
		"CodeIsNotValidException" => "CodeIsNotValidException",
		"DuplicateOrderIdException" => "DuplicateOrderIdException",
		"NotAvailableDepositSystemException" => "NotAvailableDepositSystemException",
	];

	/**
	 * Constructor using wsdl location and options array
	 * @param string $wsdl WSDL location for this service
	 * @param array $options Options for the SoapClient
	 */
	public function __construct($wsdl="https://wallet.advcash.com/wsm/merchantWebService?wsdl", $options = [])
	{
		foreach(self::$classmap as $wsdlClassName => $phpClassName) {
			if(!isset($options['classmap'][$wsdlClassName])) {
				$options['classmap'][$wsdlClassName] = $phpClassName;
			}
		}
		$options['location'] = 'https://wallet.advcash.com/wsm/merchantWebService';
		libxml_disable_entity_loader(false);
		parent::__construct($wsdl, $options);
	}

	/**
	 * Checks if an argument list matches against a valid argument type list
	 * @param array $arguments The argument list to check
	 * @param array $validParameters A list of valid argument types
	 * @return boolean true if arguments match against validParameters
	 * @throws Exception invalid function signature message
	 */
	public function _checkArguments($arguments, $validParameters) {
		$variables = "";
		foreach ($arguments as $arg) {
			$type = gettype($arg);
			if ($type == "object") {
				$type = get_class($arg);
			}
			$variables .= "(".$type.")";
		}
		if (!in_array($variables, $validParameters)) {
			throw new Exception("Invalid parameter types: ".str_replace(")(", ", ", $variables));
		}
		return true;
	}

	/**
	 * Service Call: validationSendMoneyToAdvcashCard
	 * Parameter options:
	 * (validationSendMoneyToAdvcashCard) parameters
	 * @param mixed,... See function description for parameter options
	 * @return validationSendMoneyToAdvcashCardResponse
	 * @throws Exception invalid function signature message
	 */
	public function validationSendMoneyToAdvcashCard($mixed = null) {
		$validParameters = array(
			"(validationSendMoneyToAdvcashCard)",
		);
		$args = func_get_args();
		$this->_checkArguments($args, $validParameters);
		return $this->__soapCall("validationSendMoneyToAdvcashCard", $args);
	}


	/**
	 * Service Call: sendMoneyToEcoinEU
	 * Parameter options:
	 * (sendMoneyToEcoinEU) parameters
	 * @param mixed,... See function description for parameter options
	 * @return sendMoneyToEcoinEUResponse
	 * @throws Exception invalid function signature message
	 */
	public function sendMoneyToEcoinEU($mixed = null) {
		$validParameters = array(
			"(sendMoneyToEcoinEU)",
		);
		$args = func_get_args();
		$this->_checkArguments($args, $validParameters);
		return $this->__soapCall("sendMoneyToEcoinEU", $args);
	}


	/**
	 * Service Call: validationCurrencyExchange
	 * Parameter options:
	 * (validationCurrencyExchange) parameters
	 * @param mixed,... See function description for parameter options
	 * @return validationCurrencyExchangeResponse
	 * @throws Exception invalid function signature message
	 */
	public function validationCurrencyExchange($mixed = null) {
		$validParameters = array(
			"(validationCurrencyExchange)",
		);
		$args = func_get_args();
		$this->_checkArguments($args, $validParameters);
		return $this->__soapCall("validationCurrencyExchange", $args);
	}


	/**
	 * Service Call: history
	 * Parameter options:
	 * (history) parameters
	 * @param mixed,... See function description for parameter options
	 * @return historyResponse
	 * @throws Exception invalid function signature message
	 */
	public function history($mixed = null) {
		$validParameters = array(
			"(history)",
		);
		$args = func_get_args();
		$this->_checkArguments($args, $validParameters);
		return $this->__soapCall("history", $args);
	}


	/**
	 * Service Call: validateAccount
	 * Parameter options:
	 * (validateAccount) parameters
	 * @param mixed,... See function description for parameter options
	 * @return validateAccountResponse
	 * @throws Exception invalid function signature message
	 */
	public function validateAccount($mixed = null) {
		$validParameters = array(
			"(validateAccount)",
		);
		$args = func_get_args();
		$this->_checkArguments($args, $validParameters);
		return $this->__soapCall("validateAccount", $args);
	}


	/**
	 * Service Call: validateAccounts
	 * Parameter options:
	 * (validateAccounts) parameters
	 * @param mixed,... See function description for parameter options
	 * @return validateAccountsResponse
	 * @throws Exception invalid function signature message
	 */
	public function validateAccounts($mixed = null) {
		$validParameters = array(
			"(validateAccounts)",
		);
		$args = func_get_args();
		$this->_checkArguments($args, $validParameters);
		return $this->__soapCall("validateAccounts", $args);
	}


	/**
	 * Service Call: validateCurrencyExchange
	 * Parameter options:
	 * (validateCurrencyExchange) parameters
	 * @param mixed,... See function description for parameter options
	 * @return validateCurrencyExchangeResponse
	 * @throws Exception invalid function signature message
	 */
	public function validateCurrencyExchange($mixed = null) {
		$validParameters = array(
			"(validateCurrencyExchange)",
		);
		$args = func_get_args();
		$this->_checkArguments($args, $validParameters);
		return $this->__soapCall("validateCurrencyExchange", $args);
	}


	/**
	 * Service Call: sendMoneyToExmo
	 * Parameter options:
	 * (sendMoneyToExmo) parameters
	 * @param mixed,... See function description for parameter options
	 * @return sendMoneyToExmoResponse
	 * @throws Exception invalid function signature message
	 */
	public function sendMoneyToExmo($mixed = null) {
		$validParameters = array(
			"(sendMoneyToExmo)",
		);
		$args = func_get_args();
		$this->_checkArguments($args, $validParameters);
		return $this->__soapCall("sendMoneyToExmo", $args);
	}


	/**
	 * Service Call: register
	 * Parameter options:
	 * (register) parameters
	 * @param mixed,... See function description for parameter options
	 * @return registerResponse
	 * @throws Exception invalid function signature message
	 */
	public function register($mixed = null) {
		$validParameters = array(
			"(register)",
		);
		$args = func_get_args();
		$this->_checkArguments($args, $validParameters);
		return $this->__soapCall("register", $args);
	}


	/**
	 * Service Call: validationSendMoneyToWex
	 * Parameter options:
	 * (validationSendMoneyToWex) parameters
	 * @param mixed,... See function description for parameter options
	 * @return validationSendMoneyToWexResponse
	 * @throws Exception invalid function signature message
	 */
	public function validationSendMoneyToWex($mixed = null) {
		$validParameters = array(
			"(validationSendMoneyToWex)",
		);
		$args = func_get_args();
		$this->_checkArguments($args, $validParameters);
		return $this->__soapCall("validationSendMoneyToWex", $args);
	}


	/**
	 * Service Call: findTransaction
	 * Parameter options:
	 * (findTransaction) parameters
	 * @param mixed,... See function description for parameter options
	 * @return findTransactionResponse
	 * @throws Exception invalid function signature message
	 */
	public function findTransaction($mixed = null) {
		$validParameters = array(
			"(findTransaction)",
		);
		$args = func_get_args();
		$this->_checkArguments($args, $validParameters);
		return $this->__soapCall("findTransaction", $args);
	}


	/**
	 * Service Call: confirmCryptoCurrencyWithdrawalInvoice
	 * Parameter options:
	 * (confirmCryptoCurrencyWithdrawalInvoice) parameters
	 * @param mixed,... See function description for parameter options
	 * @return confirmCryptoCurrencyWithdrawalInvoiceResponse
	 * @throws Exception invalid function signature message
	 */
	public function confirmCryptoCurrencyWithdrawalInvoice($mixed = null) {
		$validParameters = array(
			"(confirmCryptoCurrencyWithdrawalInvoice)",
		);
		$args = func_get_args();
		$this->_checkArguments($args, $validParameters);
		return $this->__soapCall("confirmCryptoCurrencyWithdrawalInvoice", $args);
	}


	/**
	 * Service Call: findCryptoCurrencyWithdrawalInvoiceByOrderId
	 * Parameter options:
	 * (findCryptoCurrencyWithdrawalInvoiceByOrderId) parameters
	 * @param mixed,... See function description for parameter options
	 * @return findCryptoCurrencyWithdrawalInvoiceByOrderIdResponse
	 * @throws Exception invalid function signature message
	 */
	public function findCryptoCurrencyWithdrawalInvoiceByOrderId($mixed = null) {
		$validParameters = array(
			"(findCryptoCurrencyWithdrawalInvoiceByOrderId)",
		);
		$args = func_get_args();
		$this->_checkArguments($args, $validParameters);
		return $this->__soapCall("findCryptoCurrencyWithdrawalInvoiceByOrderId", $args);
	}


	/**
	 * Service Call: makeCurrencyExchange
	 * Parameter options:
	 * (makeCurrencyExchange) parameters
	 * @param mixed,... See function description for parameter options
	 * @return makeCurrencyExchangeResponse
	 * @throws Exception invalid function signature message
	 */
	public function makeCurrencyExchange($mixed = null) {
		$validParameters = array(
			"(makeCurrencyExchange)",
		);
		$args = func_get_args();
		$this->_checkArguments($args, $validParameters);
		return $this->__soapCall("makeCurrencyExchange", $args);
	}


	/**
	 * Service Call: sendMoneyToEmail
	 * Parameter options:
	 * (sendMoneyToEmail) parameters
	 * @param mixed,... See function description for parameter options
	 * @return sendMoneyToEmailResponse
	 * @throws Exception invalid function signature message
	 */
	public function sendMoneyToEmail($mixed = null) {
		$validParameters = array(
			"(sendMoneyToEmail)",
		);
		$args = func_get_args();
		$this->_checkArguments($args, $validParameters);
		return $this->__soapCall("sendMoneyToEmail", $args);
	}


	/**
	 * Service Call: validationSendMoneyToBankCard
	 * Parameter options:
	 * (validationSendMoneyToBankCard) parameters
	 * @param mixed,... See function description for parameter options
	 * @return validationSendMoneyToBankCardResponse
	 * @throws Exception invalid function signature message
	 */
	public function validationSendMoneyToBankCard($mixed = null) {
		$validParameters = array(
			"(validationSendMoneyToBankCard)",
		);
		$args = func_get_args();
		$this->_checkArguments($args, $validParameters);
		return $this->__soapCall("validationSendMoneyToBankCard", $args);
	}


	/**
	 * Service Call: sendMoneyToAdvcashCard
	 * Parameter options:
	 * (sendMoneyToAdvcashCard) parameters
	 * @param mixed,... See function description for parameter options
	 * @return sendMoneyToAdvcashCardResponse
	 * @throws Exception invalid function signature message
	 */
	public function sendMoneyToAdvcashCard($mixed = null) {
		$validParameters = array(
			"(sendMoneyToAdvcashCard)",
		);
		$args = func_get_args();
		$this->_checkArguments($args, $validParameters);
		return $this->__soapCall("sendMoneyToAdvcashCard", $args);
	}


	/**
	 * Service Call: transferBankCard
	 * Parameter options:
	 * (transferBankCard) parameters
	 * @param mixed,... See function description for parameter options
	 * @return transferBankCardResponse
	 * @throws Exception invalid function signature message
	 */
	public function transferBankCard($mixed = null) {
		$validParameters = array(
			"(transferBankCard)",
		);
		$args = func_get_args();
		$this->_checkArguments($args, $validParameters);
		return $this->__soapCall("transferBankCard", $args);
	}


	/**
	 * Service Call: currencyExchange
	 * Parameter options:
	 * (currencyExchange) parameters
	 * @param mixed,... See function description for parameter options
	 * @return currencyExchangeResponse
	 * @throws Exception invalid function signature message
	 */
	public function currencyExchange($mixed = null) {
		$validParameters = array(
			"(currencyExchange)",
		);
		$args = func_get_args();
		$this->_checkArguments($args, $validParameters);
		return $this->__soapCall("currencyExchange", $args);
	}


	/**
	 * Service Call: sendMoney
	 * Parameter options:
	 * (sendMoney) parameters
	 * @param mixed,... See function description for parameter options
	 * @return sendMoneyResponse
	 * @throws Exception invalid function signature message
	 */
	public function sendMoney($mixed = null) {
		$validParameters = array(
			"(sendMoney)",
		);
		$args = func_get_args();
//		$this->_checkArguments($args, $validParameters);
		return $this->__soapCall("sendMoney", $args);
	}


	/**
	 * Service Call: validationSendMoneyToEcurrency
	 * Parameter options:
	 * (validationSendMoneyToEcurrency) parameters
	 * @param mixed,... See function description for parameter options
	 * @return validationSendMoneyToEcurrencyResponse
	 * @throws Exception invalid function signature message
	 */
	public function validationSendMoneyToEcurrency($mixed = null) {
		$validParameters = array(
			"(validationSendMoneyToEcurrency)",
		);
		$args = func_get_args();
		$this->_checkArguments($args, $validParameters);
		return $this->__soapCall("validationSendMoneyToEcurrency", $args);
	}


	/**
	 * Service Call: sendMoneyToEcurrency
	 * Parameter options:
	 * (sendMoneyToEcurrency) parameters
	 * @param mixed,... See function description for parameter options
	 * @return sendMoneyToEcurrencyResponse
	 * @throws Exception invalid function signature message
	 */
	public function sendMoneyToEcurrency($mixed = null) {
		$validParameters = array(
			"(sendMoneyToEcurrency)",
		);
		$args = func_get_args();
		$this->_checkArguments($args, $validParameters);
		return $this->__soapCall("sendMoneyToEcurrency", $args);
	}


	/**
	 * Service Call: transferAdvcashCard
	 * Parameter options:
	 * (transferAdvcashCard) parameters
	 * @param mixed,... See function description for parameter options
	 * @return transferAdvcashCardResponse
	 * @throws Exception invalid function signature message
	 */
	public function transferAdvcashCard($mixed = null) {
		$validParameters = array(
			"(transferAdvcashCard)",
		);
		$args = func_get_args();
		$this->_checkArguments($args, $validParameters);
		return $this->__soapCall("transferAdvcashCard", $args);
	}


	/**
	 * Service Call: createCryptoCurrencyWithdrawalInvoice
	 * Parameter options:
	 * (createCryptoCurrencyWithdrawalInvoice) parameters
	 * @param mixed,... See function description for parameter options
	 * @return createCryptoCurrencyWithdrawalInvoiceResponse
	 * @throws Exception invalid function signature message
	 */
	public function createCryptoCurrencyWithdrawalInvoice($mixed = null) {
		$validParameters = array(
			"(createCryptoCurrencyWithdrawalInvoice)",
		);
		$args = func_get_args();
		$this->_checkArguments($args, $validParameters);
		return $this->__soapCall("createCryptoCurrencyWithdrawalInvoice", $args);
	}


	/**
	 * Service Call: validateBankCardTransfer
	 * Parameter options:
	 * (validateBankCardTransfer) parameters
	 * @param mixed,... See function description for parameter options
	 * @return validateBankCardTransferResponse
	 * @throws Exception invalid function signature message
	 */
	public function validateBankCardTransfer($mixed = null) {
		$validParameters = array(
			"(validateBankCardTransfer)",
		);
		$args = func_get_args();
		$this->_checkArguments($args, $validParameters);
		return $this->__soapCall("validateBankCardTransfer", $args);
	}


	/**
	 * Service Call: emailTransfer
	 * Parameter options:
	 * (emailTransfer) parameters
	 * @param mixed,... See function description for parameter options
	 * @return emailTransferResponse
	 * @throws Exception invalid function signature message
	 */
	public function emailTransfer($mixed = null) {
		$validParameters = array(
			"(emailTransfer)",
		);
		$args = func_get_args();
		$this->_checkArguments($args, $validParameters);
		return $this->__soapCall("emailTransfer", $args);
	}


	/**
	 * Service Call: makeTransfer
	 * Parameter options:
	 * (makeTransfer) parameters
	 * @param mixed,... See function description for parameter options
	 * @return makeTransferResponse
	 * @throws Exception invalid function signature message
	 */
	public function makeTransfer($mixed = null) {
		$validParameters = array(
			"(makeTransfer)",
		);
		$args = func_get_args();
		$this->_checkArguments($args, $validParameters);
		return $this->__soapCall("makeTransfer", $args);
	}


	/**
	 * Service Call: validationSendMoneyToEmail
	 * Parameter options:
	 * (validationSendMoneyToEmail) parameters
	 * @param mixed,... See function description for parameter options
	 * @return validationSendMoneyToEmailResponse
	 * @throws Exception invalid function signature message
	 */
	public function validationSendMoneyToEmail($mixed = null) {
		$validParameters = array(
			"(validationSendMoneyToEmail)",
		);
		$args = func_get_args();
		$this->_checkArguments($args, $validParameters);
		return $this->__soapCall("validationSendMoneyToEmail", $args);
	}


	/**
	 * Service Call: withdrawalThroughExternalPaymentSystem
	 * Parameter options:
	 * (withdrawalThroughExternalPaymentSystem) parameters
	 * @param mixed,... See function description for parameter options
	 * @return withdrawalThroughExternalPaymentSystemResponse
	 * @throws Exception invalid function signature message
	 */
	public function withdrawalThroughExternalPaymentSystem($mixed = null) {
		$validParameters = array(
			"(withdrawalThroughExternalPaymentSystem)",
		);
		$args = func_get_args();
		$this->_checkArguments($args, $validParameters);
		return $this->__soapCall("withdrawalThroughExternalPaymentSystem", $args);
	}


	/**
	 * Service Call: sendMoneyToBankCard
	 * Parameter options:
	 * (sendMoneyToBankCard) parameters
	 * @param mixed,... See function description for parameter options
	 * @return sendMoneyToBankCardResponse
	 * @throws Exception invalid function signature message
	 */
	public function sendMoneyToBankCard($mixed = null) {
		$validParameters = array(
			"(sendMoneyToBankCard)",
		);
		$args = func_get_args();
		$this->_checkArguments($args, $validParameters);
		return $this->__soapCall("sendMoneyToBankCard", $args);
	}


	/**
	 * Service Call: validationSendMoneyToEcoinEU
	 * Parameter options:
	 * (validationSendMoneyToEcoinEU) parameters
	 * @param mixed,... See function description for parameter options
	 * @return validationSendMoneyToEcoinEUResponse
	 * @throws Exception invalid function signature message
	 */
	public function validationSendMoneyToEcoinEU($mixed = null) {
		$validParameters = array(
			"(validationSendMoneyToEcoinEU)",
		);
		$args = func_get_args();
		$this->_checkArguments($args, $validParameters);
		return $this->__soapCall("validationSendMoneyToEcoinEU", $args);
	}


	/**
	 * Service Call: validationSendMoneyToExmo
	 * Parameter options:
	 * (validationSendMoneyToExmo) parameters
	 * @param mixed,... See function description for parameter options
	 * @return validationSendMoneyToExmoResponse
	 * @throws Exception invalid function signature message
	 */
	public function validationSendMoneyToExmo($mixed = null) {
		$validParameters = array(
			"(validationSendMoneyToExmo)",
		);
		$args = func_get_args();
		$this->_checkArguments($args, $validParameters);
		return $this->__soapCall("validationSendMoneyToExmo", $args);
	}


	/**
	 * Service Call: validateAdvcashCardTransfer
	 * Parameter options:
	 * (validateAdvcashCardTransfer) parameters
	 * @param mixed,... See function description for parameter options
	 * @return validateAdvcashCardTransferResponse
	 * @throws Exception invalid function signature message
	 */
	public function validateAdvcashCardTransfer($mixed = null) {
		$validParameters = array(
			"(validateAdvcashCardTransfer)",
		);
		$args = func_get_args();
		$this->_checkArguments($args, $validParameters);
		return $this->__soapCall("validateAdvcashCardTransfer", $args);
	}


	/**
	 * Service Call: findPaymentByOrderId
	 * Parameter options:
	 * (findPaymentByOrderId) parameters
	 * @param mixed,... See function description for parameter options
	 * @return findPaymentByOrderIdResponse
	 * @throws Exception invalid function signature message
	 */
	public function findPaymentByOrderId($mixed = null) {
		$validParameters = array(
			"(findPaymentByOrderId)",
		);
		$args = func_get_args();
		$this->_checkArguments($args, $validParameters);
		return $this->__soapCall("findPaymentByOrderId", $args);
	}


	/**
	 * Service Call: findCryptoCurrencyWithdrawalInvoiceById
	 * Parameter options:
	 * (findCryptoCurrencyWithdrawalInvoiceById) parameters
	 * @param mixed,... See function description for parameter options
	 * @return findCryptoCurrencyWithdrawalInvoiceByIdResponse
	 * @throws Exception invalid function signature message
	 */
	public function findCryptoCurrencyWithdrawalInvoiceById($mixed = null) {
		$validParameters = array(
			"(findCryptoCurrencyWithdrawalInvoiceById)",
		);
		$args = func_get_args();
		$this->_checkArguments($args, $validParameters);
		return $this->__soapCall("findCryptoCurrencyWithdrawalInvoiceById", $args);
	}


	/**
	 * Service Call: validateWithdrawalThroughExternalPaymentSystem
	 * Parameter options:
	 * (validateWithdrawalThroughExternalPaymentSystem) parameters
	 * @param mixed,... See function description for parameter options
	 * @return validateWithdrawalThroughExternalPaymentSystemResponse
	 * @throws Exception invalid function signature message
	 */
	public function validateWithdrawalThroughExternalPaymentSystem($mixed = null) {
		$validParameters = array(
			"(validateWithdrawalThroughExternalPaymentSystem)",
		);
		$args = func_get_args();
		$this->_checkArguments($args, $validParameters);
		return $this->__soapCall("validateWithdrawalThroughExternalPaymentSystem", $args);
	}


	/**
	 * Service Call: cancelProtectedTransfer
	 * Parameter options:
	 * (cancelProtectedTransfer) parameters
	 * @param mixed,... See function description for parameter options
	 * @return cancelProtectedTransferResponse
	 * @throws Exception invalid function signature message
	 */
	public function cancelProtectedTransfer($mixed = null) {
		$validParameters = array(
			"(cancelProtectedTransfer)",
		);
		$args = func_get_args();
		$this->_checkArguments($args, $validParameters);
		return $this->__soapCall("cancelProtectedTransfer", $args);
	}


	/**
	 * Service Call: createApi
	 * Parameter options:
	 * (createApi) parameters
	 * @param mixed,... See function description for parameter options
	 * @return createApiResponse
	 * @throws Exception invalid function signature message
	 */
	public function createApi($mixed = null) {
		$validParameters = array(
			"(createApi)",
		);
		$args = func_get_args();
		$this->_checkArguments($args, $validParameters);
		return $this->__soapCall("createApi", $args);
	}


	/**
	 * Service Call: createCryptoCurrencyInvoice
	 * Parameter options:
	 * (createCryptoCurrencyInvoice) parameters
	 * @param mixed,... See function description for parameter options
	 * @return createCryptoCurrencyInvoiceResponse
	 * @throws Exception invalid function signature message
	 */
	public function createCryptoCurrencyInvoice($mixed = null) {
		$validParameters = array(
			"(createCryptoCurrencyInvoice)",
		);
		$args = func_get_args();
		$this->_checkArguments($args, $validParameters);
		return $this->__soapCall("createCryptoCurrencyInvoice", $args);
	}


	/**
	 * Service Call: validateEmailTransfer
	 * Parameter options:
	 * (validateEmailTransfer) parameters
	 * @param mixed,... See function description for parameter options
	 * @return validateEmailTransferResponse
	 * @throws Exception invalid function signature message
	 */
	public function validateEmailTransfer($mixed = null) {
		$validParameters = array(
			"(validateEmailTransfer)",
		);
		$args = func_get_args();
		$this->_checkArguments($args, $validParameters);
		return $this->__soapCall("validateEmailTransfer", $args);
	}


	/**
	 * Service Call: validateTransfer
	 * Parameter options:
	 * (validateTransfer) parameters
	 * @param mixed,... See function description for parameter options
	 * @return validateTransferResponse
	 * @throws Exception invalid function signature message
	 */
	public function validateTransfer($mixed = null) {
		$validParameters = array(
			"(validateTransfer)",
		);
		$args = func_get_args();
		$this->_checkArguments($args, $validParameters);
		return $this->__soapCall("validateTransfer", $args);
	}


	/**
	 * Service Call: validationSendMoney
	 * Parameter options:
	 * (validationSendMoney) parameters
	 * @param mixed,... See function description for parameter options
	 * @return validationSendMoneyResponse
	 * @throws Exception invalid function signature message
	 */
	public function validationSendMoney($mixed = null) {
		$validParameters = array(
			"(validationSendMoney)",
		);

		$args = func_get_args();
//		$this->_checkArguments($args, $validParameters);
		return $this->__soapCall("validationSendMoney", $args);
	}


	/**
	 * Service Call: createBitcoinInvoice
	 * Parameter options:
	 * (createBitcoinInvoice) parameters
	 * @param mixed,... See function description for parameter options
	 * @return createBitcoinInvoiceResponse
	 * @throws Exception invalid function signature message
	 */
	public function createBitcoinInvoice($mixed = null) {
		$validParameters = array(
			"(createBitcoinInvoice)",
		);
		$args = func_get_args();
		//$this->_checkArguments($args, $validParameters);
		return $this->__soapCall("createBitcoinInvoice", $args);
	}


	/**
	 * Service Call: checkCurrencyExchange
	 * Parameter options:
	 * (checkCurrencyExchange) parameters
	 * @param mixed,... See function description for parameter options
	 * @return checkCurrencyExchangeResponse
	 * @throws Exception invalid function signature message
	 */
	public function checkCurrencyExchange($mixed = null) {
		$validParameters = array(
			"(checkCurrencyExchange)",
		);
		$args = func_get_args();
		$this->_checkArguments($args, $validParameters);
		return $this->__soapCall("checkCurrencyExchange", $args);
	}


	/**
	 * Service Call: getBalances
	 * Parameter options:
	 * (getBalances) parameters
	 * @param mixed,... See function description for parameter options
	 * @return getBalancesResponse
	 * @throws Exception invalid function signature message
	 */
	public function getBalances($mixed = null) {
		$validParameters = array(
			"(getBalances)",
		);
		$args = func_get_args();
		$this->_checkArguments($args, $validParameters);
		return $this->__soapCall("getBalances", $args);
	}


	/**
	 * Service Call: sendMoneyToWex
	 * Parameter options:
	 * (sendMoneyToWex) parameters
	 * @param mixed,... See function description for parameter options
	 * @return sendMoneyToWexResponse
	 * @throws Exception invalid function signature message
	 */
	public function sendMoneyToWex($mixed = null) {
		$validParameters = array(
			"(sendMoneyToWex)",
		);
		$args = func_get_args();
		$this->_checkArguments($args, $validParameters);
		return $this->__soapCall("sendMoneyToWex", $args);
	}

	public function getAuthenticationToken($securityWord) {
		$gmt = gmdate('Ymd:H');
		$token = hash("sha256", $securityWord . ':' . $gmt);
		return $token;
	}
}
