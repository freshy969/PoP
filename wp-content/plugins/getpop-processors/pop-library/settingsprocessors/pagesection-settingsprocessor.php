<?php
/**---------------------------------------------------------------------------------------------------------------
 *
 * Template Manager (Handlebars)
 *
 * ---------------------------------------------------------------------------------------------------------------*/

class GetPoP_Processors_PageSectionSettingsProcessor extends Wassup_PageSectionSettingsProcessorBase {

	function add_sideinfo_page_blockunits(&$ret, $template_id) {

		$vars = GD_TemplateManager_Utils::get_vars();
		$target = $vars['target'];
		$add = 
			($template_id == GD_TEMPLATE_PAGESECTION_SIDEINFO_PAGE && $target == GD_URLPARAM_TARGET_MAIN) ||
			($template_id == GD_TEMPLATE_PAGESECTION_SIDEINFO_QUICKVIEWPAGE && $target == GD_URLPARAM_TARGET_QUICKVIEW);
		if ($add) {

			$blocks = $blockgroups = array();
			$page_id = GD_TemplateManager_Utils::get_hierarchy_page_id();
			switch ($page_id) {
				
				/*********************************************
				 * About
				 *********************************************/
				case GETPOP_PROCESSORS_PAGE_HOME:
				case GETPOP_PROCESSORS_PAGE_CONTACTABOUTUS:
				case GETPOP_PROCESSORS_PAGE_WHATISIT:
				// case GETPOP_PROCESSORS_PAGE_DISCOVER:
				case GETPOP_PROCESSORS_PAGE_FRAMEWORK:

					$blocks[] = GD_TEMPLATE_BLOCK_EMPTYSIDEINFO;
					break;

				case GETPOP_PROCESSORS_PAGE_DOCUMENTATION:
				case GETPOP_PROCESSORS_PAGE_DOCUMENTATION_COMINGSOON:
				case GETPOP_PROCESSORS_PAGE_DOCUMENTATION_OVERVIEW:
				case GETPOP_PROCESSORS_PAGE_DOCUMENTATION_MODULARITY:
				case GETPOP_PROCESSORS_PAGE_DOCUMENTATION_MODULEHIERARCHY:
				case GETPOP_PROCESSORS_PAGE_DOCUMENTATION_PROPERTIES:
				case GETPOP_PROCESSORS_PAGE_DOCUMENTATION_DATALOADING:
				case GETPOP_PROCESSORS_PAGE_DOCUMENTATION_DATAPOSTING:
				case GETPOP_PROCESSORS_PAGE_DOCUMENTATION_JSONSTRUCTURE:
				case GETPOP_PROCESSORS_PAGE_DOCUMENTATION_APPLICATIONSTATE:
				case GETPOP_PROCESSORS_PAGE_DOCUMENTATION_USABILITY:
				case GETPOP_PROCESSORS_PAGE_DOCUMENTATION_BACKGROUNDLOADING:
				case GETPOP_PROCESSORS_PAGE_DOCUMENTATION_LAZYLOADING:
				case GETPOP_PROCESSORS_PAGE_DOCUMENTATION_CACHE:

					$blockgroups[] = GETPOP_TEMPLATE_BLOCKGROUP_DOCUMENTATION_SIDEBAR;
					break;
			}

			GD_TemplateManager_Utils::add_blockgroups($ret, $blockgroups, GD_TEMPLATEBLOCKSETTINGS_BLOCKGROUP);
			GD_TemplateManager_Utils::add_blocks($ret, $blocks, GD_TEMPLATEBLOCKSETTINGS_MAIN);
		}
	}

