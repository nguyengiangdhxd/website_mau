<?php
namespace CMSBackend\Controller;
use CMSBackend\Library\CMSBackendAuth;
use Flywheel\Base;
use Flywheel\Config\ConfigHandler;
use Flywheel\Controller\Web;
use Flywheel\Factory;
use Flywheel\Translation\Translator;
use Guzzle\Plugin\Cookie\Cookie;
use Symfony\Component\Translation\Loader\YamlFileLoader;
use Toxotes\Content;
use Toxotes\Plugin;

abstract class CMSBackendBase extends Web
{
    protected $_need_login = true;

    /** @var \Languages */
    public $currentLang;

    public function beforeExecute()
    {
        parent::beforeExecute(); // TODO: Change the autogenerated stub
        $this->_registerDefaultTaxonomies();
        $this->loadPlugin();

        if ($this->_need_login) {
            /** @var CMSBackendAuth $auth */
            $auth = CMSBackendAuth::getInstance();
            if (!$auth->isCMSBackendAuthenticated()) {
                if ($this->request()->isXmlHttpRequest()) {
                    Base::end(json_encode(array(
                        'error' => 'AUTHENTICATE FAIL',
                        'error_code' => 'E0001',
                        'message' => t('This session was expired, plz login and comeback!')
                    )));
                } else {
                    //redirect
                    $this->redirect($this->createUrl('login', array(
                        'r' => urlencode($this->request()->getUri())
                    )));
                }
            }
        }

        $this->document()->addJsVar('login_url', $this->createUrl('login'));
        $this->document()->addJsVar('media_upload_url', $this->createUrl('media/upload'));

        $this->_initTemplate();
        $this->_loadLanguage();
    }

    private function _initTemplate()
    {
        $template = ConfigHandler::get('template');
        include_once $this->getTemplatePath().DIRECTORY_SEPARATOR.'template_init.php';

        //init js
        $this->document()->addJs('js/process/common.js');
    }

    /**
     * load languages
     */
    private function _loadLanguage()
    {
        $i18nCfg = ConfigHandler::get('i18n');
        if (!$i18nCfg['enable']) {
            return null;
        }

        $current_lang_code = $this->get('lang');
        if (!$current_lang_code) {
            $current_lang_code = Factory::getCookie()->read('language');
        }

        if(!$current_lang_code) {
            $this->currentLang = \Languages::retrieveByDefault(1);
            $current_lang_code = $this->currentLang->getLangCode();
        } else {
            $this->currentLang = \Languages::retrieveByLangCode($current_lang_code);
        }

        if ($current_lang_code) {
            Factory::getCookie()->write('language', $current_lang_code);
        }

        //load message
        $translator = Translator::getInstance();
        $translator->setLocale($current_lang_code);
        if ($translator) {
            $translator->addLoader('yml', new YamlFileLoader());

            if (isset($i18nCfg['resource']) && is_array($i18nCfg['resource'])) {
                foreach($i18nCfg['resource'] as $locale => $files) {
                    for ($i = 0, $size = sizeof($files); $i < $size; ++$i) {
                        $fileInfo = new \SplFileInfo($files[$i]);
                        $filename = $fileInfo->getFilename();
                        $ext = $fileInfo->getExtension();
                        if ($ext == 'yml') {
                            $domain = str_replace('.' .$fileInfo->getExtension(), '', $fileInfo->getFilename());
                            $translator->addResource('yml', $files[$i], $locale, $domain);
                        }
                    }
                }
            }
        }
    }

    /**
     * get current login user
     * return \Users
     */
    public function getSessionUser()
    {
        return CMSBackendAuth::getInstance()->getUser();
    }

    /**
     * Load plugins
     */
    public function loadPlugin() {
        /** @var \Extension[] $extensions */
        $extensions = (array) \Extension::findByStatus(1);
        foreach($extensions as $extension) {
            $basePath = ROOT_PATH .'/extension/' .(($extension->type == 'PLUGIN')? 'plugin/' : 'module/');
            require_once $basePath .$extension->path;
        }
    }

    /**
     * Register default taxonomies
     */
    protected function _registerDefaultTaxonomies() {
        Plugin::registerTaxonomy('category', 'post', array(
            'label' => t('Category'),
            'enable_custom_fields' => true,
        ));

        Plugin::registerTaxonomy('banner', 'post', array(
            'label' => t('Banner'),
            'enable_custom_fields' => false,
        ));

        Plugin::registerTaxonomy('post', 'post', array(
            'label' => t('Post')
        ));

        Plugin::addFilter('term_property_form_category', function() {
            Content::addTermPropertyOpt('cat_view', [
                'label' => t('Category view'),
                'control' => 'select',
                'options' => Content::getCategoryTemplates()
            ], 'category');

            Content::addTermPropertyOpt('post_ordering', [
                'label' => t('Posts ordering'),
                'control' => 'select',
                'options' => [
                    [
                        'label' => t('Created time'),
                        'value' => 'created_time'
                    ],
                    [
                        'label' => t('Publish time'),
                        'value' => 'publish_time'
                    ],
                    [
                        'label' => t('Modified time'),
                        'value' => 'modified_time'
                    ],
                    [
                        'label' => t('Post order'),
                        'value' => 'ordering'
                    ],
                    [
                        'label' => t('Hit'),
                        'value' => 'hits'
                    ]
                ]
            ], 'category');

            Content::addTermPropertyOpt('page_size', [
                'label' => t('Page size'),
                'control' => 'input',
                'type' => 'text',
                'placeholder' => t('Number per page')
            ], 'category');

            Content::addTermPropertyOpt('post_view', [
                'label' => t('Post view'),
                'control' => 'select',
                'options' => Content::getPostTemplates()
            ], 'category');
        });
    }

    /**
     * @param $resource
     * @return bool
     */
    public function isAllowed($resource){
        $instance = CMSBackendAuth::getInstance();
        if (!$instance->isCMSBackendAuthenticated()) {
            return false;
        }
        /* if user is god */
        if($instance->getUser()->getId() == 1) {
            return true;
        }
        if(!$resource || $resource == null) return false;

        return true;
//        return Permission::getInstance()->isAllowed($resource);
    }

    /**
     * 404 not found
     *
     * @param null $message
     * @return null
     */
    public function raise404($message = null) {
        return null;
    }

    /**
     * 403 not allow
     *
     * @param null $message
     * @return null
     */
    public function raise403($message = null) {
        return null;
    }
}