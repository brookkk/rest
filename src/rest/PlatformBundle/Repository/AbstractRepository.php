<?php

namespace rest\PlatformBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use PagerFanta\Adapater\DoctrineORMAdapter;
use PagerFanta\Pagerfanta;

abstract class AbstractRepository extends EntityRepository
{


	protected function paginate(QueryBuilder $qb, $limit = 20, $offset = 0)
    {
        if (0 == $limit && 0 == $offset) {
            throw new \LogicException('$limit & $offstet must be greater than 0.');
        }
        
        $adapter = new DoctrineORMAdapter($qb);
        $pager = new Pagerfanta($adapter);


        $pager->setCurrentPage(ceil($offset + 1) / $limit);
        $pager->setMaxPerPage((int) $limit);
        
        return $pager;
    }


}
