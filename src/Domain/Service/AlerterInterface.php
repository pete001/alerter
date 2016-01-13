<?php namespace Pete001\Alerter\Domain\Service;

use Pete001\Alerter\Domain\Service\AlertStrategyInterface;
use Pete001\Alerter\Domain\Entity\AlertRegistry;
use Pete001\Alerter\Domain\Entity\Alert;

/**
 * Top level alerter interface
 *
 * @author Pete Cheyne <pete.cheyne@gmail.com>
 */
interface AlerterInterface
{
    /**
     * Queue all the relevant alerts
     *
     * @param String $userId  The generic user id who is triggering the alert(s)
     * @param String $hook    The name of the hook
     * @param String $message The raw message to the send
     *
     * @return True
     */
	public function queue($userId, $hook, $message);

    /**
     * Execute all alerts
     *
     * @return Void
     */
	public function fire();

    /**
     * Add alerts to the queue
     *
     * @param Object $service The service object
     * @param String $message The message to send
     *
     * @return Array
     */
	public function addAlerts(AlertStrategyInterface $service, $message);

    /**
     * Return all executable alerts
     *
     * @return Array
     */
    public function getAlerts();

    /**
     * Fetch the individual alert
     *
     * @param String $userId  The generic user id who is triggering the alert(s)
     * @param String $hook    The name of the hook
     *
     * @return Object
     */
    public function getRegistry($userId, $hook);

    /**
     * Fetch the hook object
     *
     * @param String $hook The name of the hook
     *
     * @return Object
     */
    public function getHook($hook);

    /**
     * Fetch the alert object
     *
     * @param Object $registryAlert The registry object
     *
     * @return Object
     */
    public function getAlert(AlertRegistry $registryAlert);

    /**
     * Fetch the alert details
     *
     * @param Object $registryAlert The registry object
     *
     * @return Array
     */
    public function getDetails(AlertRegistry $registryAlert);

    /**
     * Fetch the alert group
     *
     * @param Object $alert The alert object
     *
     * @return Object
     */
    public function getGroup(Alert $alert);
}
