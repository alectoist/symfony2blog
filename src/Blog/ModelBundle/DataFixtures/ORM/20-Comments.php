<?php

namespace Blog\ModelBundle\DataFixtures\ORM;

use Blog\ModelBundle\Entity\Comment;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Loads comments fixtures
 */
class Comments extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function getOrder() 
    {        
        return 20;
    }
    
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $posts = $manager->getRepository('ModelBundle:Post')->findAll();
        
        $comments = [
          0 => 'Suspendisse quis nulla ut lectus fringilla porta in eget sapien. Cras imperdiet sodales consectetur. Sed suscipit efficitur velit eu ultricies. Vestibulum sit amet purus iaculis, dignissim eros vel, fringilla nisi. Maecenas sed dui in enim consectetur consectetur at ac dolor. Sed ac massa leo. Morbi dignissim eleifend orci, at iaculis diam gravida vitae. Proin sed turpis quam. Aliquam commodo quis leo ut pretium. Quisque ornare arcu id dolor imperdiet, ac pharetra diam suscipit. Ut nec consectetur felis. Proin tempor convallis nisi nec iaculis. Morbi tristique sapien metus, ornare ullamcorper orci tempor ut. Morbi faucibus, diam in interdum sagittis, ante sapien varius ipsum, molestie cursus dolor enim id sem. Donec bibendum mauris at neque malesuada, non ornare mauris placerat. ',  
          1 => 'Vestibulum augue ipsum, ultricies ut turpis ut, facilisis vulputate sem. Maecenas vitae est ultricies, porta metus nec, auctor nisl. Proin non dui at mi ultricies congue. Duis malesuada tincidunt vulputate. Duis ultrices nulla velit, at tristique eros pharetra et. Aliquam at sapien in tortor sodales vehicula. Vestibulum ut erat orci. Pellentesque nunc dui, posuere sit amet massa sed, eleifend pulvinar ligula. Suspendisse id odio purus. Sed placerat lacus mattis turpis sodales mattis. Duis at massa pretium, blandit purus in, euismod quam. Sed quis rhoncus ante. Integer non suscipit purus. ',  
          2 => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis gravida consectetur ipsum vel rutrum. Duis non consectetur purus. Maecenas elementum volutpat leo et venenatis. Sed consectetur augue vitae metus vestibulum fringilla. Integer faucibus tellus sit amet erat posuere tincidunt. Cras faucibus a augue ac dapibus. Maecenas ut dolor sit amet augue sagittis sagittis ac sed nisi. Morbi in felis sit amet nibh pharetra vehicula. Donec in cursus augue. '
          ];
        
        $i = 0;
        
        foreach ($posts as $post)
        {
            $comment = new Comment();
            $comment->setAuthorName('Millard');
            $comment->setBody($comments[$i++]);
            $comment->setPost($post);
            
            $manager->persist($comment);            
        }
        
        $manager->flush();
    }
}