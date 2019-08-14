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
 * Adminhtml new accounts report grid block
 *
 * @category   Mage
 * @package    Mage_Adminhtml
 * @author      Magento Core Team <core@magentocommerce.com>
 */
class Rudracomputech_Customerwithoutorder_Block_Adminhtml_Report_Customer_Customerwithoutorder_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
   public function __construct()
    {
        parent::__construct();
        $this->setId('gridOrdersCustomer');
		#$this->setDefaultSort('id');
        #$this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
    }
    protected function _createCollection()
    {
		  $collection = Mage::getResourceModel('customer/customer_collection')
						->addNameToSelect()
						->addAttributeToSelect('email')
						->addAttributeToSelect('created_at')
						->addAttributeToSelect('group_id')
						->joinAttribute('company', 'customer_address/company', 'default_billing', null, 'left')
						->joinAttribute('billing_telephone', 'customer_address/telephone', 'default_billing', null, 'left')
						->joinAttribute('billing_country_id', 'customer_address/country_id', 'default_billing', null, 'left');
						$collection->getSelect()->joinLeft(
							array('o' => Mage::getSingleton('core/resource')->getTableName('sales/order')),
							'o.customer_id = e.entity_id',
							array(
								'o.created_at' => 'MAX(o.created_at)',
							)
						) ;
						$collection->groupByAttribute('entity_id')
						->getSelect()
						->where('o.created_at IS NULL');
        return $collection;
    }
    protected function _prepareCollection()
    {
		$collection = $this->_createCollection();
		#echo $collection->getSelect();die;
        $this->setCollection($collection);
		 try {
			parent::_prepareCollection();
        }
		 catch (Exception $e) {
            //abort rendering grid and replace collection with an empty one
            $this->setCollection(new Varien_Data_Collection());
        }
        return $this;
	}
    protected function _prepareColumns()
	{
		$this->addColumn('entity_id', array(
			'header'    => Mage::helper('customer')->__('ID'),
			'width'     => '50px',
			'index'     => 'entity_id',
			'type'  => 'number',
		));
		$this->addColumn('name', array(
			'header'    => Mage::helper('customer')->__('Name'),
			'index'     => 'name'
		));
		$this->addColumn('email', array(
			'header'    => Mage::helper('customer')->__('Email'),
			'width'     => '150',
			'index'     => 'email'
		));
		$this->addColumn('company', array(
			'header' => 'Company Name',
			'type' => 'text',
			'index' => 'company',
		));
		$this->addColumn('Telephone', array(
			'header'    => Mage::helper('customer')->__('Telephone'),
			'width'     => '100',
			'index'     => 'billing_telephone'
		));
		$this->addColumn('billing_country_id', array(
			'header'    => Mage::helper('customer')->__('Country'),
			'width'     => '100',
			'type'      => 'country',
			'index'     => 'billing_country_id',
		));
		$this->addColumn('customer_since', array(
			'header'    => Mage::helper('customer')->__('Customer Since'),
			'type'      => 'datetime',
			'align'     => 'center',
			'index'     => 'created_at',
			
			'gmtoffset' => true
		));
		if (!Mage::app()->isSingleStoreMode()) {
			$this->addColumn('website_id', array(
				'header'    => Mage::helper('customer')->__('Website'),
				'align'     => 'center',
				'width'     => '80px',
				'type'      => 'options',
				'options'   => Mage::getSingleton('adminhtml/system_store')->getWebsiteOptionHash(true),
				'index'     => 'website_id',
			));
		}
		$this->addColumn('action',
			array(
				'header'    =>  Mage::helper('customer')->__('Action'),
				'width'     => '100',
				'type'      => 'action',
				'getter'    => 'getId',
				'actions'   => array(
					 array(
                        'caption'   => Mage::helper('customer')->__('Edit'),
                        'url'       => array('base'=> '*/customer/edit'),
                        'field'     => 'id'
                    )
				),
				'filter'    => false,
				'sortable'  => false,
				'index'     => 'stores',
				'is_system' => true,
		));
		$this->addExportType('*/*/exportCsv', Mage::helper('customerwithoutorder')->__('CSV'));
		$this->addExportType('*/*/exportExcel', Mage::helper('customerwithoutorder')->__('Excel XML'));
		return parent::_prepareColumns();
	}
    public function getRowUrl($row)
    {
        return $this->getUrl('adminhtml/customer/edit', array('id'=>$row->getId()));
    }
}