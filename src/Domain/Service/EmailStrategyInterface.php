<?php namespace Pete001\Alerter\Domain\Service;

/**
 * Email alert strategry interface
 *
 * @author Pete Cheyne <pete.cheyne@gmail.com>
 */
interface EmailStrategyInterface extends AlertStrategyInterface
{
	/**
	 * Get the recipient address
	 *
	 * @return String
	 */
	public function getToAddress();

	/**
	 * Get the email subject
	 *
	 * @return String
	 */
	public function getSubject();
}
