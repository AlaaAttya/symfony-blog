<?php

namespace BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use BlogBundle\Entity\Comment;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;

/**
 * @author  Alaa Attya <alaa.attya91@gmail.com>
 */
class DefaultController extends Controller
{
    /**
     * @Route("/", name="blog_index")
     */
    public function indexAction()
    {
    	$em = $this->getDoctrine()->getManager();
        

        $published_posts = $em->getRepository('BlogBundle:Post')->get_published_articles();
        return $this->render('BlogBundle:Default:index.html.twig', array(
        	'posts' => $published_posts
        ));
    }

    /**
     * Save new comment
     * 
     * @Route("/comment-save/{post_id}", name="save_comment")
     * @Method("POST")
     */
    public function postCommentAction(Request $request, $post_id) {

        $em = $this->getDoctrine()->getManager();

        $post = $em->getRepository('BlogBundle:Post')->find($post_id);

        $comment = new Comment();

        $comment_form = $this->createForm('BlogBundle\Form\CommentType', $comment);
        $comment_form->handleRequest($request);

        if ($comment_form->isSubmitted() && $comment_form->isValid()) {
            $comment->setPost($post);
            $em->persist($comment);
            $em->flush();
        } else {
           var_dump("expression");die;
        }
        return $this->redirectToRoute('post_view', array('post_id' => $post_id));
    }

    /**
     * @Route("/admin")
     */
    public function adminIndexAction() {
        return $this->render('BlogBundle:Default:admin_index.html.twig');
    }

    /**
     * @Route("/post-view/{post_id}" ,name="post_view")
     */
    public function postViewAction($post_id) {
        $em = $this->getDoctrine()->getManager();

        $post = $em->getRepository('BlogBundle:Post')->find($post_id);

        $post_comment = new Comment();
        $comment_form = $this->createForm('BlogBundle\Form\CommentType', $post_comment);

        return $this->render('BlogBundle:Default:post_view.html.twig', array(
            'post' => $post,
            'comment_form' => $comment_form->createView()
        ));
    }
}
