<?php
namespace Application\Sonata\MediaBundle\Provider;

use Sonata\MediaBundle\Provider\ImageProvider;

use Sonata\MediaBundle\Model\MediaInterface;
use Gaufrette\Adapter\Local;
use Sonata\MediaBundle\CDN\CDNInterface;
use Sonata\MediaBundle\Generator\GeneratorInterface;
use Sonata\MediaBundle\Thumbnail\ThumbnailInterface;
use Sonata\MediaBundle\Metadata\MetadataBuilderInterface;

use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Validator\ErrorElement;

use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Imagine\Image\Point;
use Imagine\Image\ImageInterface;

use Gaufrette\Filesystem;

class TabloProvider extends ImageProvider
{
    protected $container;

    public function setContainer(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * {@inheritdoc}
     */
    protected function doTransform(MediaInterface $media)
    {
        parent::doTransform($media);

        if ($media->getBinaryContent()) {
            $image = $this->imagineAdapter->open($media->getBinaryContent()->getPathname());
            $watermark_path = $this->container->get('kernel')->getRootDir().'/../..'.$this->container->get('templating.helper.assets')->getUrl('public/images/watermark.png');
            $watermark = $this->imagineAdapter->open($watermark_path);
            $image->paste($watermark, new Point(0, 0));
            $size  = $image->getSize();

            $media->setWidth($size->getWidth());
            $media->setHeight($size->getHeight());

            $media->setProviderStatus(MediaInterface::STATUS_OK);
        }
    }


    /**
     * {@inheritdoc}
     */
    public function postPersist(MediaInterface $media)
    {
    	if ($media->getBinaryContent() === null) {
    		return;
    	}
    
    	$this->setFileContents($media);
    
    	//$this->generateThumbnails($media);
    	
    	if (!$this->requireThumbnails()) {
    		return;
    	}
    	 
    	$referenceFile = $this->getReferenceFile($media);
    	 
    	foreach ($this->getFormats() as $format => $settings) {
    		if (substr($format, 0, strlen($media->getContext())) == $media->getContext() || $format === 'admin') {
    			
    			/*$this->getResizer()->resize(
    					$media,
    					$referenceFile,
    					$this->getFilesystem()->get($this->generatePrivateUrl($media, $format), true),
    					$this->getExtension($media),
    					$settings
    			);*/
    			
//resize resize(MediaInterface $media, File $in, File $out, $format, array $settings)
    			if (!isset($settings['width'])) {
    				throw new \RuntimeException(sprintf('Width parameter is missing in context "%s" for provider "%s"', $media->getContext(), $media->getProviderName()));
    			}
    			
    			$image = $this->imagineAdapter->load($referenceFile->getContent());
		
    			$box = $this->getResizer()->getBox($media, $settings);
    			if ($box->getHeight() > 500 || $box->getWidth() > 500){

    				// adding watermark
    				$watermark_path = $this->container->get('kernel')->getRootDir().'/../..'.$this->container->get('templating.helper.assets')->getUrl('public/images/watermark.png');
    				$watermark = $this->imagineAdapter->open($watermark_path);
    				$image->paste($watermark, new Point(50, 50));
    				 
    			}

    			$ext = $media->getExtension();
    			if (!is_string($ext) || strlen($ext) < 3) {
    				$ext = 'jpg';
    			}
    			
    			$content = $image
    			->thumbnail($box, ImageInterface::THUMBNAIL_INSET)
    			->get($ext, array('quality' => $settings['quality']));
    			
    			$out = $this->getFilesystem()->get($this->generatePrivateUrl($media, $format), true);
    			$out->setContent($content, $this->metadata->get($media, $out->getName()));
    			
    		}
    	}
    }

    /**
     * {@inheritdoc}
     */
    public function getHelperProperties(MediaInterface $media, $format, $options = array())
    {
        if ($format == 'reference') {
            $box = $media->getBox();
        } else {
            $resizerFormat = $this->getFormat($format);
            if ($resizerFormat === false) {
                throw new \RuntimeException(sprintf('The image format "%s" is not defined.
                        Is the format registered in your sonata-media configuration?', $format));
            }

            $box = $this->resizer->getBox($media, $resizerFormat);
        }

        return array_merge(array(
            //'alt'      => $media->getName(),
            //'title'    => $media->getName(),
            'src'      => $this->generatePublicUrl($media, $format),
            //'width'    => $box->getWidth(),
            //'height'   => $box->getHeight()
        ), $options);
    }

}