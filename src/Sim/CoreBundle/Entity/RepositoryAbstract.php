<?php

/**
 * RepositoryAbstract
 *
 * @author Anton Vanco <anton.vanco@visualdna.com>
 */

namespace Sim\CoreBundle\Entity;

use Doctrine\ORM\EntityRepository;

abstract class RepositoryAbstract extends EntityRepository
{
    /**
     * @var string
     */
    protected $entityAlias;
    
    /**
     * @return string
     */
    protected function getEntityAlias()
    {
        if ($this->entityAlias === NULL)
        {
            $entityName = $this->getEntityName();
            $entityAlias = preg_replace('/[^A-Z0-9]/', '', $entityName);
            $entityAlias = strtolower($entityAlias);
            $this->entityAlias = $entityAlias;
        }
        return $this->entityAlias;
    }
    
    /**
     * @return \Doctrine\ORM\QueryBuilder
     */
    protected function getBaseSelectQueryBuilder()
    {
        $entityName = $this->getEntityName();
        $entityAlias = $this->getEntityAlias();
        $queryBuilder = $this->getEntityManager()->createQueryBuilder();
        
        $queryBuilder
            ->select($entityAlias)
            ->from($entityName, $entityAlias);
        
        return $queryBuilder;
    }

    /**
     * @return \Doctrine\ORM\QueryBuilder
     */
    protected function getPaginatedQueryBuilder($page, $limit)
    {
        $entityName = $this->getEntityName();
        $entityAlias = $this->getEntityAlias();
        $queryBuilder = $this->getEntityManager()->createQueryBuilder();

        $queryBuilder
            ->select($entityAlias)
            ->from($entityName, $entityAlias)
            ->setFirstResult($page * $limit)
            ->setMaxResults($limit);

        return $queryBuilder;
    }
    
    /**
     * @param \Doctrine\ORM\QueryBuilder $queryBuilder
     * 
     * @throws NoResultEntityException
     * @throws NonUniqueEntityException
     * 
     * @return \Doctrine\Common\Collections\ArrayCollection of Entity
     */
    protected function executeQueryBuilder($queryBuilder)
    {
        $query = $queryBuilder->getQuery();
        try
        {
            $result = $query->getResult();
            return $result;
        }
        catch (Doctrine\ORM\NoResultException $e)
        {
            throw new NoResultEntityException($e);
        }
        catch (\Doctrine\ORM\NonUniqueResultException $e)
        {
            throw new NonUniqueEntityException($e);
        }
    }
    
    /**
     * @param \Doctrine\ORM\QueryBuilder $queryBuilder
     * 
     * @throws NoResultEntityException
     * @throws NonUniqueEntityException
     * 
     * @return Entity
     */
    protected function executeQueryBuilderForOne($queryBuilder)
    {
        $query = $queryBuilder->getQuery();
        try
        {
            $result = $query->getSingleResult();
            return $result;
        }
        catch (\Doctrine\ORM\NoResultException $e)
        {
            throw new NoResultEntityException($e);
        }
        catch (\Doctrine\ORM\NonUniqueResultException $e)
        {
            throw new NonUniqueEntityException($e);
        }
    }
    
    public function getAll()
    {
        return $this->executeQueryBuilder(
            $this->getBaseSelectQueryBuilder()
        );
    }

    public function getPaginated($page, $limit)
    {
        return $this->executeQueryBuilder(
            $this->getPaginatedQueryBuilder($page, $limit)
        );
    }
    
}

class EntityException extends \Exception {}

class NoResultEntityException extends EntityException {}

class NonUniqueEntityException extends EntityException {}

?>
