<?php namespace Pete001\Alerter\Domain\Service\Sms;

/**
 * Specific interface for twilio
 *
 * @author Pete Cheyne <pete.cheyne@gmail.com>
 */
interface TwilioStrategyInterface
{
	/**
	 * Get the Twilio SID
	 *
	 * @return String
	 */
	public function getTwilioSid();

	/**
	 * Get the Twilio auth token
	 *
	 * @return String
	 */
	public function getTwilioToken();
}
