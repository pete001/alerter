<?php namespace Pete001\Alerter\Domain\Service;

/**
 * Chat alert strategry interface
 *
 * @author Pete Cheyne <pete.cheyne@gmail.com>
 */
interface ChatStrategyInterface extends AlertStrategyInterface
{
	/**
	 * All chat alerts require a webhook URL
	 * @return String
	 */
	public function getAuth();

	/**
	 * All chat alerts require a user name
	 * @return String
	 */
	public function getUser();

	/**
	 * All chat alerts require a channel to send the message to
	 * @return String
	 */
	public function getChannel();
}
