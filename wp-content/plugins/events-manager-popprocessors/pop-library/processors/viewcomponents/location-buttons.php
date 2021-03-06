<?php
/**---------------------------------------------------------------------------------------------------------------
 *
 * Template Manager (Handlebars)
 *
 * ---------------------------------------------------------------------------------------------------------------*/

define ('GD_TEMPLATE_VIEWCOMPONENT_BUTTON_POSTLOCATIONS', PoP_TemplateIDUtils::get_template_definition('em-viewcomponent-button-postlocations'));
define ('GD_TEMPLATE_VIEWCOMPONENT_BUTTON_POSTLOCATIONS_NOINITMARKERS', PoP_TemplateIDUtils::get_template_definition('em-viewcomponent-button-postlocations-noinitmarkers'));
define ('GD_TEMPLATE_VIEWCOMPONENT_BUTTON_USERLOCATIONS', PoP_TemplateIDUtils::get_template_definition('em-viewcomponent-button-userlocations'));
define ('GD_TEMPLATE_VIEWCOMPONENT_BUTTON_USERLOCATIONS_NOINITMARKERS', PoP_TemplateIDUtils::get_template_definition('em-viewcomponent-button-userlocations-noinitmarkers'));
define ('GD_TEMPLATE_VIEWCOMPONENT_BUTTON_POSTSIDEBARLOCATIONS', PoP_TemplateIDUtils::get_template_definition('em-viewcomponent-button-postsidebarlocations'));
define ('GD_TEMPLATE_VIEWCOMPONENT_BUTTON_USERSIDEBARLOCATIONS', PoP_TemplateIDUtils::get_template_definition('em-viewcomponent-button-usersidebarlocations'));

class GD_Template_Processor_LocationViewComponentButtons extends GD_Template_Processor_LocationViewComponentButtonsBase {

	function get_templates_to_process() {
	
		return array(
			GD_TEMPLATE_VIEWCOMPONENT_BUTTON_POSTLOCATIONS,
			GD_TEMPLATE_VIEWCOMPONENT_BUTTON_POSTLOCATIONS_NOINITMARKERS,
			GD_TEMPLATE_VIEWCOMPONENT_BUTTON_USERLOCATIONS,
			GD_TEMPLATE_VIEWCOMPONENT_BUTTON_USERLOCATIONS_NOINITMARKERS,
			GD_TEMPLATE_VIEWCOMPONENT_BUTTON_POSTSIDEBARLOCATIONS,
			GD_TEMPLATE_VIEWCOMPONENT_BUTTON_USERSIDEBARLOCATIONS,
		);
	}
	
	function init_markers($template_id) {

		// When in the Map window, the location link must not initialize the markers, since they are already initialized by the map itself.
		// Do it so, initializes them twice, which leads to problems, like when searching it displays markers from the previous state 
		// (which were initialized then drawn then initialized again and remained there in the memory)
		switch ($template_id) {

			case GD_TEMPLATE_VIEWCOMPONENT_BUTTON_POSTLOCATIONS_NOINITMARKERS:
			case GD_TEMPLATE_VIEWCOMPONENT_BUTTON_USERLOCATIONS_NOINITMARKERS:
			
				return false;
		}

		return parent::init_markers($template_id);
	}

	function get_location_complement_template($template_id) {

		switch ($template_id) {

			case GD_TEMPLATE_VIEWCOMPONENT_BUTTON_POSTSIDEBARLOCATIONS:
			case GD_TEMPLATE_VIEWCOMPONENT_BUTTON_USERSIDEBARLOCATIONS:
			
				return GD_TEMPLATE_EM_LAYOUT_LOCATIONADDRESS;
		}

		return parent::get_location_complement_template($template_id);
	}
	function get_join_separator($template_id) {
		
		switch ($template_id) {

			case GD_TEMPLATE_VIEWCOMPONENT_BUTTON_POSTSIDEBARLOCATIONS:
			case GD_TEMPLATE_VIEWCOMPONENT_BUTTON_USERSIDEBARLOCATIONS:
			
				return '<br/>';
		}

		return parent::get_join_separator($template_id);
	}
	function get_each_separator($template_id) {
		
		switch ($template_id) {

			case GD_TEMPLATE_VIEWCOMPONENT_BUTTON_POSTSIDEBARLOCATIONS:
			case GD_TEMPLATE_VIEWCOMPONENT_BUTTON_USERSIDEBARLOCATIONS:
			
				return '<br/>';
		}

		return parent::get_each_separator($template_id);
	}
	function get_complement_separator($template_id) {
		
		switch ($template_id) {

			case GD_TEMPLATE_VIEWCOMPONENT_BUTTON_POSTSIDEBARLOCATIONS:
			case GD_TEMPLATE_VIEWCOMPONENT_BUTTON_USERSIDEBARLOCATIONS:
			
				return '<br/>';
		}

		return parent::get_complement_separator($template_id);
	}

