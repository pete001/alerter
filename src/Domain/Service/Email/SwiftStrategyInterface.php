<?php namespace Pete001\Alerter\Domain\Service\Email;

/**
 * Swift strategy for email alerts
 *
 * @author Pete Cheyne <pete.cheyne@gmail.com>
 */
interface SwiftStrategyInterface
{
	/**
	 * Setup the email connection
	 *
	 * @return Object
	 */
	public function getAuth();

	/**
	 * Get the smtp server name
	 *
	 * @return String
	 */
	public function getServerName();

	/**
	 * Get the smtp port
	 *
	 * @return String
	 */
	public function getPort();

	/**
	 * Return whether this is ssl
	 *
	 * @return Boolean
	 */
	public function getSsl();

	/**
	 * Get the smtp username
	 *
	 * @return String
	 */
	public function getUsername();

	/**
	 * Return the smtp server password
	 *
	 * @return String
	 */
	public function getPassword();

	/**
	 * Get senders email address
	 *
	 * @return String
	 */
	public function getFromAddress();
}
