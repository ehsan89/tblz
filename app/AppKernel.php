<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Symfony\Bundle\AsseticBundle\AsseticBundle(),
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
        	
        	new Doctrine\Bundle\FixturesBundle\DoctrineFixturesBundle(),
        	new FOS\UserBundle\FOSUserBundle(),
        	new Stof\DoctrineExtensionsBundle\StofDoctrineExtensionsBundle(),
        	new PunkAve\FileUploaderBundle\PunkAveFileUploaderBundle(),
	        new Sonata\BlockBundle\SonataBlockBundle(),
	        new Sonata\CacheBundle\SonataCacheBundle(),
	        new Sonata\jQueryBundle\SonatajQueryBundle(),
	        new Sonata\AdminBundle\SonataAdminBundle(),
            new Knp\Bundle\MenuBundle\KnpMenuBundle(),
            new Sonata\DoctrineORMAdminBundle\SonataDoctrineORMAdminBundle(),
        	new Sonata\MediaBundle\SonataMediaBundle(),
            new Sonata\EasyExtendsBundle\SonataEasyExtendsBundle(),
        	new Maxmind\Bundle\GeoipBundle\MaxmindGeoipBundle(),
		    new Sonata\MarkItUpBundle\SonataMarkItUpBundle(),
		    new Knp\Bundle\MarkdownBundle\KnpMarkdownBundle(),
		    new Ivory\CKEditorBundle\IvoryCKEditorBundle(),
		    new Sonata\FormatterBundle\SonataFormatterBundle(),
        	new Sonata\UserBundle\SonataUserBundle('FOSUserBundle'),
		    new JMS\AopBundle\JMSAopBundle(),
		    new JMS\SecurityExtraBundle\JMSSecurityExtraBundle(),
		    new JMS\DiExtraBundle\JMSDiExtraBundle($this),

        	new Factory\UtilityBundle\FactoryUtilityBundle(),
            new Tabloz\UserBundle\TablozUserBundle(),
            new Tabloz\MainBundle\TablozMainBundle(),
        	new Application\Sonata\MediaBundle\ApplicationSonataMediaBundle(),
            new Factory\BlogBundle\FactoryBlogBundle(),
        );

        if (in_array($this->getEnvironment(), array('dev', 'test'))) {
            //$bundles[] = new Acme\DemoBundle\AcmeDemoBundle();
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
        }

        return $bundles;
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__.'/config/config_'.$this->getEnvironment().'.yml');
    }
}
