<?php
/**---------------------------------------------------------------------------------------------------------------
 *
 * Data Load Library
 *
 * ---------------------------------------------------------------------------------------------------------------*/

define ('GD_DATALOAD_IOHANDLER_BLOCK', 'block');

class GD_DataLoad_IOHandler_Block extends GD_DataLoad_BlockIOHandler {

    function get_name() {
    
		return GD_DATALOAD_IOHANDLER_BLOCK;
	}
}
	
/**---------------------------------------------------------------------------------------------------------------
 * Initialize
 * ---------------------------------------------------------------------------------------------------------------*/
new GD_DataLoad_IOHandler_Block();
