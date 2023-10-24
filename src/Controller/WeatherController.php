<?php

namespace App\Controller;

use App\Entity\Location;
use App\Repository\ForecastRepository;
use App\Repository\LocationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WeatherController extends AbstractController
{
    #[Route('/weather/{city}/{country?}', name: 'app_weather')]
    public function city(string $city, ?string $country = null, LocationRepository $locationRepository, ForecastRepository $forecastRepository): Response
    {
        $location = $locationRepository->findByCityAndCountry($city, $country);

        if (!$location) {
            throw $this->createNotFoundException('Location not found');
        }

        $measurements = $forecastRepository->findByLocation($location);

        return $this->render('weather/city.html.twig', [
            'location' => $location,
            'measurements' => $measurements,
        ]);
    }
}