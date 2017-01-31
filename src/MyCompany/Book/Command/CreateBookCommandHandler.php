<?php

namespace MyCompany\InformationRequest\Command\BuyRequest;

use Gindumac\InformationRequest\DomainModel\BuyRequest\BuyRequestEntityWrite;
use Gindumac\InformationRequest\DomainModel\BuyRequest\BuyRequestEntityWriteRepository;
use Gindumac\InformationRequest\DomainModel\BuyRequest\BuyRequestSavedSendEmailToManagementEvent;

use SimpleBus\Message\Bus\MessageBus;

class BuyRequestCommandHandler
{
    /** @var BuyRequestEntityWriteRepository */
    private $buyRequestEntityWriteRepository;
    /** @var MessageBus */
    private $eventBus;

    public function __construct(
        BuyRequestEntityWriteRepository $buyRequestEntityWriteRepository,
        MessageBus $eventBus
    ) {
        $this->buyRequestEntityWriteRepository = $buyRequestEntityWriteRepository;
        $this->eventBus = $eventBus;
    }
    /**
     * @param BuyRequestCommand $command
     */
    public function handle(BuyRequestCommand $command)
    {
        $buyRequest = BuyRequestEntityWrite::create(
            $command->buyRequestID(),
            $command->contactName(),
            $command->company(),
            $command->email(),
            $command->phone(),
            $command->comments()
        );

        $this->buyRequestEntityWriteRepository->save($buyRequest);

        $buyRequestSavedSendEmailToManagementEvent = new BuyRequestSavedSendEmailToManagementEvent($buyRequest);
        $this->eventBus->handle($buyRequestSavedSendEmailToManagementEvent);
    }
}
