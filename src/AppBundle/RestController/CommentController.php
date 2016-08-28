<?php
namespace AppBundle\RestController;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use AppBundle\Entity\Comment;
use AppBundle\Form\Type\CommentType;
use FOS\RestBundle\View\View;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\Validator\Constraints\DateTime;


class CommentController extends FOSRestController {

	public function optionsCommentAction() { }


	/**
	 * POST Route annotation.
	 * @Rest\Post("notice/{id}/comment")
	 * @Rest\View(statusCode=201)
	 * @return array
	 */
	public function postCommentAction(Request $request, $id) {
		$em = $this->getDoctrine()->getManager();
		$notice = $em->getRepository('AppBundle:Notice')->find($id);
		$comment = new Comment();
		$comment->setNotice($notice);
		$comment->setCreated(new DateTime('now'));
	    $form = $this->createForm(CommentType::class, $comment);
		if($form->handleRequest($request) && $form->isValid()) {
		    
	        $em = $this->getDoctrine()->getManager();
	        $em->persist($comment);
	        $em->flush();
					
		}else{
			throw new Exception('Something went wrong!');
		}
	}

	public function deleteNoticeAction(Request $request){

	}

	public function putNoticeAction(Request $request){

	}

}