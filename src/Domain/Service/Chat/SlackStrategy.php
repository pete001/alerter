<?php namespace Pete001\Alerter\Domain\Service\Chat;

use Pete001\Alerter\Domain\Service\ChatStrategyInterface;
use Pete001\Alerter\Domain\Entity\AlertDetail;
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
	 * Optional icon param
	 *
	 * @param Object $client The slack client
	 *
	 * @return Mixed
	 */
	protected function getIcon($client)
	{
		if ($optional = $this->optional('icon', $this->requirements)) {
			$client = $client->withIcon($optional);
		}

		return $client;
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
		// Required params
		$client = $this->getClient()
			->from($this->getUser())
			->to($this->getChannel());

		// Optional params
		$client = $this->getIcon($client);

		// Send
		$client->send($message);
	}
}
