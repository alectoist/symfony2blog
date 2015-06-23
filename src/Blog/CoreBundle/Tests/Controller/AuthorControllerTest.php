<?php

namespace Blog\CoreBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 *Class AuthorControllerTest
 */
class AuthorControllerTest extends WebTestCase
{
	/**
	 * Tests the author show action
	 */
    public function testShow()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/show');
    }

}
