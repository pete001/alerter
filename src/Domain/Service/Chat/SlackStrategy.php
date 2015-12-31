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
	public function send()
	{
		$slack = new SlackClient('');
		$slack->from('pete.cheyne')->to('#hubot-dev')->send('testing');
	}
}
