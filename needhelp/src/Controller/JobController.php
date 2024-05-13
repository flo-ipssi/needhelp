<?php

namespace App\Controller;

use App\Entity\Job;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class JobController extends AbstractController
{
    #[Route('/jobs', name: 'app_job')]    
    /**
     * Return the list of jobs
     *
     * @param  mixed $entityManagerInterface
     * @param  mixed $serializer
     * @return JsonResponse
     */
    public function index(EntityManagerInterface $entityManagerInterface, SerializerInterface $serializer): JsonResponse
    {
        $listJob = $entityManagerInterface->getRepository(Job::class)->findAll();
        $data = $serializer->serialize($listJob, 'json', ['groups' => 'list_job']);
        
        return new JsonResponse($data, 200, [], true);
    }
}
