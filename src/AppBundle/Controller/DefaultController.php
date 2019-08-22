<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="portada")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $oferta = $em->getRepository('AppBundle\Entity\Oferta')->findOneBy([
            'ciudad' => 202,
            //'fechaPublicacion' => new \DateTime('today'),
        ]);

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
