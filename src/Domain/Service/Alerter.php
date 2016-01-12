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
        $hook = $this->alertHookRepository->where('title', '=', $hook)->firstOrFail();

        $registryAlerts = $this->alertRegistryRepository
            ->where('users_id', '=', $userId)
            ->where('alert_hook_id', '=', $hook->id)
            ->getAll();

        foreach ($registryAlerts as $registryAlert) {
            $alert = $this->alertRepository->begin();
            $alert = $this->alertRepository->with('alertGroup')->getById($registryAlert->alert_id);
            $detail = $this->alertDetailRepository->begin();
            $detail = $this->alertDetailRepository->with('alertRequirement')->where('alert_registry_id', '=', $registryAlert->id)->getAll();
            $group = $this->alertStrategy->initialise($alert->getAlertGroup());
            $service = $group->create($alert, ...$detail);
            $result = $service->send($message);
        }
    }
}
