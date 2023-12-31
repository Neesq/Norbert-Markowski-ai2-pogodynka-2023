<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use App\Repository\LocationRepository;
use App\Service\WeatherUtil;

#[AsCommand(
    name: 'weather:location',
    description: 'Add a short description for your command',
)]
class WeatherLocationCommand extends Command
{
    public function __construct(private WeatherUtil $weatherUtil, private LocationRepository $locationRepository)
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('id', InputArgument::OPTIONAL, 'Id of location')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $locationId = $input->getArgument('id');
        $location = $this->locationRepository->find($locationId);


        $measurements = $this->weatherUtil->getWeatherForLocation($location);
        $io->writeln(sprintf('Location: %s', $location->getCity()));
        foreach($measurements as $measurement){
        $io->writeln(sprintf("%s: %s", $measurement->getDate()->format('Y-m-d'), $measurement-> getCelsius()) );
        }
        return Command::SUCCESS;
    }
}
