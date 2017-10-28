<?php
namespace AALP\BookingBundle\Repository;
use Doctrine\ORM\EntityRepository;
class ImageRepository extends EntityRepository
{
  public function getImageWithAccommodation($limit)
  {
    $qb = $this->createQueryBuilder('a');
    // On fait une jointure avec l'entité Advert avec pour alias « adv »
    $qb
      ->innerJoin('a.accommodation', 'acc')
      ->addSelect('acc')
    ;
    // Puis on ne retourne que $limit résultats
    $qb->setMaxResults($limit);
    // Enfin, on retourne le résultat
    return $qb
      ->getQuery()
      ->getResult()
    ;
  }
}