<?php
declare(strict_types=1);

namespace FacturaScripts\Plugins\WidgetNif;

use FacturaScripts\Core\Template\InitClass;

/**
 * Plugin initializer. Widget is auto-discovered by FacturaScripts via ColumnItem.php — no
 * manual registration needed. This class only handles install/update/uninstall lifecycle.
 */
class Init extends InitClass
{
    public function init(): void
    {
    }

    public function update(): void
    {
    }

    public function uninstall(): void
    {
    }
}
