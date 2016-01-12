<?php namespace Pete001\Alerter\Domain\Service;

use Pete001\Alerter\Domain\Repository\AlertRepositoryInterface;
use Pete001\Alerter\Domain\Repository\AlertRequirementRepositoryInterface;
use Pete001\Alerter\Domain\Repository\AlertGroupRepositoryInterface;
use Pete001\Alerter\Domain\Repository\AlertHookRepositoryInterface;
use Pete001\Alerter\Domain\Repository\AlertRegistryRepositoryInterface;
use Pete001\Alerter\Domain\Repository\AlertDetailRepositoryInterface;

use Pete001\Alerter\Domain\Factory\StrategyFactory;
use Pete001\Alerter\Domain\Service\AlerterInterface;

/**
 * Top level alerter class to control firing alerts
 *
 * @author Pete Cheyne <pete.cheyne@gmail.com>
 */
class Alerter implements AlerterInterface
{
    private $alertRepository;
    private $alertRequirementRepository;
    private $alertGroupRepository;
    private $alertHookRepository;
    private $alertRegistryRepository;
    private $alertDetailRepository;
    private $alertStrategy;

    private $registry = [];

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
     * Fire all the relevant alerts
     *
     * @param String $userId  The generic user id who is triggering the alert(s)
     * @param String $hook    The name of the hook
     * @param String $message The raw message to the send
     *
     * @return Void
     */
    public function fire($userId, $hook, $message)
    {
        $result = [];
        $this->initRegistry($userId, $hook);

        foreach ($this->registry as $registry) {
            $alert = $this->getAlert($registry);
            $group = $this->getGroup($alert);
            $details = $this->getDetails($registry);
            $service = $group->create($alert, ...$details);
            $result[] = $service->send($message);
        }

        return $result;
    }

    /**
     * Initialise the registry which returns the alerts
     *
     * @param String $userId  The generic user id who is triggering the alert(s)
     * @param String $hook    The name of the hook
     *
     * @return Array
     */
    private function initRegistry($userId, $hook)
    {
        return $this->registry = $this->getRegistry(
            $userId,
            $this->getHook($hook)
        );
    }

    /**
     * Fetch the individual alert
     *
     * @param String $userId  The generic user id who is triggering the alert(s)
     * @param String $hook    The name of the hook
     *
     * @return Object
     */
    private function getRegistry($userId, $hook)
    {
        return $this->alertRegistryRepository
            ->where('users_id', '=', $userId)
            ->where('alert_hook_id', '=', $hook->id)
            ->getAll();
    }

    /**
     * Fetch the hook object
     *
     * @param String $hook The name of the hook
     *
     * @return Object
     */
    private function getHook($hook)
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
    private function getAlert($registryAlert)
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
    private function getDetails($registryAlert)
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
    private function getGroup($alert)
    {
        return $this->alertStrategy->initialise($alert->getAlertGroup());
    }
}
