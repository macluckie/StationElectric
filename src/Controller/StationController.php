<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Action\StationAction;
use App\Action\BasicAuth\BasicAuth;
use App\Action\StationRepo;
use Symfony\Component\HttpFoundation\RequestStack;
use App\Domain\Station\StationsProvider;
use App\Domain\BasicAuth\Authorization;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use App\Service\SerializerInterface;



class StationController extends AbstractController
{
    private RequestStack $request;
    private  HttpClientInterface $client;
    private SerializerInterface $serializer;

    public function __construct(RequestStack $request, HttpClientInterface $client, SerializerInterface $serializer)
    {
        $this->request = $request;     
        $this->client = $client;
        $this->serializer = $serializer;
    }

    #[Route('/station', name: 'app_station')]
    public function index(): Response
    {
        if($this->getUser() == null){
           return  $this->redirectToRoute('app_login');
        }
       return $this->render('station/index.html.twig', []);
    }

    #[Route('/stations', name: 'app_stations', methods: ['GET'])]
    public function stations(): Response
    {   
        $basic = new BasicAuth($this->request);
        $auth = new Authorization($basic);
        if(!$auth->checkAuthorization()) {
            return $this->json('user not allowed', 401);
        }
        $rp = new StationRepo($this->client,$this->serializer);
        $stationAction = new StationAction($rp);
        $serviceDomain = new StationsProvider($stationAction, $this->request);
        return $this->json(['stations' => $serviceDomain->getStations()], 200);
    }
}
