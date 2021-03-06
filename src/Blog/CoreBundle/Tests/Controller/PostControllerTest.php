<?php

namespace Blog\CoreBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PostControllerTest extends WebTestCase
{
	/**
	 * Tests post index
	 */
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        $this->assertTrue($client->getResponse()->isSuccessful(), 'The response was not successful' );

        $this->assertCount(3, $crawler->filter('h2'), 'There should be 3 displayed posts');


    }

    /**
     * Tests single post
     */
    public function testShow()
    {
    	$client = static::createClient();

    	/** @var Post $post */
    	$post = $client->getContainer()->get('doctrine')->getManager()->getRepository('ModelBundle:Post')->findFirst();

    	$crawler = $client->request('GET', '/' . $post->getSlug() );

    	$this->assertTrue($client->getResponse()->isSuccessful(), 'The response was not successful');

    	$this->assertEquals($post->getTitle(), $crawler->filter('h1')->text(), 'Invalid post title');
        
        $this->assertGreaterThanOrEqual(1, $crawler->filter('article.comment')->count(), 'There should be at least one comment');
        
    }

    /**
     * Test comment creation
     */
    public function testSubmit()
    {
        $client = static::createClient();

        /** @var Post $post */
        $post = $client->getContainer()->get('doctrine')->getManager()->getRepository('ModelBundle:Post')->findFirst();

        $crawler = $client->request('GET', '/' . $post->getSlug() );

        $buttonCrawlerNode = $crawler->selectButton('Send');
        
        $form = $buttonCrawlerNode->form([
           'blog_modelbundle_comment[authorName]' => 'A cocky commenter',
            'blog_modelbundle_comment[body]' => 'A large comment'
        ]);
        
        $client->submit($form);
        
        $this->assertTrue(
                $client->getResponse()->isRedirect('/'.$post->getSlug()), 'There was no redirection after form submit'
                );
        
        $crawler = $client->followRedirect();
        
        $this->assertCount(
                1,
                $crawler->filter('html:contains("Your comment was submitted successfully")'),
                'There was no confirmation message'
                );
    }

}
