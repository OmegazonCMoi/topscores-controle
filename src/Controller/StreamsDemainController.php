<?php

namespace App\Controller;

use App\Repository\StreamsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class StreamsDemainController extends AbstractController
{
    #[Route('/streams-demain', name: 'app_streams-demain')]
    public function index(StreamsRepository $streamRepository): Response
    {
        $streams = $streamRepository->findStreamsForTomorrow();

        return $this->render('streams_demain/index.html.twig', [
            'controller_name' => 'StreamsDemainController',
            'streams' => $streams,
        ]);
    }
}
