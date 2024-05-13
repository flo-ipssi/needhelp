<?php

namespace App\Repository;

use App\Entity\Job;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * @extends ServiceEntityRepository<Job>
 */
class JobRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Job::class);
    }

    public function findAllFormatJSON()
    {
        $jobs = $this->createQueryBuilder('j')
            ->orderBy('j.createdAt', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult();


        $jobsArray = [];
        foreach ($jobs as $job) {
            $jobsArray[] = [
                'id' => $job->getId(),
                'title' => $job->getTitle(),
                'description' => $job->getDescription()
            ];
        }

        $response = new JsonResponse($jobsArray);

        return $response;
    }

    //    public function findOneBySomeField($value): ?Job
    //    {
    //        return $this->createQueryBuilder('j')
    //            ->andWhere('j.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
