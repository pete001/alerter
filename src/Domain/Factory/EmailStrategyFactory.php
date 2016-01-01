<?php namespace Pete001\Alerter\Domain\Factory;

use Pete001\Alerter\Domain\Entity\Alert;
use Pete001\Alerter\Domain\Service\Email\SwiftStrategy;

/**
 * Emial strategry factory for sending chat messages
 *
 * @author Pete Cheyne <pete.cheyne@gmail.com>
 */
class EmailStrategyFactory
{
	public function create(Alert $alert)
	{
		switch ($alert->title) {
			case 'swift':
				return new SwiftStrategy();
				break;
			default:
				throw new \ErrorException("Invalid email alert type ({$alert->title}) attempted");
		}
	}
}
