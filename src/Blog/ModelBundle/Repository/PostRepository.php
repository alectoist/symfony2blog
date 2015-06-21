<?php

namespace Blog\ModelBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Class PostRepository
 */
class PostRepository extends EntityRepository
{
	/**
	* Find latest posts method
	*
	* @param int $num How many posts to get
	*
	* @return array
	*/
	public function findLatest($num)
	{
		$qb = $this->getQueryBuilder()
				   ->orderBy('p.createdAt', 'desc')
				   ->setMaxResults($num);

		return $qb->getQuery()->getResult();
	}

	private function getQueryBuilder()
	{
		$en = $this->getEntityManager();

		$qb = $en->getRepository('ModelBundle:Post')
				 ->createQueryBuilder('p');

		return $qb;	
	}
}