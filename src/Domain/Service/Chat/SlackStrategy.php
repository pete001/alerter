<?php namespace Pete001\Alerter\Domain\Service\Chat;

use Pete001\Alerter\Domain\Service\ChatStrategyInterface;
use Pete001\Alerter\Domain\Entity\AlertRequirement;
use Pete001\Alerter\Domain\Service\Traits\AlertTrait;
use Maknz\Slack\Client as SlackClient;

/**
 * Slack strategy for chat alerts
 *
 * @author Pete Cheyne <pete.cheyne@gmail.com>
 */
class SlackStrategy implements ChatStrategyInterface
{
	use AlertTrait;

	/**
	 * The Slack client
	 *
	 * @var Object
	 */
	private $client;

	/**
	 * Array of AlertRequirement objects
	 *
	 * @var Array
	 */
	private $requirements;

	/**
	 * Initialise the client
	 */
	public function __construct(AlertRequirement ...$requirements)
	{
		$this->requirements = $requirements;
		$this->client = new SlackClient($this->getAuth());
	}

	/**
	 * @inheritdoc
	 */
	public function getAuth()
	{
		return $this->required('incoming_webhook_url', $this->requirements);
	}

	/**
	 * @inheritdoc
	 */
	public function getUser()
	{
		return $this->required('username', $this->requirements);
	}

	/**
	 * @inheritdoc
	 */
	public function getChannel()
	{
		return $this->required('channel', $this->requirements);
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
		return $this->getClient()
			->from($this->getUser())
			->to($this->getChannel())
			->send($message);
	}
}
