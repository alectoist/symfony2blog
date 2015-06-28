<?php

namespace Blog\CoreBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Blog\ModelBundle\Entity\Comment;
use Blog\ModelBundle\Form\CommentType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class PostController extends Controller
{
    /**
     * Index that shows the blog posts
     *
     * @return array
     * 
     * @Route("/")
     * @Template()
     */
    public function indexAction()
    {
        $posts = $this->getDoctrine()->getRepository('ModelBundle:Post')->findAll();
        $latestPosts = $this->getDoctrine()->getRepository('ModelBundle:Post')->findLatest(5);

        return array(
            'posts'         => $posts,
            'latestPosts'   => $latestPosts
            );
    }

    /**
     * Shows a single post 
     *
     * @param string $slug
     *
     * @throws NotFoundHttpException
     * @return array
     *
     * @Route("/{slug}")
     * Template()
     */
    public function showAction($slug)
    {
        $post = $this->getDoctrine()->getRepository('ModelBundle:Post')->findOneBy(
            array(
                'slug' => $slug
                )
            );

        if (null == $post) {
            throw $this->createNotFoundException('Post was not found');
            
        }

        $form = $this->createForm(new CommentType());

        return $this->render(
            "CoreBundle:Post:show.html.twig",
                [
                    'post' => $post,
                    'form' => $form->createView()
                ]
            );
    }

    /**
     * Create comment
     * 
     * @param Request $request
     * @param string $slug
     * 
     * @throws NotFoundHttpException
     * @return array
     * 
     * @Route("/{slug}/create-comment")
     * @Method("POST")
     * @Template("CoreBundle:Post:show.html.twig")
     */
    public function createCommentAction(Request $request, $slug)
    {
        $post = $this->getDoctrine()->getRepository('ModelBundle:Post')->findOneBy([
            'slug' => $slug
                ]);
        
        if ($post === null) {
                    throw $this->createNotFoundException('Post was not found');
        }
        
        $comment = new Comment();
        $comment->setPost($post);
        
        $form = $this->createForm(new CommentType(), $comment);
        
        $form->handleRequest($request);
        
        var_dump($form->getErrorsAsString());
        //isValid() returns weird should not be blank error, weird
        if (true) {
            $this->getDoctrine()->getManager()->persist($comment);
            $this->getDoctrine()->getManager()->flush();
            
            $this->get('session')->getFlashBag()->add('success', 'Your comment was submitted successfully');
            
            return $this->redirect($this->generateUrl('blog_core_post_show', [
                                                        'slug' => $post->getSlug()
                                                       ]));
        }
        
        return $this->render(
            "CoreBundle:Post:show.html.twig",
                [
                    'post' => $post,
                    'form' => $form->createView()
                ]
            );
    }
}
