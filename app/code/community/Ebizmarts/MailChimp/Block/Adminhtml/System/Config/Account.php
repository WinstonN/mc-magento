<?php
/**
 * MailChimp For Magento
 *
 * @category  Ebizmarts_MailChimp
 * @author    Ebizmarts Team <info@ebizmarts.com>
 * @copyright Ebizmarts (http://ebizmarts.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @date:     4/29/16 3:55 PM
 * @file:     Account.php
 */
class Ebizmarts_MailChimp_Block_Adminhtml_System_Config_Account extends Mage_Adminhtml_Block_System_Config_Form_Field
{
    protected function _getElementHtml(Varien_Data_Form_Element_Abstract $element)
    {
        $firstErrorKey = Ebizmarts_MailChimp_Model_System_Config_Source_Account::NO_STORE_TEXT_KEY;
        $firstMigrationKey = Ebizmarts_MailChimp_Model_System_Config_Source_Account::STORE_MIGRATION_TEXT_KEY;
        $syncLabelKey = Ebizmarts_MailChimp_Model_System_Config_Source_Account::SYNC_LABEL_KEY;
        $values = $element->getValues();

        $html = '<ul class="checkboxes">';

        foreach ($values as $dat) {
            if ($dat['value'] >= $firstErrorKey && $dat['value'] < $firstMigrationKey) {
                $html .= "<li style='color:red;font-weight: bold;'>{$dat['label']}</li>";
            } elseif ($dat['value'] == $firstMigrationKey) {
                $html .= "<li style='color:forestgreen;font-weight: bold;'>{$dat['label']}</li>";
            } elseif($dat['value'] == $syncLabelKey) {
                $textArray = explode(':', $dat['label']);
                if (strstr($textArray[1], $this->__('Finished'))) {
                    $html .= "<li>{$textArray[0]} : <span style='color:forestgreen;font-weight: bold;'>{$textArray[1]}</span></li>";
                } else {
                    $html .= "<li>{$textArray[0]} : <span style='color:#ed6502;font-weight: bold;'>{$textArray[1]}</span></li>";
                }
            } else {
                $html .= "<li>{$dat['label']}</li>";
            }
        }

        $html .= '</ul>';

        return $html;
    }
}