<?php namespace Pete001\Alerter\Domain\Factory;

use Pete001\Alerter\Domain\Entity\Alert;
use Pete001\Alerter\Domain\Entity\AlertRequirement;
use Pete001\Alerter\Domain\Service\Traits\AlertTrait;
use Pete001\Alerter\Domain\Service\Chat\SlackStrategy;

/**
 * Chat strategry factory for sending chat messages
 *
 * @author Pete Cheyne <pete.cheyne@gmail.com>
 */
class ChatStrategyFactory
{
	use AlertTrait;

	public function create(Alert $alert, AlertRequirement ...$requirements)
	{
		switch ($this->textToDatastore($alert->title)) {
			case 'slack':
				return new SlackStrategy(...$requirements);
				break;
			default:
				throw new \ErrorException("Invalid chat alert type ({$alert->title}) attempted");
		}
	}
}
