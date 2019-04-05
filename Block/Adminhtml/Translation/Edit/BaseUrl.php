<?php

namespace Experius\MissingTranslations\Block\Adminhtml\Translation\Edit;

use Magento\Backend\Helper\Data as BackendHelper;
use Magento\Framework\View\Element\Template;

class BaseUrl extends Template
{
    /** @var BackendHelper */
    protected $backendHelper;

    /**
     * BaseUrl constructor.
     *
     * @param Context       $context
     * @param BackendHelper $backendHelper
     * @param array         $data
     */
    public function __construct(
        Template\Context $context,
        BackendHelper $backendHelper,
        array $data = []
    ) {
        $this->backendHelper = $backendHelper;

        parent::__construct($context, $data);
    }

    /**
     * Get the base URL of the current page. This will return the
     * admin base URL, which we can use within JavaScript's URL
     * Builder.
     *
     * @return string
     */
    public function getBaseUrl()
    {
        $adminUrl = $this->backendHelper->getHomePageUrl();

        /**
         * For some reason the admin homepage URL contains "admin/" as a suffix.
         * To ensure this script works, this will be removed as it's not part of
         * the actual admin base URL
         */
        if (substr($adminUrl, -6) === 'admin/' && substr_count($adminUrl, 'admin/') > 1) {
            $adminUrl = substr($adminUrl, 0, -6);
        }

        return $adminUrl;
    }
}
