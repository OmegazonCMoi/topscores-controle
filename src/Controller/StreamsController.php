<?php

namespace App\Controller;

use App\Entity\Evaluations;
use App\Entity\Streams;
use App\Form\EvaluationsType;
use App\Repository\StreamsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/streams')]
class StreamsController extends AbstractController
{
    #[Route('/', name: 'app_streams_index', methods: ['GET'])]
    public function index(StreamsRepository $streamsRepository): Response
    {
        return $this->render('streams/index.html.twig', [
            'streams' => $streamsRepository->findBy(['user' => $this->getUser()]),
        ]);
    }

    #[Route('/new', name: 'app_streams_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $stream = new Streams();
        $form = $this->createForm(StreamsType::class, $stream);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $stream->setUser($this->getUser());
            $entityManager->persist($stream);
            $entityManager->flush();

            return $this->redirectToRoute('app_streams_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('streams/new.html.twig', [
            'stream' => $stream,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_streams_show', methods: ['GET'])]
    public function show(Streams $stream, Request $request, EntityManagerInterface $entityManager): Response
    {
        $evaluation = new Evaluations();
        $evaluation->setStreams($stream);

        $form = $this->createForm(EvaluationsType::class, $evaluation); // Fixed line

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($evaluation);
            $entityManager->flush();

            return $this->redirectToRoute('stream_show', ['id' => $stream->getId()]);
        }

        return $this->render('streams/show.html.twig', [
            'stream' => $stream,
            'form' => $form->createView(),
            'evaluations' => $stream->getEvaluations(),
        ]);
    }

    #[Route('/{id}/edit', name: 'app_streams_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Streams $stream, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(StreamsType::class, $stream);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_streams_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('streams/edit.html.twig', [
            'stream' => $stream,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_streams_delete', methods: ['POST'])]
    public function delete(Request $request, Streams $stream, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$stream->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($stream);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_streams_index', [], Response::HTTP_SEE_OTHER);
    }

}
