<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    /**
     * @Route(
     *     "/{ciudad}",
     *     defaults={ "ciudad" = "%app.ciudad_por_defecto%" },
     *     name="portada"
     * )
     * @Route("/")
     */
    public function portadaAction($ciudad)
    {
        if (null === $ciudad) {
            return $this->redireredirectToRoute(
                'portada',
                ['ciudad' => $this->getParameter('app.ciudad_por_defecto')]
            );
        }

        $em = $this->getDoctrine()->getManager();

        $oferta = $em->getRepository('AppBundle\Entity\Oferta')->findOneBy([
            'ciudad' => $this->getParameter('app.ciudad_por_defecto'),
            'fechaPublicacion' => new \DateTime('today'),
        ]);

        if (!$oferta) {
            throw $this->createNotFoundException('No se ha encontrado la oferta del día en la ciudad seleccionada');
        }

        return $this->render('portada.html.twig', ['oferta' => $oferta]);
    }

    /**
     * @Route("/sitio/{nombrePagina}/", name="pagina")
     */
    public function paginaAction($nombrePagina = 'ayuda')
    {
        return $this->render('sitio/'.$nombrePagina.'.html.twig');
    }
}
