<?php

namespace Acme\NewsBundle\Controller;

use Acme\NewsBundle\Entity\db_news;
use Acme\NewsBundle\Form\db_newsType;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\DateTime;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\DependencyInjection\ContainerInterface;

class DefaultController extends Controller
{
    /**
     * @Route ("/", name="index")
     */
    public function indexAction(Request $request)
    {
        $em    = $this->get('doctrine.orm.entity_manager');
        $dql   = "SELECT a FROM AcmeNewsBundle:db_news a";
        $query = $em->createQuery($dql);

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            5/*limit per page*/
        );

        return $this->render('AcmeNewsBundle:Default:index.html.twig', array('pagination' => $pagination));
    }

    /**
     * @Route ("/create", name="create")
     *
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function createAction(Request $request)
    {
        $entry = new db_news();
        $entry->setDatePublic(new \DateTime('tomorrow'));

        $form = $this->createForm(db_newsType::class ,$entry);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entry);
            $em->flush();

            return $this->redirectToRoute('index');
        }

        return $this->render('AcmeNewsBundle:form:create.html.twig', array(
            'outform' => $form->createView(),
        ));
    }

    /**
     * @Route ("/news/{id}", name="view")
     */
    public function viewAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $id = $request->get('id');
        $entryAll = $em->getRepository(db_news::class)->findAll();
        $entry = $em->getRepository(db_news::class)->find($id);

/*
        $sql = "SELECT * FROM `db_news` ORDER BY RAND() LIMIT 1";
        $em = $this->getDoctrine()->getEntityManager();
        $result = $em->createQuery($sql)->getResult();
*/
        $arrayId = array();
        foreach ($entryAll as $el => $value)
        {
            array_push($arrayId, $value);
        }

        $addNews = array();
        while (count($addNews)!=4) {
            $randId = array_rand($arrayId);
            if ($randId != $id) {
                $news = $em->getRepository(db_news::class)->find($randId);
                if (in_array($news, $addNews) == false) {array_push($addNews, $news);}
            }
        }

        return $this->render('AcmeNewsBundle:Default:view.html.twig', array('entry' => $entry, 'addNews'=> $addNews ));
    }

}
