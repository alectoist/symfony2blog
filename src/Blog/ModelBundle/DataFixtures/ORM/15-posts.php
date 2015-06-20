<?php 

namespace Blog\ModelBundle\DataFixtures\ORM;

use Blog\ModelBundle\Entity\Post;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;


/**
* Fixtures for the posts
*/

class Posts extends AbstractFixture implements OrderedFixtureInterface
{
	/**
	 * {@inheritDoc}
	 */	
	public function getOrder()
	{
		return 15;
	}
	/**
	 * {@inheritDoc}
	 */	
	public function load(ObjectManager $manager)
	{
		$p1 = new Post();
		$p1->setTitle('Morbi non pharetra nisi.');
		$p1->setBody('vamus ex mauris, fermentum quis nunc at, aliquet vestibulum magna. Aenean facilisis neque orci, a blandit ex lobortis ut. Ut dignissim metus eget tellus gravida, quis posuere est vehicula. Vivamus porttitor, nunc at tincidunt maximus, elit dui tincidunt sem, ut tincidunt metus lorem eget libero. Vivamus cursus massa nec feugiat bibendum. Aenean maximus felis a molestie viverra. Aliquam accumsan ut lorem ac commodo. Pellentesque vitae lobortis justo, sed condimentum ipsum. In hac habitasse platea dictumst. In consequat in sem a scelerisque. Maecenas eleifend lorem eu enim blandit finibus.');
		$p1->setAuthor($this->getAuthor($manager, 'Barack'));

		$p2 = new Post();
		$p2->setTitle('Pellentesque vitae lectus eu odio faucibus posuere.');
		$p2->setBody('Nam sagittis nec sem sit amet porttitor. Pellentesque vitae lectus eu odio faucibus posuere. Phasellus eu turpis arcu. Aenean vitae purus nec orci molestie gravida non a velit. Nam convallis faucibus nunc quis bibendum. Donec finibus scelerisque ornare. Nulla porttitor purus id interdum condimentum. Duis pulvinar non nisi nec vulputate. In a sodales nulla, et mattis lacus. Curabitur non venenatis tortor, a auctor augue. Mauris eget enim porttitor, sodales turpis ut, placerat tellus. Sed id ultricies nibh. Morbi non odio massa.');
		$p2->setAuthor($this->getAuthor($manager, 'George'));

		$p3 = new Post();
		$p3->setTitle('Mauris vel pretium lacus.');
		$p3->setBody('Mauris vel pretium lacus. Sed tincidunt tellus sem, vitae convallis enim egestas at. Morbi dictum dui eu eros bibendum, eget accumsan lorem mattis. Sed nisl risus, efficitur vitae accumsan non, consequat et eros. Proin eget lacinia ante, in maximus nisl. Aliquam ac metus malesuada, tincidunt diam eget, lacinia nunc. In ullamcorper non ex at viverra. Praesent egestas fermentum eros. Praesent velit est, tincidunt eget porttitor sit amet, pellentesque at felis. In nisl lectus, tempus at mi ac, egestas placerat massa. Etiam vulputate leo quam, nec mattis lectus dictum sit amet. Sed dignissim elit eget rhoncus mattis. Praesent quis eros eget nunc ullamcorper sodales. In nibh risus, auctor eleifend eros at, facilisis tincidunt lectus. Aliquam quis leo ut dolor dignissim eleifend.');
		$p3->setAuthor($this->getAuthor($manager, 'Barack'));

		$manager->persist($p1);
		$manager->persist($p2);
		$manager->persist($p3);

		$manager->flush();
	}

	/**
	 * Get an author
	 * 
	 * @param ObjectManager $manager
	 * @param string 		$name
	 * 
	 * @return Author 
	 */

	private function getAuthor(ObjectManager $manager, $name)
	{
		return $manager->getRepository('ModelBundle:Author')->findOneBy(
			array(
				'name' => $name,

				));
	}
}