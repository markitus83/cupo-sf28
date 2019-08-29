<?php

namespace AppBundle\Repository;


use Doctrine\ORM\EntityRepository;

class OfertaRepository extends EntityRepository
{
    public function findOfertaDelDia($ciudad)
    {
        $fechaPublicacion = new \DateTime('today');
        $fechaPublicacion->setTime(23, 59, 59);

        $em = $this->getEntityManager();

        $dql = 'SELECT o, c, t
                FROM AppBundle:Oferta o
                JOIN o.ciudad c JOIN o.tienda t
                WHERE o.revisada = true
                AND o.fechaPublicacion < :fecha
                AND c.slug = :ciudad
                ORDER BY o.fechaPublicacion DESC';

        $query = $em->createQuery($dql);
        $query->setParameter('fecha', $fechaPublicacion);
        $query->setParameter('ciudad', $ciudad);
        $query->setMaxResults(1);

        return $query->getSingleResult();
    }
}