	function add_page_blockunits(&$ret, $template_id) {

		global $gd_template_settingsmanager;

		$vars = GD_TemplateManager_Utils::get_vars();
		$target = $vars['target'];
		$fetching_json = $vars['fetching-json'];
		$fetching_json_data = $vars['fetching-json-data'];
		$submitted_data = $fetching_json_data && doing_post();

		$page_id = GD_TemplateManager_Utils::get_hierarchy_page_id();
		if (!$page_id) return;
		
		$blocks = $blockgroups = $frames = array();

		switch ($page_id) {
			
			case GETPOP_PROCESSORS_PAGE_HOME:
			case GETPOP_PROCESSORS_PAGE_DOCUMENTATION_OVERVIEW:

				if ($template_id == GD_TEMPLATE_PAGESECTION_PAGE) {

					$blockgroups[] = $gd_template_settingsmanager->get_page_blockgroup($page_id);
				}
				break;
			
			case GETPOP_PROCESSORS_PAGE_CONTACTABOUTUS:
			case GETPOP_PROCESSORS_PAGE_WHATISIT:
			// case GETPOP_PROCESSORS_PAGE_DISCOVER:
			case GETPOP_PROCESSORS_PAGE_FRAMEWORK:

			case GETPOP_PROCESSORS_PAGE_DOCUMENTATION:
			case GETPOP_PROCESSORS_PAGE_DOCUMENTATION_COMINGSOON:
			case GETPOP_PROCESSORS_PAGE_DOCUMENTATION_MODULARITY:
			case GETPOP_PROCESSORS_PAGE_DOCUMENTATION_MODULEHIERARCHY:
			case GETPOP_PROCESSORS_PAGE_DOCUMENTATION_PROPERTIES:
			case GETPOP_PROCESSORS_PAGE_DOCUMENTATION_DATALOADING:
			case GETPOP_PROCESSORS_PAGE_DOCUMENTATION_DATAPOSTING:
			case GETPOP_PROCESSORS_PAGE_DOCUMENTATION_JSONSTRUCTURE:
			case GETPOP_PROCESSORS_PAGE_DOCUMENTATION_APPLICATIONSTATE:
			case GETPOP_PROCESSORS_PAGE_DOCUMENTATION_USABILITY:
			case GETPOP_PROCESSORS_PAGE_DOCUMENTATION_BACKGROUNDLOADING:
			case GETPOP_PROCESSORS_PAGE_DOCUMENTATION_LAZYLOADING:
			case GETPOP_PROCESSORS_PAGE_DOCUMENTATION_CACHE:

				if ($template_id == GD_TEMPLATE_PAGESECTION_PAGE) {

					$blocks[] = $gd_template_settingsmanager->get_page_block($page_id);
				}
				break;
		}

		// Frames: PageSection ControlGroups
		switch ($page_id) {

			case GETPOP_PROCESSORS_PAGE_HOME:
			case GETPOP_PROCESSORS_PAGE_CONTACTABOUTUS:
			case GETPOP_PROCESSORS_PAGE_WHATISIT:
			// case GETPOP_PROCESSORS_PAGE_DISCOVER:
			case GETPOP_PROCESSORS_PAGE_FRAMEWORK:

				$frames[] = GD_TEMPLATE_BLOCK_PAGECONTROL;
				break;

			case GETPOP_PROCESSORS_PAGE_DOCUMENTATION:
			case GETPOP_PROCESSORS_PAGE_DOCUMENTATION_COMINGSOON:
			case GETPOP_PROCESSORS_PAGE_DOCUMENTATION_OVERVIEW:
			case GETPOP_PROCESSORS_PAGE_DOCUMENTATION_MODULARITY:
			case GETPOP_PROCESSORS_PAGE_DOCUMENTATION_MODULEHIERARCHY:
			case GETPOP_PROCESSORS_PAGE_DOCUMENTATION_PROPERTIES:
			case GETPOP_PROCESSORS_PAGE_DOCUMENTATION_DATALOADING:
			case GETPOP_PROCESSORS_PAGE_DOCUMENTATION_DATAPOSTING:
			case GETPOP_PROCESSORS_PAGE_DOCUMENTATION_JSONSTRUCTURE:
			case GETPOP_PROCESSORS_PAGE_DOCUMENTATION_APPLICATIONSTATE:
			case GETPOP_PROCESSORS_PAGE_DOCUMENTATION_USABILITY:
			case GETPOP_PROCESSORS_PAGE_DOCUMENTATION_BACKGROUNDLOADING:
			case GETPOP_PROCESSORS_PAGE_DOCUMENTATION_LAZYLOADING:
			case GETPOP_PROCESSORS_PAGE_DOCUMENTATION_CACHE:

				if ($template_id == GD_TEMPLATE_PAGESECTION_PAGE && $target == GD_URLPARAM_TARGET_MAIN) {

					$frames[] = GD_TEMPLATE_BLOCK_PAGEWITHSIDECONTROL;
				}
				elseif ($template_id == GD_TEMPLATE_PAGESECTION_QUICKVIEWPAGE && $target == GD_URLPARAM_TARGET_QUICKVIEW) {

					$frames[] = GD_TEMPLATE_BLOCK_QUICKVIEWPAGECONTROL;//GD_TEMPLATE_BLOCK_QUICKVIEWPAGEWITHSIDECONTROL;
				}
				break;
		}

		GD_TemplateManager_Utils::add_blockgroups($ret, $blockgroups, GD_TEMPLATEBLOCKSETTINGS_BLOCKGROUP);
		GD_TemplateManager_Utils::add_blocks($ret, $blocks, GD_TEMPLATEBLOCKSETTINGS_MAIN);
			
		// Add frames only if not fetching data for the block
		if (!$vars['fetching-json-data']) {
			GD_TemplateManager_Utils::add_blocks($ret, $frames, GD_TEMPLATEBLOCKSETTINGS_FRAME);
		}
	}

