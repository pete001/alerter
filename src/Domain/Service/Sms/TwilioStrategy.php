<?php namespace Pete001\Alerter\Domain\Service\Sms;

use Pete001\Alerter\Domain\Service\SmsStrategyInterface;

/**
 * Twilio strategy for sms alerts
 *
 * @author Pete Cheyne <pete.cheyne@gmail.com>
 */
class TwilioStrategy implements SmsStrategyInterface, TwilioStrategyInterface
{
	/**
	 * The Twilio client
	 *
	 * @var Object
	 */
	private $client;

	/**
	 * Initialise the client
	 */
	public function __construct()
	{
		$reflector = new \ReflectionClass('\Services_Twilio');
		$this->client = $reflector->newInstanceArgs($this->getAuth());
	}

	/**
	 * @inheretdoc
	 */
	public function getAuth()
	{
		return [$this->getTwilioSid(), $this->getTwilioToken()];
	}

	/**
	 * @inheretdoc
	 */
	public function getTwilioSid()
	{
		return '';
	}

	/**
	 * @inheretdoc
	 */
	public function getTwilioToken()
	{
		return '';
	}

	/**
	 * @inheritdoc
	 */
	public function getFromNumber()
	{
		return '';
	}

	/**
	 * @inheritdoc
	 */
	public function getToNumber()
	{
		return '';
	}

	/**
	 * @inheritdoc
	 */
	public function getClient()
	{
		return $this->client;
	}

	/**
	 * @inheritdoc
	 */
	public function send($message)
	{
		return $this->getClient()->account->messages->sendMessage(
			$this->getFromNumber(),
			$this->getToNumber(),
			$message
		);
	}
}
