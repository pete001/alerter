<?php namespace Pete001\Alerter\Domain\Service;

/**
 * Sms alert strategry interface
 *
 * @author Pete Cheyne <pete.cheyne@gmail.com>
 */
interface SmsStrategyInterface extends AlertStrategyInterface
{
	/**
	 * All sms alerts require authentication with the 3rd party
	 * @return String
	 */
	//public function getAuth();

	/**
	 * Get the sender phone number
	 *
	 * @return String
	 */
	public function getFromNumber();

	/**
	 * Get the recipient phone number
	 *
	 * @return String
	 */
	public function getToNumber();
}
