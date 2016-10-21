<?php

namespace AppBundle\Listener;

use AppBundle\Entity\BlogPost;
use AppBundle\Entity\Project;
use Doctrine\ORM\EntityManager;
use Presta\SitemapBundle\Service\SitemapListenerInterface;
use Presta\SitemapBundle\Event\SitemapPopulateEvent;
use Presta\SitemapBundle\Sitemap\Url\UrlConcrete;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Routing\RouterInterface;

/**
 * Class SitemapListener
 *
 * @category Listener
 * @package  AppBundle\Listener
 * @author   David Romaní <david@flux.cat>
 */
class SitemapListener implements SitemapListenerInterface
{
    /**
     * @var RouterInterface
     */
    private $router;

    /**
     * @var EntityManager
     */
    private $em;

    /**
     * @var array
     */
    private $projects;

    /**
     * @var array
     */
    private $posts;

    /**
     * SitemapListener constructor
     *
     * @param RouterInterface $router
     * @param EntityManager $em
     */
    public function __construct(RouterInterface $router, EntityManager $em)
    {
        $this->router = $router;
        $this->em = $em;
        $this->projects = $this->em->getRepository('AppBundle:Project')->findAllEnabledSortedByPosition();
        $this->posts = $this->em->getRepository('AppBundle:BlogPost')->getAllEnabledSortedByPublishedDateWithJoin();
    }

    /**
     * @param SitemapPopulateEvent $event
     */
    public function populateSitemap(SitemapPopulateEvent $event)
    {
        $section = $event->getSection();
        if (is_null($section) || $section == 'default') {
            // Homepage
            $url = $this->makeUrl('front_homepage');
            $event
                ->getUrlContainer()
                ->addUrl($this->makeUrlConcrete($url), 'default');
            // Projects detail view list
            $lastUpdatedAtDate = \DateTime::createFromFormat('d-m-Y', '01-01-2000');
            /** @var Project $project */
            foreach ($this->projects as $project) {
                $url = $this->router->generate(
                    'front_project_detail',
                    array('slug' => $project->getSlug(),
                    ),
                    UrlGeneratorInterface::ABSOLUTE_URL
                );
                $event
                    ->getUrlContainer()
                    ->addUrl($this->makeUrlConcrete($url, 0.8, $project->getUpdatedAt()), 'default');
                if ($project->getUpdatedAt() > $lastUpdatedAtDate) {
                    $lastUpdatedAtDate = $project->getUpdatedAt();
                }
            }
            // Project main view
            $url = $this->makeUrl('front_projects');
            $event
                ->getUrlContainer()
                ->addUrl($this->makeUrlConcrete($url, 1, $lastUpdatedAtDate), 'default');
            // Posts detail view list
            $lastUpdatedAtDate = \DateTime::createFromFormat('d-m-Y', '01-01-2000');
            /** @var BlogPost $post */
            foreach ($this->posts as $post) {
                $url = $this->router->generate(
                    'front_blog_posts_detail',
                    array(
                        'year' => $post->getPublishedAt()->format('Y'),
                        'month' => $post->getPublishedAt()->format('m'),
                        'day' => $post->getPublishedAt()->format('d'),
                        'slug' => $post->getSlug(),
                    ),
                    UrlGeneratorInterface::ABSOLUTE_URL
                );
                $event
                    ->getUrlContainer()
                    ->addUrl($this->makeUrlConcrete($url, 0.8, $post->getUpdatedAt()), 'default');
                if ($post->getUpdatedAt() > $lastUpdatedAtDate) {
                    $lastUpdatedAtDate = $post->getUpdatedAt();
                }
            }
            // Blog main view
            $url = $this->makeUrl('front_blog_posts_list');
            $event
                ->getUrlContainer()
                ->addUrl($this->makeUrlConcrete($url, 1, $lastUpdatedAtDate), 'default');
        }
    }

    /**
     * @param string $routeName
     *
     * @return string
     */
    private function makeUrl($routeName)
    {
        return $this->router->generate(
            $routeName, array(), UrlGeneratorInterface::ABSOLUTE_URL
        );
    }

    /**
     * @param string         $url
     * @param int            $priority
     * @param \DateTime|null $date
     *
     * @return UrlConcrete
     */
    private function makeUrlConcrete($url, $priority = 1, $date = null)
    {
        return new UrlConcrete(
            $url,
            $date === null ? new \DateTime() : $date,
            UrlConcrete::CHANGEFREQ_WEEKLY,
            $priority
        );
    }
}
