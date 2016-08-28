<?php
namespace AppBundle\RestController;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Doctrine\DBAL\Schema\View;

class NoticeController extends FOSRestController {
	
	public function optionsNoticeAction() { }

	/**
	 * GET Route annotation.
	 * @return array
	 * @Rest\Get("/notice")
	 * @Rest\View(statusCode=200)
	 */
	public function getNoticeAction() {
		 $em = $this->getDoctrine()->getManager();

   		 $notices = $em->getRepository('AppBundle:Notice')->findAll();
   		 return array('notices' => $notices);
	}
	
	/**
	 * @return array
	 * @Rest\Get("/notice/{id}")
     * @Rest\View(statusCode=200)
	 */
	public function getNoticeByIdAction($id) {
		
		 $em = $this->getDoctrine()->getManager();
	     $notice = $em->getRepository('AppBundle:Notice')->find($id);
	 	 if($notice!=null)
	     	return array('notice' => $notice);
	}
	
	/**
	 * POST Route annotation.
	 * @Rest\Post("/notice")
	 * @Rest\View(statusCode=201)
	 * @return array
	 */
	public function postNoticeAction(Request $request) {

	}
	
	public function deleteNoticeAction(Request $request){
		
	}

	public function putNoticeAction(Request $request){
	
	}
	
}