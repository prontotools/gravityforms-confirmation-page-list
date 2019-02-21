<?php
require_once WP_PLUGIN_DIR . '/gf-confirmation-page-list/gravityforms-confirmation-page-list.php';
require_once WP_PLUGIN_DIR . '/gravityforms/gravityforms.php';
require_once WP_PLUGIN_DIR . '/gravityforms/form_list.php';
require_once WP_PLUGIN_DIR . '/gravityforms/includes/locking/locking.php';


class GForm_Confirmation_Page_Test extends WP_UnitTestCase {
	public function test_add_new_column_as_confirmation_pages() {
		$gf_form_list_table = new GF_Form_List_Table();
		$columns = $gf_form_list_table->get_columns();

		$expected = 'Confirmation Pages';
		$this->assertContains( $expected, $columns );
	}

	public function test_add_new_column_should_use_add_filter() {
		global $wp_filter;

		$this->assertTrue( array_key_exists(
			'show_confirmations_list_for_each_form',
			$wp_filter['gform_form_list_column_confirmation_pages'][ 10 ]
		));
	}

	public function test_show_data_in_new_column_should_use_add_action() {
		global $wp_filter;

		$this->assertTrue( array_key_exists(
			'add_confirmation_pages_column',
			$wp_filter['gform_form_list_columns'][ 10 ]
		));
	}

}