	function get_buttoninner_template($template_id) {

		$buttoninners = array(
			GD_TEMPLATE_VIEWCOMPONENT_BUTTON_POSTLOCATIONS => GD_TEMPLATE_VIEWCOMPONENT_BUTTONINNER_LOCATIONS,
			GD_TEMPLATE_VIEWCOMPONENT_BUTTON_POSTLOCATIONS_NOINITMARKERS => GD_TEMPLATE_VIEWCOMPONENT_BUTTONINNER_LOCATIONS,
			GD_TEMPLATE_VIEWCOMPONENT_BUTTON_USERLOCATIONS => GD_TEMPLATE_VIEWCOMPONENT_BUTTONINNER_LOCATIONS,
			GD_TEMPLATE_VIEWCOMPONENT_BUTTON_USERLOCATIONS_NOINITMARKERS => GD_TEMPLATE_VIEWCOMPONENT_BUTTONINNER_LOCATIONS,
			GD_TEMPLATE_VIEWCOMPONENT_BUTTON_POSTSIDEBARLOCATIONS => GD_TEMPLATE_VIEWCOMPONENT_BUTTONINNER_LOCATIONS,
			GD_TEMPLATE_VIEWCOMPONENT_BUTTON_USERSIDEBARLOCATIONS => GD_TEMPLATE_VIEWCOMPONENT_BUTTONINNER_LOCATIONS,
		);

		switch ($template_id) {

			case GD_TEMPLATE_VIEWCOMPONENT_BUTTON_POSTLOCATIONS:
			case GD_TEMPLATE_VIEWCOMPONENT_BUTTON_POSTLOCATIONS_NOINITMARKERS:
			case GD_TEMPLATE_VIEWCOMPONENT_BUTTON_USERLOCATIONS:
			case GD_TEMPLATE_VIEWCOMPONENT_BUTTON_USERLOCATIONS_NOINITMARKERS:
			case GD_TEMPLATE_VIEWCOMPONENT_BUTTON_POSTSIDEBARLOCATIONS:
			case GD_TEMPLATE_VIEWCOMPONENT_BUTTON_USERSIDEBARLOCATIONS:

				return $buttoninners[$template_id];
		}

		return parent::get_buttoninner_template($template_id);
	}

	function get_header_template($template_id) {

		switch ($template_id) {

			case GD_TEMPLATE_VIEWCOMPONENT_BUTTON_POSTLOCATIONS:
			case GD_TEMPLATE_VIEWCOMPONENT_BUTTON_POSTLOCATIONS_NOINITMARKERS:
			case GD_TEMPLATE_VIEWCOMPONENT_BUTTON_POSTSIDEBARLOCATIONS:

				return GD_TEMPLATE_VIEWCOMPONENT_HEADER_POST;

			case GD_TEMPLATE_VIEWCOMPONENT_BUTTON_USERLOCATIONS:
			case GD_TEMPLATE_VIEWCOMPONENT_BUTTON_USERLOCATIONS_NOINITMARKERS:
			case GD_TEMPLATE_VIEWCOMPONENT_BUTTON_USERSIDEBARLOCATIONS:

				return GD_TEMPLATE_VIEWCOMPONENT_HEADER_USER;
		}
		
		return parent::get_header_template($template_id);
	}

	function get_linktarget($template_id, $atts) {

		switch ($template_id) {

			case GD_TEMPLATE_VIEWCOMPONENT_BUTTON_POSTLOCATIONS:
			case GD_TEMPLATE_VIEWCOMPONENT_BUTTON_POSTLOCATIONS_NOINITMARKERS:
			case GD_TEMPLATE_VIEWCOMPONENT_BUTTON_POSTSIDEBARLOCATIONS:
			case GD_TEMPLATE_VIEWCOMPONENT_BUTTON_USERLOCATIONS:
			case GD_TEMPLATE_VIEWCOMPONENT_BUTTON_USERLOCATIONS_NOINITMARKERS:
			case GD_TEMPLATE_VIEWCOMPONENT_BUTTON_USERSIDEBARLOCATIONS:

				return GD_URLPARAM_TARGET_MODALS;
		}
		
		return parent::get_linktarget($template_id, $atts);
	}

	function get_title($template_id) {
		
		switch ($template_id) {
					
			case GD_TEMPLATE_VIEWCOMPONENT_BUTTON_POSTLOCATIONS:
			case GD_TEMPLATE_VIEWCOMPONENT_BUTTON_POSTLOCATIONS_NOINITMARKERS:
			case GD_TEMPLATE_VIEWCOMPONENT_BUTTON_USERLOCATIONS:
			case GD_TEMPLATE_VIEWCOMPONENT_BUTTON_USERLOCATIONS_NOINITMARKERS:

				// return __('Locations', 'em-popprocessors');

			case GD_TEMPLATE_VIEWCOMPONENT_BUTTON_POSTSIDEBARLOCATIONS:
			case GD_TEMPLATE_VIEWCOMPONENT_BUTTON_USERSIDEBARLOCATIONS:

				return __('All Locations', 'em-popprocessors');
		}
		
		return parent::get_title($template_id);
	}
}


/**---------------------------------------------------------------------------------------------------------------
 * Initialization
 * ---------------------------------------------------------------------------------------------------------------*/
new GD_Template_Processor_LocationViewComponentButtons();