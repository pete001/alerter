<?php namespace Pete001\Alerter\Domain\Factory;

use Pete001\Alerter\Domain\Entity\AlertGroup;
use Pete001\Alerter\Domain\Factory\ChatStrategyFactory;

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
			default:
				throw new \ErrorException("Invalid strategy group ({$group->title}) attempted");
		}
	}
}
