<?php
echo "\n" . date_format(new \DateTime(), 'Y.m.d H:i:s')
    . " "
    . $inventoryUnits->count()
    . " InventoryUnits will export.";

echo "\n" . date_format(new \DateTime(), 'Y.m.d H:i:s')
    . " "
    . round(memory_get_usage(true) / 1048576, 2) . ' Mb'
    . ' Mb'
    . $inventoryUnits->count()
    . " InventoryUnits will export.";   

echo "\n" 
    . date_format(new \DateTime(), 'Y.m.d H:i:s')
    . ' '
    . round(memory_get_usage(true) / 1048576, 2)
    . ' '
    . ' Mb.'
    . ' '
    . 'Inventory units calculation begin.';
