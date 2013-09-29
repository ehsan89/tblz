<?php

namespace Factory\BlogBundle\Controller;

use Factory\BlogBundle\Form\Type\BlogPostCommentType;

use Factory\BlogBundle\Entity\BlogPost;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class DefaultController extends Controller
{

	/**
	 * @Route("/blog", name="blog")
	 *
	 * @Template()
	 */
    public function blogAction()
    {
		$repository = $this->getDoctrine()->getRepository('FactoryBlogBundle:BlogPost');
    	$posts = $repository->getPosts(100);
        return array('posts' => $posts);
    }

	/**
	 * @Route("/blog/post/{id}", name="blog_post", requirements={"id" = "\d+"})
     * @ParamConverter("blog_post", class="FactoryBlogBundle:BlogPost")
	 * @Template()
	 */
    public function blogPostAction(BlogPost $blog_post)
    {
        return array('post' => $blog_post);
    }

    /**
     * @Template()
     */
    public function popularBlogPostsSidebarAction() {
		$repository = $this->getDoctrine()->getRepository('FactoryBlogBundle:BlogPost');
    	$popular_posts = $repository->getPopularPosts(5);
        return array('popular_posts' => $popular_posts);
    }
	
	/**
	 * @Template()
	 */
	public function blogPostCommentAction(BlogPost $blog_post) {
		$form = $this->createForm(new BlogPostCommentType());
		
		$comments = $blog_post->getComments();
		
		return array('comments' => $comments,
				'blog_post' => $blog_post,
				'form' => $form->createView());
	
	}

	/**
	 * @Route("/add_blog_post_comment/{id}", name="add_blog_post_comment", requirements={"id" = "\d+"})
     * @ParamConverter("blog_post", class="FactoryBlogBundle:BlogPost")
	 * @Template()
	 * 
	 * @param Request $request
	 */
	public function addBlogPostCommentAction(BlogPost $blog_post, Request $request) {
		$util = $this->container->get('util');
		if( !$util->isAuthenticated() ){
			throw new AccessDeniedException();
		}
		$em = $this->getDoctrine()->getManager();
		$user= $util->getCurrentUser();
		$form = $this->createForm(new BlogPostCommentType());
		
		if ($request->isMethod('POST')) {
			$form->bind($request);
		
			if ($form->isValid()) {
				// perform some action, such as saving the task to the database
				$comment = $form->getData();
				$comment->setBlogPost($blog_post);
				$comment->setUser($user);
				$em->persist($comment);
				
				$blog_post->setCommentCount($blog_post->getCommentCount() + 1);
				$em->persist($blog_post);
				
				$em->flush();
			}
			
			return $this->render(
					'FactoryBlogBundle:Default:blog_post_comment_view.html.twig',
					array('comment' => $comment)
			);
		}
	}
}
