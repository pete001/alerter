<?php namespace Pete001\Alerter\Domain\Service;

use Pete001\Alerter\Domain\Repository\AlertRepositoryInterface;
use Pete001\Alerter\Domain\Repository\AlertRequirementRepositoryInterface;
use Pete001\Alerter\Domain\Repository\AlertGroupRepositoryInterface;
use Pete001\Alerter\Domain\Repository\AlertHookRepositoryInterface;
use Pete001\Alerter\Domain\Repository\AlertRegistryRepositoryInterface;
use Pete001\Alerter\Domain\Repository\AlertDetailRepositoryInterface;

use Pete001\Alerter\Domain\Entity\AlertRegistry;
use Pete001\Alerter\Domain\Entity\Alert;

use Pete001\Alerter\Domain\Factory\StrategyFactory;

use Pete001\Alerter\Domain\Service\AlerterInterface;
use Pete001\Alerter\Domain\Service\AlertStrategyInterface;

/**
 * Top level alerter class to control firing alerts
 *
 * @author Pete Cheyne <pete.cheyne@gmail.com>
 */
class Alerter implements AlerterInterface
{
    /**
     * Clean repositories
     */
    private $alertRepository;
    private $alertRequirementRepository;
    private $alertGroupRepository;
    private $alertHookRepository;
    private $alertRegistryRepository;
    private $alertDetailRepository;
    private $alertStrategy;

    /**
     * Array to hold all alert services with associated message
     *
     * @var Array
     */
    private $alerts = [];

    /**
     * Initialise
     *
     * @param AlertRepositoryInterface            $alertRepository
     * @param AlertRequirementRepositoryInterface $alertRequirementRepository
     * @param AlertGroupRepositoryInterface       $alertGroupRepository
     * @param AlertHookRepositoryInterface        $alertHookRepository
     * @param AlertRegistryRepositoryInterface    $alertRegistryRepository
     * @param AlertDetailRepositoryInterface      $alertDetailRepository
     * @param StrategyFactory                     $alertStrategy
     */
    public function __construct(
        AlertRepositoryInterface $alertRepository,
        AlertRequirementRepositoryInterface $alertRequirementRepository,
        AlertGroupRepositoryInterface $alertGroupRepository,
        AlertHookRepositoryInterface $alertHookRepository,
        AlertRegistryRepositoryInterface $alertRegistryRepository,
        AlertDetailRepositoryInterface $alertDetailRepository,
        StrategyFactory $alertStrategy
    )
    {
        $this->alertRepository = $alertRepository;
        $this->alertRequirementRepository = $alertRequirementRepository;
        $this->alertGroupRepository = $alertGroupRepository;
        $this->alertHookRepository = $alertHookRepository;
        $this->alertRegistryRepository = $alertRegistryRepository;
        $this->alertDetailRepository = $alertDetailRepository;
        $this->alertStrategy = $alertStrategy;
    }

    /**
     * Queue all the relevant alerts
     *
     * @param String $userId  The generic user id who is triggering the alert(s)
     * @param String $hook    The name of the hook
     * @param String $message The raw message to the send
     *
     * @return True
     */
    public function queue($userId, $hook, $message)
    {
        foreach ($this->getRegistry($userId, $hook) as $registry) {
            $alert = $this->getAlert($registry);
            $group = $this->getGroup($alert);
            $details = $this->getDetails($registry);
            $service = $group->create($alert, ...$details);
            $this->addAlerts($service, $message);
        }

        return $this;
    }

    /**
     * Execute all alerts
     *
     * @return Void
     */
    public function fire()
    {
        foreach ($this->getAlerts() as $alert) {
            $alert[0]->send($alert[1]);
        }
    }

    /**
     * Add alerts to the queue
     *
     * @param Object $service The service object
     * @param String $message The message to send
     *
     * @return Array
     */
    public function addAlerts(AlertStrategyInterface $service, $message)
    {
        return $this->alerts[] = [$service, $message];
    }

    /**
     * Return all executable alerts
     *
     * @return Array
     */
    public function getAlerts()
    {
        return $this->alerts;
    }

    /**
     * Fetch the individual alert
     *
     * @param String $userId  The generic user id who is triggering the alert(s)
     * @param String $hook    The name of the hook
     *
     * @return Object
     */
    public function getRegistry($userId, $hook)
    {
        return $this->registry = $this->alertRegistryRepository
            ->where('users_id', '=', $userId)
            ->where('alert_hook_id', '=', $this->getHook($hook)->id)
            ->getAll();
    }

    /**
     * Fetch the hook object
     *
     * @param String $hook The name of the hook
     *
     * @return Object
     */
    public function getHook($hook)
    {
        return $this->alertHookRepository->where('title', '=', $hook)->firstOrFail();
    }

    /**
     * Fetch the alert object
     *
     * @param Object $registryAlert The registry object
     *
     * @return Object
     */
    public function getAlert(AlertRegistry $registryAlert)
    {
        $alert = $this->alertRepository->begin();
        return $this->alertRepository->with('alertGroup')->getById($registryAlert->alert_id);
    }

    /**
     * Fetch the alert details
     *
     * @param Object $registryAlert The registry object
     *
     * @return Array
     */
    public function getDetails(AlertRegistry $registryAlert)
    {
        $detail = $this->alertDetailRepository->begin();
        return $this->alertDetailRepository->with('alertRequirement')->where('alert_registry_id', '=', $registryAlert->id)->getAll();
    }

    /**
     * Fetch the alert group
     *
     * @param Object $alert The alert object
     *
     * @return Object
     */
    public function getGroup(Alert $alert)
    {
        return $this->alertStrategy->initialise($alert->getAlertGroup());
    }
}
