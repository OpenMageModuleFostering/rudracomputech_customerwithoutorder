<?php
/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magento.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magento.com for more information.
 *
 * @category    Mage
 * @package     Mage_Adminhtml
 * @copyright  Copyright (c) 2006-2015 X.commerce, Inc. (http://www.magento.com)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Adminhtml new accounts report page content block
 *
 * @category   Mage
 * @package    Mage_Adminhtml
 * @author      Magento Core Team <core@magentocommerce.com>
 */

class Rudracomputech_Customerwithoutorder_Block_Adminhtml_Report_Customer_Customerwithoutorder extends Mage_Adminhtml_Block_Widget_Grid_Container
{

    public function __construct()
    {
		#$class = Mage::getConfig()->getBlockClassName('customerwithoutorder/adminhtml_report_customer_customerwithoutorder_grid');
		#var_dump($class);die;

		 $this->_blockGroup = 'customerwithoutorder';	
        $this->_controller = 'adminhtml_report_customer_customerwithoutorder';
        $this->_headerText = Mage::helper('reports')->__('Customer without order');
        parent::__construct();
        $this->_removeButton('add');
    }

}
