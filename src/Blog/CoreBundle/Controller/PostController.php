<?php

namespace Blog\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
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
}
