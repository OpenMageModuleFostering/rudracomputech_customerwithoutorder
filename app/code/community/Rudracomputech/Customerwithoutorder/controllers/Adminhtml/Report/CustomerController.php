<?php
class Rudracomputech_Customerwithoutorder_Adminhtml_Report_CustomerController extends Mage_Adminhtml_Controller_Action
{
	  /**
     * Add report/customer breadcrumbs
     *
     * @return Rudracomputech_Customerwithoutorder_Adminhtml_Report_CustomerController
     */
    public function _initAction()
    {
      
        $this->loadLayout()
            ->_addBreadcrumb(Mage::helper('reports')->__('Reports'), Mage::helper('reports')->__('Reports'))
            ->_addBreadcrumb(Mage::helper('reports')->__('Customers'), Mage::helper('reports')->__('Customers'))
            ->_addBreadcrumb(Mage::helper('reports')->__('Customer without order'), Mage::helper('reports')->__('Customer without order'));
        return $this;
    }
	
	public function customerwithoutorderAction()
    {
		
    $this->_initAction()
        ->_setActiveMenu('report/customer/customerwithoutorder')
        ->_addBreadcrumb(Mage::helper('reports')->__('Customers without Orders'), Mage::helper('reports')->__('Customers without Orders'))
        ->_addContent($this->getLayout()->createBlock('customerwithoutorder/adminhtml_report_customer_customerwithoutorder'))
        ->renderLayout();
    }
	/**
    * Export Customer grid to CSV format
    */
    public function exportCsvAction()
    {
       $fileName   = 'customer_report.csv';
       $csv       =  $this->getLayout()->createBlock('customerwithoutorder/adminhtml_report_customer_customerwithoutorder_grid')->getCsvFile();
       $this->_prepareDownloadResponse($fileName, $csv);
    }
	/**
    * Export Customer grid to Excel format
    */
	public function exportExcelAction()  
	{  
	
		$fileName   = 'customer_report.xls';
		$xls    = $this->getLayout()->createBlock('customerwithoutorder/adminhtml_report_customer_customerwithoutorder_grid')->getExcelFile();
		$this->_prepareDownloadResponse($fileName, $xls);  
	}  
	
}