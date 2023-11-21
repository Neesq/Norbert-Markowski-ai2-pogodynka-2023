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
    name: 'weather:city',
    description: 'Add a short description for your command',
)]
class WeatherCityCommand extends Command
{
    public function __construct(private  LocationRepository $locationRepository,
    private  WeatherUtil $weatherUtil,)
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('cityName', InputArgument::OPTIONAL, 'City name')
            ->addArgument('countryCode', InputArgument::OPTIONAL, 'Country code')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $countryCode = $input->getArgument('countryCode');
        $city = $input->getArgument('cityName');

        $location = $this->locationRepository->findOneBy([
            'country'=> $countryCode,
            'city'=> $city,
        ]);

        $measurements = $this->weatherUtil->getWeatherForLocation($location);
        $io->writeln(sprintf('Location %s', $location->getCity()));
        foreach($measurements as $measurement){
            $io->writeln(sprintf("%s: %s", $measurement->getDate()->format('Y-m-d'), $measurement-> getCelsius()) );
        }


        return Command::SUCCESS;
    }
}
