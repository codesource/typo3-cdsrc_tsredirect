<?php

namespace CDSRC\CdsrcTsredirect\Controller;

/* * *************************************************************
 *  Copyright notice
 *
 *  (c) 2013 Matthias Toscanelli (m.toscanelli@code-source.ch)
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *  A copy is found in the textfile GPL.txt and important notices to the license
 *  from the author is found in LICENSE.txt distributed with these scripts.
 *
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 * ************************************************************* */

use \TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * This class provides the ability to redirect to a URL via Typoscript.
 *
 * @author Matthias Toscanelli <m.toscanelli@code-source.ch>
 */
class RedirectionController {

    /**
     * Content Object
     *
     * @var \TYPO3\CMS\Backend\Frontend\ContentObject
     */
    protected $cObj;

    /**
     * Current request URL
     *
     * @var string
     */
    protected $requestUrl;

    /**
     * Check TYPO3 version and build ContentObject
     *
     */
    public function __construct() {
        // TYPO3 version check is based on class existance
        $this->cObj = GeneralUtility::makeInstance('TYPO3\\CMS\\Frontend\\ContentObject\\ContentObjectRenderer');
        $this->requestUrl = GeneralUtility::getIndpEnv('TYPO3_REQUEST_URL');
    }

    /**
     * Typoscript User function to redirect to an URL
     * Use typolink configuration to create the URL
     *
     * @param array $conf Configuration used to create
     *
     * @return string return an HTML comment if configuration is wrong
     */
    public function redirect(array $conf, $pObj) {
        if ($this->cObj->checkIf($conf['if.'])) {
            // Force typolink to return last generated URL
            $conf['typolink.']['returnLast'] = 'url';

            // Force typolink to set absolute URL
            $conf['typolink.']['forceAbsoluteUrl'] = 1;

            $url = $this->cObj->typoLink_URL($conf['typolink.']);
            if (strlen($url) > 0) {
                if ($url !== $this->requestUrl) {
                    $status = 0;
                    $message = '';
                    $this->setStatusAndMessage($status, $message, $conf);
                    if($status > 0 && strlen($message) > 0){
                        header('Status: ' . $status . ' ' . $message, TRUE, $status);
                    }
                    header('Location: ' . $url);

                    // Use Javascript in case browser don't care of headers
                    echo '<script type="text/javascript">
                            // <![CDATA[
                                window.location = "' . $url . '";
                            // ]]>
                          </script>';

                    // Make sure to exit and stop processing
                    exit;
                } else {
                    return '';
                }
            }
            return '<!-- CDSRC_TSREDIRECT: INVALID CONFIGURATION -->';
        }
        return '';
    }

    /**
     * Set status and message based on configuration
     *
     * @param integer $status
     * @param string $message
     * @param array $conf
     */
    protected function setStatusAndMessage(&$status, &$message, array $conf) {
        if ($conf['status'] || is_array($conf['status.'])) {
            $status = intval($this->cObj->stdWrap($conf['status'], $conf['status.']));
            if ($status < 300 || $status >= 400) {
                $status = 302;
            }
            switch ($status) {
                case 300:
                    $message = 'Multiple Choices';
                    break;
                case 301:
                    $message = 'Moved Permanently';
                    break;
                case 302:
                    $message = 'Found';
                    break;
                case 303:
                    $message = 'See Other';
                    break;
                case 304:
                    $message = 'Not Modified';
                    break;
                case 305:
                    $message = 'Use Proxy';
                    break;
                case 307:
                    $message = 'Temporary Redirect';
                    break;
            }
            if ($conf['status.']['message'] || is_array($conf['status.']['message.'])) {
                $userMessage = trim($this->cObj->stdWrap($conf['status.']['message'], $conf['status.']['message.']));
                if(strlen($userMessage) > 0){
                    $message = $userMessage;
                }
            }
        }
    }

}
