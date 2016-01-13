<?php namespace Pete001\Alerter\Domain\Service\Sms;

use Pete001\Alerter\Domain\Service\SmsStrategyInterface;
use Pete001\Alerter\Domain\Entity\AlertDetail;
use Pete001\Alerter\Domain\Service\Traits\AlertTrait;

/**
 * Twilio strategy for sms alerts
 *
 * @author Pete Cheyne <pete.cheyne@gmail.com>
 */
class TwilioStrategy implements SmsStrategyInterface, TwilioStrategyInterface
{
	use AlertTrait;

	/**
	 * The Twilio client
	 *
	 * @var Object
	 */
	private $client;

	/**
	 * Array of AlertDetail objects
	 *
	 * @var Array
	 */
	private $requirements;

	/**
	 * Initialise the client
	 */
	public function __construct(AlertDetail ...$requirements)
	{
		$this->requirements = $requirements;
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
		return $this->getRequirement('twilio_sid', $this->requirements);
	}

	/**
	 * @inheretdoc
	 */
	public function getTwilioToken()
	{
		return $this->getRequirement('twilio_token', $this->requirements);
	}

	/**
	 * @inheritdoc
	 */
	public function getFromNumber()
	{
		return $this->getRequirement('from_number', $this->requirements);
	}

	/**
	 * @inheritdoc
	 */
	public function getToNumber()
	{
		return $this->getRequirement('to_number', $this->requirements);
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