	function add_pagetab_blockunits(&$ret, $template_id) {

		$vars = GD_TemplateManager_Utils::get_vars();
		$target = $vars['target'];
		
		$blocks = array();
		$page_id = GD_TemplateManager_Utils::get_hierarchy_page_id();

		switch ($page_id) {

			case GETPOP_PROCESSORS_PAGE_HOME:
			case GETPOP_PROCESSORS_PAGE_CONTACTABOUTUS:
			case GETPOP_PROCESSORS_PAGE_WHATISIT:
			// case GETPOP_PROCESSORS_PAGE_DISCOVER:
			case GETPOP_PROCESSORS_PAGE_FRAMEWORK:

			case GETPOP_PROCESSORS_PAGE_DOCUMENTATION:
			case GETPOP_PROCESSORS_PAGE_DOCUMENTATION_COMINGSOON:
			case GETPOP_PROCESSORS_PAGE_DOCUMENTATION_OVERVIEW:
			case GETPOP_PROCESSORS_PAGE_DOCUMENTATION_MODULARITY:
			case GETPOP_PROCESSORS_PAGE_DOCUMENTATION_MODULEHIERARCHY:
			case GETPOP_PROCESSORS_PAGE_DOCUMENTATION_PROPERTIES:
			case GETPOP_PROCESSORS_PAGE_DOCUMENTATION_DATALOADING:
			case GETPOP_PROCESSORS_PAGE_DOCUMENTATION_DATAPOSTING:
			case GETPOP_PROCESSORS_PAGE_DOCUMENTATION_JSONSTRUCTURE:
			case GETPOP_PROCESSORS_PAGE_DOCUMENTATION_APPLICATIONSTATE:
			case GETPOP_PROCESSORS_PAGE_DOCUMENTATION_USABILITY:
			case GETPOP_PROCESSORS_PAGE_DOCUMENTATION_BACKGROUNDLOADING:
			case GETPOP_PROCESSORS_PAGE_DOCUMENTATION_LAZYLOADING:
			case GETPOP_PROCESSORS_PAGE_DOCUMENTATION_CACHE:
			
				$add = 
					($template_id == GD_TEMPLATE_PAGESECTION_PAGETABS_PAGE && $target == GD_URLPARAM_TARGET_MAIN) ||
					($template_id == GD_TEMPLATE_PAGESECTION_ADDONTABS_PAGE && $target == GD_URLPARAM_TARGET_ADDONS);
				if ($add) {

					$blocks[] = GD_TEMPLATE_BLOCK_PAGETABS_PAGE;
				}
				break;		
		}

		GD_TemplateManager_Utils::add_blocks($ret, $blocks, GD_TEMPLATEBLOCKSETTINGS_MAIN);
	}
}

/**---------------------------------------------------------------------------------------------------------------
 * Initialization
 * ---------------------------------------------------------------------------------------------------------------*/
new GetPoP_Processors_PageSectionSettingsProcessor();
