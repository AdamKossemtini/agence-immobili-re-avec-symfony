<?php

namespace App\Repository;
use Doctrine\ORM\Query;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\Expr;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\QueryBuilder;
use App\Entity\Property;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\PropertySearch;
/**
 * @method Property|null find($id, $lockMode = null, $lockVersion = null)
 * @method Property|null findOneBy(array $criteria, array $orderBy = null)
 * @method Property[]    findAll()
 * @method Property[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PropertyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Property::class);
    }
    /**
	 * @return Query  
	 */

     //cette fonction pour la recherche et le filtrage des biens (recherche des biens dont le sole<solde max et surface>min surface )
    public function findAllVisibleQuery(PropertySearch $search): Query
    {
	$query= $this->createQueryBuilder('p')
			->Where('p.solde = false');
            
            if($search->getMaxPrice())
            {
                $query=$query
                ->andWhere('p.price <= :maxprice')
                ->setParameter('maxprice', $search->getMaxPrice());
            }
            if($search->getMinSurface())
            {
                $query=$query
                ->andWhere('p.surface >= :minsurface')
                ->setParameter('minsurface',$search->getMinSurface());
            }
            if($search->getOptions()->count() >0)
            { foreach($search->getOptions() as $k =>$option)
                {dump($k);
                $query=$query
                ->andWhere(":option$k MEMBER OF p.options")
                ->setParameter("option$k",$option);
            }
        }
            return $query->getQuery();
    }
    

    /**
	 * @return Property[] Returns an array of Property objects
	 */
	public function findLatest(): array{
		return $this->createQueryBuilder('p')
			->Where('p.solde = false')
			->setMaxResults(4)
			->getQuery()
			->getResult()
		;
	}

    // /**
    //  * @return Property[] Returns an array of Property objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Property
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
