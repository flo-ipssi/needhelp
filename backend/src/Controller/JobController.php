<?php

namespace App\Controller;

use App\Entity\Job;
use App\Entity\Offer;
use App\Enum\StatusEnum;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;


#[Route('/api')]
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



    #[Route('/job/{id}/apply', name: 'app_job_apply')]
    /**
     * Create an offer made by a user 
     *
     * @param  mixed $request
     * @param  mixed $entityManager
     * @param  mixed $id
     * @return JsonResponse
     */
    public function applyJob(Request $request, EntityManagerInterface $entityManager, int $id): JsonResponse
    {
        $job = $entityManager->getRepository(Job::class)->find($id);

        if (!$job) {
            return $this->json(['message' => 'Job not found'], Response::HTTP_NOT_FOUND);
        }

        $user = $this->getUser();
        if (!$user) {
            return $this->json(['message' => 'Unauthorized'], Response::HTTP_UNAUTHORIZED);
        }

        $data = json_decode($request->getContent(), true);
        $proposedAmount = $data['price'] ?? null;

        if (!$proposedAmount) {
            return $this->json(['message' => 'Proposed price is required'], Response::HTTP_BAD_REQUEST);
        }

        $offer = new Offer();
        $offer->setJob($job);
        $offer->setStatus(StatusEnum::STATUS_APPROVED);
        $offer->setAmount(intval($proposedAmount));
        $offer->setUpdatedAt(new \DateTime());
        $entityManager->persist($offer);

        $job->setStatus(StatusEnum::STATUS_PENDING_CUSTOMER);
        $entityManager->persist($job);
        $entityManager->flush();

        return $this->json(['success' => true], Response::HTTP_OK);
    }
}
