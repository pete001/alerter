<?php namespace Pete001\Alerter\Domain\Factory;

use Pete001\Alerter\Domain\Entity\AlertGroup;
use Pete001\Alerter\Domain\Service\Traits\StringTrait;

/**
 * Strategy factory for all alert groups
 *
 * @author Pete Cheyne <pete.cheyne@gmail.com>
 */
class StrategyFactory
{
	use StringTrait;

	public function initialise(AlertGroup $group)
	{
		switch ($this->textToDatastore($group->title)) {
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
