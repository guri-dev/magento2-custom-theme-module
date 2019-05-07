<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Pilot\Smile\Api\Data;

/**
 * CMS page interface.
 * @api
 * @since 100.0.2
 */
interface SliderInterface
{
    /**#@+
     * Constants for keys of data array. Identical to the name of the getter in snake case
     */
    const SLIDE_ID     = 'slide_id';
    const IDENTIFIER   = 'identifier';
    const SLIDE_TITLE  = 'slide_title';
    
    /**#@-*/

    /**
     * Get ID
     *
     * @return int|null
     */
    public function getSlideId();

    /**
     * Get identifier
     *
     * @return string
     */
    public function getIdentifier();

    /**
     * Get title
     *
     * @return string|null
     */
    public function getTitle();

    /**
     * Get page layout
     *
     * @return string|null
     */
    public function getPageLayout();

    /**
     * Get meta title
     *
     * @return string|null
     * @since 101.0.0
     */
    public function getMetaTitle();

    /**
     * Get meta keywords
     *
     * @return string|null
     */
    public function getMetaKeywords();

    /**
     * Get meta description
     *
     * @return string|null
     */
    public function getMetaDescription();

    /**
     * Get content heading
     *
     * @return string|null
     */
    public function getContentHeading();

    /**
     * Get content
     *
     * @return string|null
     */
    public function getContent();

    /**
     * Get creation time
     *
     * @return string|null
     */
    public function getCreationTime();

    /**
     * Get update time
     *
     * @return string|null
     */
    public function getUpdateTime();

    /**
     * Get sort order
     *
     * @return string|null
     */
    public function getSortOrder();

    /**
     * Get layout update xml
     *
     * @return string|null
     */
    public function getLayoutUpdateXml();

    /**
     * Get custom theme
     *
     * @return string|null
     */
    public function getCustomTheme();

    /**
     * Get custom root template
     *
     * @return string|null
     */
    public function getCustomRootTemplate();

    /**
     * Get custom layout update xml
     *
     * @return string|null
     */
    public function getCustomLayoutUpdateXml();

    /**
     * Get custom theme from
     *
     * @return string|null
     */
    public function getCustomThemeFrom();

    /**
     * Get custom theme to
     *
     * @return string|null
     */
    public function getCustomThemeTo();

    /**
     * Is active
     *
     * @return bool|null
     */
    public function isActive();

    /**
     * Set ID
     *
     * @param int $id
     * @return \Magento\Cms\Api\Data\PageInterface
     */
    public function setId($id);

    /**
     * Set identifier
     *
     * @param string $identifier
     * @return \Magento\Cms\Api\Data\PageInterface
     */
    public function setIdentifier($identifier);

    /**
     * Set title
     *
     * @param string $title
     * @return \Magento\Cms\Api\Data\PageInterface
     */
    public function setTitle($title);

    /**
     * Set page layout
     *
     * @param string $pageLayout
     * @return \Magento\Cms\Api\Data\PageInterface
     */
    public function setPageLayout($pageLayout);

    /**
     * Set meta title
     *
     * @param string $metaTitle
     * @return \Magento\Cms\Api\Data\PageInterface
     * @since 101.0.0
     */
    public function setMetaTitle($metaTitle);

    /**
     * Set meta keywords
     *
     * @param string $metaKeywords
     * @return \Magento\Cms\Api\Data\PageInterface
     */
    public function setMetaKeywords($metaKeywords);

    /**
     * Set meta description
     *
     * @param string $metaDescription
     * @return \Magento\Cms\Api\Data\PageInterface
     */
    public function setMetaDescription($metaDescription);

    /**
     * Set content heading
     *
     * @param string $contentHeading
     * @return \Magento\Cms\Api\Data\PageInterface
     */
    public function setContentHeading($contentHeading);

    /**
     * Set content
     *
     * @param string $content
     * @return \Magento\Cms\Api\Data\PageInterface
     */
    public function setContent($content);

    /**
     * Set creation time
     *
     * @param string $creationTime
     * @return \Magento\Cms\Api\Data\PageInterface
     */
    public function setCreationTime($creationTime);

    /**
     * Set update time
     *
     * @param string $updateTime
     * @return \Magento\Cms\Api\Data\PageInterface
     */
    public function setUpdateTime($updateTime);

    /**
     * Set sort order
     *
     * @param string $sortOrder
     * @return \Magento\Cms\Api\Data\PageInterface
     */
    public function setSortOrder($sortOrder);

    /**
     * Set layout update xml
     *
     * @param string $layoutUpdateXml
     * @return \Magento\Cms\Api\Data\PageInterface
     */
    public function setLayoutUpdateXml($layoutUpdateXml);

    /**
     * Set custom theme
     *
     * @param string $customTheme
     * @return \Magento\Cms\Api\Data\PageInterface
     */
    public function setCustomTheme($customTheme);

    /**
     * Set custom root template
     *
     * @param string $customRootTemplate
     * @return \Magento\Cms\Api\Data\PageInterface
     */
    public function setCustomRootTemplate($customRootTemplate);

    /**
     * Set custom layout update xml
     *
     * @param string $customLayoutUpdateXml
     * @return \Magento\Cms\Api\Data\PageInterface
     */
    public function setCustomLayoutUpdateXml($customLayoutUpdateXml);

    /**
     * Set custom theme from
     *
     * @param string $customThemeFrom
     * @return \Magento\Cms\Api\Data\PageInterface
     */
    public function setCustomThemeFrom($customThemeFrom);

    /**
     * Set custom theme to
     *
     * @param string $customThemeTo
     * @return \Magento\Cms\Api\Data\PageInterface
     */
    public function setCustomThemeTo($customThemeTo);

    /**
     * Set is active
     *
     * @param int|bool $isActive
     * @return \Magento\Cms\Api\Data\PageInterface
     */
    public function setIsActive($isActive);
}
