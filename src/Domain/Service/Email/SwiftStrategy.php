<?php namespace Pete001\Alerter\Domain\Service\Email;

use Pete001\Alerter\Domain\Service\EmailStrategyInterface;

/**
 * Swift strategy for email alerts
 *
 * @author Pete Cheyne <pete.cheyne@gmail.com>
 */
class SwiftStrategy implements EmailStrategyInterface, SwiftStrategyInterface
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
		$this->client = \Swift_Mailer::newInstance($this->getAuth());
	}

	/**
	 * Initialise the client
	 */
	public function getAuth()
	{
		return \Swift_SmtpTransport::newInstance($this->getServerName(), $this->getPort(), $this->getSsl() ? 'ssl' : '')
			->setUsername($this->getUsername())
			->setPassword($this->getPassword());
	}

	/**
	 * @inheritdoc
	 */
	public function getServerName()
	{
		return 'smtp.gmail.com';
	}

	/**
	 * @inheritdoc
	 */
	public function getPort()
	{
		return '465';
	}

	/**
	 * @inheritdoc
	 */
	public function getSsl()
	{
		return true;
	}

	/**
	 * @inheritdoc
	 */
	public function getUsername()
	{
		return 'pete.cheyne@gmail.com';
	}

	/**
	 * @inheritdoc
	 */
	public function getPassword()
	{
		return '';
	}

	/**
	 * @inheritdoc
	 */
	public function getFromAddress()
	{
		return 'pete.cheyne@gmail.com';
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
		$email = \Swift_Message::newInstance($this->getSubject())
			->setFrom($this->getFromAddress())
			->setTo($this->getToAddress())
			->setBody($message);

		$this->getClient()->send($email);
	}
}
