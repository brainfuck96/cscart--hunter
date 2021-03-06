<?php
/***************************************************************************
 *                                                                          *
 *   (c) 2004 Vladimir V. Kalynyak, Alexey V. Vinokurov, Ilya M. Shalnev    *
 *                                                                          *
 * This  is  commercial  software,  only  users  who have purchased a valid *
 * license  and  accept  to the terms of the  License Agreement can install *
 * and use this program.                                                    *
 *                                                                          *
 ****************************************************************************
 * PLEASE READ THE FULL TEXT  OF THE SOFTWARE  LICENSE   AGREEMENT  IN  THE *
 * "copyright.txt" FILE PROVIDED WITH THIS DISTRIBUTION PACKAGE.            *
 ****************************************************************************/


namespace Tygh\Addons\GiftCertificates\Documents\GiftCertificate\Variables;


use Tygh\Addons\GiftCertificates\Documents\GiftCertificate\Context;
use Tygh\Template\Document\Variables\GenericVariable;
use Tygh\Tools\Formatter;

/**
 * Class GiftCertificate
 * @package Tygh\Addons\GiftCertifications\Documents\GiftCertificate\Variables
 */
class GiftCertificate extends GenericVariable
{
    /** @var Context  */
    protected $context;
    
    /**
     * GiftCertificate constructor.
     *
     * @param Context   $context
     * @param array     $config
     * @param Formatter $formatter
     */
    public function __construct(Context $context, $config, Formatter $formatter)
    {
        $data = $context->getCertificateData();
        $data['amount'] = $formatter->asPrice($data['amount']);
        $config['data'] = $data;
        
        parent::__construct($context, $config);
    }
}