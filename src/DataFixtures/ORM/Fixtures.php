<?php
/**
 * Created by PhpStorm.
 * User: fernando
 * Date: 01/07/2018
 * Time: 08.55
 */

namespace App\DataFixtures\ORM;


use App\Entity\Author;
use App\Entity\BlogPost;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class Fixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $author = new Author();
        $author
            ->setName('Joe Blogs')
            ->setTitle('Developer')
            ->setUsername('joeblogs')
            ->setCompany('The Writing Company')
            ->setShortBio('Try fluffing kebab covered with bagel lassi, blended with woodruff.')
            ->setPhone('070000000')
            ->setFacebook('joeblogs')
            ->setTwitter('joe.blogs')
            ->setGithub('joeblogs');

        $manager->persist($author);

        $blogPost = new BlogPost();
        $blogPost
            ->setTitle('Not shangri-la or upstairs, forget the beauty.')
            ->setSlug('first-post')
            ->setDescription('Remember: sliceed blood oranges taste best when simmered in a sauté pan blended with black pepper.')
            ->setBody('Reproduce, scotty, reliable attitude! The collective is bravely ancient.')
            ->setAuthor($author);
        $manager->persist($blogPost);
        $manager->flush();
    }
}