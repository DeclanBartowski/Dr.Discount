<?php
  /**
   * Created by PhpStorm.
   * User: 2qucick
   * Date: 04.01.2018
   * Time: 10:05
   */
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\EventManager;
use Bitrix\Main\Context;

Loc::loadMessages(__FILE__);

class Vpl_tools extends CModule
{
    var $MODULE_ID = 'vpl.tools';
    var $MODULE_VERSION;
    var $MODULE_VERSION_DATE;
    var $MODULE_NAME;
    var $MODULE_DESCRIPTION;
    var $PARTNER_NAME;
    var $PARTNER_URI;

    protected $module_path;
    protected $root_dir;

    /**
     * $_SERVER
     * @var
     */
    private $server;

    protected static $events = [];

    public function __construct()
    {
        $arModuleVersion = array();

        include(__DIR__.'/version.php');

        if (is_array($arModuleVersion) && array_key_exists('VERSION', $arModuleVersion))
        {
            $this->MODULE_VERSION = $arModuleVersion['VERSION'];
            $this->MODULE_VERSION_DATE = $arModuleVersion['VERSION_DATE'];
        }

        $this->MODULE_NAME = Loc::getMessage('TQ_TOOLS_MODULE_NAME');
        $this->MODULE_DESCRIPTION = Loc::getMessage("TQ_TOOLS_MODULE_DESCRIPTION");
        $this->PARTNER_NAME = Loc::getMessage("TQ_TOOLS_MODULE_PARTNER_NAME");
        $this->PARTNER_URI = Loc::getMessage("TQ_TOOLS_MODULE_PARTNER_URI");
        $this->module_path = dirname(__DIR__);
        $this->root_dir = (strpos($this->module_path, '/local/')!==false ? 'local' : 'bitrix');
        $this->server = Context::getCurrent()->getServer();
    }

    /**
     * Установка модуля
     */
    public function DoInstall()
    {
        global $APPLICATION;
        RegisterModule($this->MODULE_ID);
        $APPLICATION->IncludeAdminFile('Установка модуля ' . $this->MODULE_ID, $this->module_path . "/install/step.php");
    }

    /**
     * Удаление модуля
     */
    public function DoUninstall()
     {
         global $APPLICATION;
         UnRegisterModule($this->MODULE_ID);
         $APPLICATION->IncludeAdminFile('Деинсталляция модуля ' . $this->MODULE_ID, $this->module_path . "/install/unstep.php");
     }

    /**
     * Добавляем события
     * @return bool
     */
    public function InstallEvents()
    {
        return true;
    }

    /**
     * Удаляем события
     * @return bool
     */
    public function UnInstallEvents()
    {
        return true;
    }

    /**
     * Копируем файлы модуля
     * @param array $arParams
     * @return bool
     */
    public function InstallFiles($arParams = [])
    {
        return true;
    }

    /**
     * Удаляем файлы модуля
     * @return bool
     */
    public function UnInstallFiles()
    {
        return true;
    }
}