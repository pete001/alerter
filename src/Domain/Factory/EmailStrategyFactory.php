<?php namespace Pete001\Alerter\Domain\Factory;

use Pete001\Alerter\Domain\Entity\Alert;
use Pete001\Alerter\Domain\Service\Traits\AlertTrait;
use Pete001\Alerter\Domain\Service\Email\SwiftStrategy;
use Pete001\Alerter\Domain\Service\Email\SendmailStrategy;

/**
 * Emial strategry factory for sending chat messages
 *
 * @author Pete Cheyne <pete.cheyne@gmail.com>
 */
class EmailStrategyFactory
{
	use AlertTrait;

	public function create(Alert $alert)
	{
		switch ($this->textToDatastore($alert->title)) {
			case 'swift':
				return new SwiftStrategy();
				break;
			case 'sendmail':
				return new SendmailStrategy();
				break;
			default:
				throw new \ErrorException("Invalid email alert type ({$alert->title}) attempted");
		}
	}
}
