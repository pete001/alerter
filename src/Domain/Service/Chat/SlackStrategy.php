<?php namespace Pete001\Alerter\Domain\Service\Chat;

use Pete001\Alerter\Domain\Service\ChatStrategyInterface;
use Maknz\Slack\Client as SlackClient;

/**
 * Slack strategy for chat alerts
 *
 * @author Pete Cheyne <pete.cheyne@gmail.com>
 */
class SlackStrategy implements ChatStrategyInterface
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
		$this->client = new SlackClient($this->getAuth());
	}

	/**
	 * @inheritdoc
	 */
	public function getAuth()
	{
		return 'https://hooks.slack.com/services/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';
	}

	/**
	 * @inheritdoc
	 */
	public function getUser()
	{
		return 'pete.cheyne';
	}

	/**
	 * @inheritdoc
	 */
	public function getChannel()
	{
		return '#hubot-dev';
	}

	/**
	 * @inheritdoc
	 */
	public function send($message)
	{
		return $this->client
			->from($this->getUser())
			->to($this->getChannel())
			->send($message);
	}
}
