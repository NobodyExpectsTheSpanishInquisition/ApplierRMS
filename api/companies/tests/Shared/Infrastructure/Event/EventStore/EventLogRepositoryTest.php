<?php

namespace App\Tests\Shared\Infrastructure\Event\EventStore;

use App\Tests\IntegrationTestCase;
use App\Write\Shared\Application\Event\EventId;
use App\Write\Shared\Application\Transaction\CannotPersistException;
use App\Write\Shared\Infrastructure\Entity\EventLog;
use App\Write\Shared\Infrastructure\Event\EventStore\EventData;
use App\Write\Shared\Infrastructure\Event\EventStore\EventLogRepository;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;

final class EventLogRepositoryTest extends IntegrationTestCase
{
    private EventLogRepository $repository;
    private EntityManagerInterface $entityManager;

    public function test_Save_ShouldThrowException_WhenTransactionIsNotActive(): void
    {
        $this->expectException(CannotPersistException::class);
        $this->expectErrorMessage(CannotPersistException::becauseTransactionIsNotActive(EventLog::class)->getMessage());

        $this->repository->save(
            new EventLog(
                new EventId('61F6FE5D-0710-4A86-BFF2-7BCD5AAD50FD'),
                new EventStub('test'),
                new EventData(json_encode(['test' => 'test'], JSON_THROW_ON_ERROR)),
                new DateTimeImmutable()
            )
        );
    }

    public function test_Save_ShouldSaveEventLog_WhenTransactionIsActive(): void
    {
        $this->entityManager->beginTransaction();

        $eventLog = new EventLog(
            new EventId('61F6FE5D-0710-4A86-BFF2-7BCD5AAD50FD'),
            new EventStub('test'),
            new EventData(json_encode(['test' => 'test'], JSON_THROW_ON_ERROR)),
            new DateTimeImmutable()
        );

        $this->repository->save($eventLog);

        self::assertTrue($this->entityManager->getUnitOfWork()->isScheduledForInsert($eventLog));

        $this->entityManager->rollback();
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->repository = $this->container->get(EventLogRepository::class);
        $this->entityManager = $this->container->get(EntityManagerInterface::class);
    }
}
