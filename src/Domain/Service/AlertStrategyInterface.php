<?php namespace Pete001\Alerter\Domain\Service;

use Pete001\Alerter\Domain\Entity\Alert;

/**
 * Top level alert strategry interface
 *
 * @author Pete Cheyne <pete.cheyne@gmail.com>
 */
interface AlertStrategyInterface
{
	/**
	 * Returns the relevant client
	 *
	 * @return Object
	 */
	public function getClient();

	/**
	 * All alerts must implement a send method, passing a message string
	 *
	 * @param  String $message The message to send
	 * @return Mixed           The relevant alert response
	 */
	public function send($message);
}
