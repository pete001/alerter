<?php namespace Pete001\Alerter\Domain\Service\Email;

use Pete001\Alerter\Domain\Service\EmailStrategyInterface;

/**
 * Native sendmail strategy for email alerts
 *
 * @author Pete Cheyne <pete.cheyne@gmail.com>
 */
class SendmailStrategy implements EmailStrategyInterface
{
	/**
	 * The Slack client
	 *
	 * @var Object
	 */
	private $client;

	/**
	 * Initialise the client
	 */
	public function __construct()
	{
		$this->client = 'mail';
	}

	/**
	 * @inheritdoc
	 */
	public function getToAddress()
	{
		return 'pete.cheyne@gmail.com';
	}

	/**
	 * @inheritdoc
	 */
	public function getSubject()
	{
		return 'DDD Email';
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
		return call_user_func_array(
			$this->getClient(), [
				$this->getToAddress(),
				$this->getSubject(),
				$message
			]
		);
	}
}
