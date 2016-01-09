<?php namespace Pete001\Alerter\Domain\Factory;

use Pete001\Alerter\Domain\Entity\Alert;
use Pete001\Alerter\Domain\Entity\AlertDetail;
use Pete001\Alerter\Domain\Service\Traits\AlertTrait;
use Pete001\Alerter\Domain\Service\Sms\TwilioStrategy;

/**
 * Sms strategry factory for sending sms alerts
 *
 * @author Pete Cheyne <pete.cheyne@gmail.com>
 */
class SmsStrategyFactory
{
	use AlertTrait;

	public function create(Alert $alert, AlertDetail ...$requirements)
	{
		switch ($this->textToDatastore($alert->title)) {
			case 'twilio':
				return new TwilioStrategy(...$requirements);
				break;
			default:
				throw new \ErrorException("Invalid sms alert type ({$alert->title}) attempted");
		}
	}
}
