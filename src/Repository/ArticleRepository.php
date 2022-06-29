<?php

namespace App\Repository;

use App\Entity\Article;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Article>
 *
 * @method Article|null find($id, $lockMode = null, $lockVersion = null)
 * @method Article|null findOneBy(array $criteria, array $orderBy = null)
 * @method Article[]    findAll()
 * @method Article[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Article::class);
    }

    public function add(Article $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Article $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * @return Article[] Returns an array of Article objects
     */
    public function findLatestPublished(): array
    {
        $qb = $this->createQueryBuilder('a');
        $qb = $this->published($qb);
        $qb = $this->latest($qb);

        return $qb
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * @return Article[] Returns an array of Article objects
     */
    public function findLatest(): array
    {
        return $this->latest()
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * @return Article[] Returns an array of Article objects
     */
    public function findPublished(): array
    {
        return $this->published()
            ->getQuery()
            ->getResult()
        ;
    }

    private function published(QueryBuilder $builder = null)
    {
        return $this->getOrCreateQueryBuilder($builder)
            ->andWhere('a.publishedAt IS NOT NULL');
    }

    private function latest(QueryBuilder $builder = null)
    {
        return $this->getOrCreateQueryBuilder($builder)
            ->orderBy('a.publishedAt', 'DESC');
    }

    private function getOrCreateQueryBuilder(?QueryBuilder $builder): QueryBuilder
    {
        return $builder ?? $this->createQueryBuilder('a');
    }

//    public function findOneBySomeField($value): ?Article
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
