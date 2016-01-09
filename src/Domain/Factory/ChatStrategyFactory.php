<?php namespace Pete001\Alerter\Domain\Factory;

use Pete001\Alerter\Domain\Entity\Alert;
use Pete001\Alerter\Domain\Service\Traits\StringTrait;
use Pete001\Alerter\Domain\Service\Chat\SlackStrategy;

/**
 * Chat strategry factory for sending chat messages
 *
 * @author Pete Cheyne <pete.cheyne@gmail.com>
 */
class ChatStrategyFactory
{
	use StringTrait;

	public function create(Alert $alert)
	{
		switch ($this->textToDatastore($alert->title)) {
			case 'slack':
				return new SlackStrategy();
				break;
			default:
				throw new \ErrorException("Invalid chat alert type ({$alert->title}) attempted");
		}
	}
}
