<?php

namespace App\Repository;

use App\Entity\Document;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Document|null find($id, $lockMode = null, $lockVersion = null)
 * @method Document|null findOneBy(array $criteria, array $orderBy = null)
 * @method Document[]    findAll()
 * @method Document[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DocumentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Document::class);
    }



    public function searchDoc($mots,$cat,$souscat)
    {
        if(!empty($cat) || $cat !=''){
            if(!empty($souscat)){
                return $this->createQueryBuilder('d')
                ->Where('d.description LIKE :val ')
                //->andWhere(':cat MEMBER OF d.categories')
                ->andWhere('d.categorie = :cat ')
                ->setParameter('val', '%'.$mots.'%')
                ->setParameter('cat', $cat)
                ->getQuery()
                ->getResult();
            }else{

                return $this->createQueryBuilder('d')
            ->Where('d.description LIKE :val ')
            //->andWhere(':cat MEMBER OF d.categories')
            ->andWhere('d.categorie = :cat ')
            ->setParameter('val', '%'.$mots.'%')
            ->setParameter('cat', $cat)
            ->getQuery()
            ->getResult();
            }
            
            
        ;
    }else{
        return $this->createQueryBuilder('d')
        ->Where('d.description LIKE :val ')
        //->andWhere(':cat MEMBER OF d.categories')
        ->setParameter('val', '%'.$mots.'%')
        ->getQuery()
        ->getResult()
    ;
}
    }
    // /**
    //  * @return Document[] Returns an array of Document objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Document
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
