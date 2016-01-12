<?php namespace Pete001\Alerter\Domain\Service;

/**
 * Top level alerter interface
 *
 * @author Pete Cheyne <pete.cheyne@gmail.com>
 */
interface AlerterInterface
{
	/**
	 * Dispatch the alerts
	 *
	 * @return Object
	 */
	public function fire($userId, $hook, $message);
}
