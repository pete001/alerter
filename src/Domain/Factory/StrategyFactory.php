<?php namespace Pete001\Alerter\Domain\Factory;

use Pete001\Alerter\Domain\Entity\AlertGroup;

/**
 * Strategy factory for all alert groups
 *
 * @author Pete Cheyne <pete.cheyne@gmail.com>
 */
class StrategyFactory
{
	public function initialise(AlertGroup $group)
	{
		switch ($group->title) {
			case 'chat':
				return new ChatStrategyFactory();
				break;
			case 'email':
				return new EmailStrategyFactory();
				break;
			case 'sms':
				return new SmsStrategyFactory();
				break;
			default:
				throw new \ErrorException("Invalid strategy group ({$group->title}) attempted");
		}
	}
}
