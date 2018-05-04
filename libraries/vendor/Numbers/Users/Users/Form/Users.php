<?php

namespace Numbers\Users\Users\Form;
class Users extends \Object\Form\Wrapper\Base {
	public $form_link = 'um_users';
	public $module_code = 'UM';
	public $title = 'U/M Users Form';
	public $options = [
		'segment' => self::SEGMENT_FORM,
		'actions' => [
			'refresh' => true,
			'new' => true,
			'back' => true,
			'import' => true
		],
		'include_js' => '/numbers/media_submodules/Numbers_Users_Users_Media_JS_Users.js'
	];
	public $containers = [
		'top' => ['default_row_type' => 'grid', 'order' => 100],
		'tabs' => ['default_row_type' => 'grid', 'order' => 500, 'type' => 'tabs'],
		'tabs2' => ['default_row_type' => 'grid', 'order' => 600, 'type' => 'tabs'],
		'tabs3' => ['default_row_type' => 'grid', 'order' => 600, 'type' => 'tabs'],
		'buttons' => ['default_row_type' => 'grid', 'order' => 900],
		// child containers
		'general_container' => ['default_row_type' => 'grid', 'order' => 32000],
		'contact_container' => ['default_row_type' => 'grid', 'order' => 32100],
		'permissions_container' => ['default_row_type' => 'grid', 'order' => 34000],
		'photo_container' => ['default_row_type' => 'grid', 'order' => 32000],
		'roles_container' => [
			'type' => 'details',
			'details_rendering_type' => 'table',
			'details_new_rows' => 1,
			'details_key' => '\Numbers\Users\Users\Model\User\Roles',
			'details_pk' => ['um_usrrol_role_id'],
			'required' => true,
			'order' => 35000
		],
		'organizations_container' => [
			'type' => 'details',
			'details_rendering_type' => 'table',
			'details_new_rows' => 1,
			'details_key' => '\Numbers\Users\Users\Model\User\Organizations',
			'details_pk' => ['um_usrorg_organization_id'],
			'required' => true,
			'order' => 35001
		],
		'internalization_container' => [
			'type' => 'details',
			'details_11' => true,
			'details_rendering_type' => 'grid_with_label',
			'details_key' => '\Numbers\Users\Users\Model\User\Internalization',
			'details_pk' => ['um_usri18n_user_id'],
			'order' => 35001
		],
		'assignments_container' => [
			'type' => 'details',
			'details_rendering_type' => 'table',
			'details_new_rows' => 0,
			'details_key' => '\Numbers\Users\Users\Model\User\Assignment\Virtual',
			'details_pk' => ['um_usrassign_assignment_code'],
			'details_cannot_delete' => true,
			'details_empty_warning_message' => true,
			'order' => 35002
		],
		'assignments_reverse_container' => [
			'type' => 'details',
			'details_rendering_type' => 'table',
			'details_new_rows' => 0,
			'details_key' => '\Numbers\Users\Users\Model\User\Assignment\Virtual\Reverse',
			'details_pk' => ['um_usrassign_assignment_code'],
			'details_cannot_delete' => true,
			'details_empty_warning_message' => true,
			'order' => 35003
		],
		'postal_codes_assignments_container' => [
			'type' => 'details',
			'details_rendering_type' => 'table',
			'details_new_rows' => 1,
			'details_key' => '\Numbers\Users\Users\Model\User\Assignment\PostalCodes',
			'details_pk' => ['um_usrasspostal_organization_id', 'um_usrasspostal_service_id', 'um_usrasspostal_brand_id', 'um_usrasspostal_location_id'],
			'details_empty_warning_message' => true,
			'order' => 35002
		],
		'territories_assignments_container' => [
			'type' => 'details',
			'details_rendering_type' => 'table',
			'details_new_rows' => 1,
			'details_key' => '\Numbers\Users\Users\Model\User\Assignment\Territories',
			'details_pk' => ['um_usrassterr_organization_id', 'um_usrassterr_service_id', 'um_usrassterr_brand_id'],
			'order' => 35003
		],
		'territories_assignments_container_map' => [
			'label_name' => 'Territories',
			'type' => 'subdetails',
			'details_rendering_type' => 'table',
			'details_new_rows' => 1,
			'details_parent_key' => '\Numbers\Users\Users\Model\User\Assignment\Territories',
			'details_key' => '\Numbers\Users\Users\Model\User\Assignment\Territory\Map',
			'details_pk' => ['um_usrasstrrmap_territory_id'],
			'order' => 35004,
		],
		'locations_assignments_container' => [
			'type' => 'details',
			'details_rendering_type' => 'table',
			'details_new_rows' => 1,
			'details_key' => '\Numbers\Users\Users\Model\User\Assignment\Locations',
			'details_pk' => ['um_usrassloc_organization_id', 'um_usrassloc_service_id', 'um_usrassloc_brand_id'],
			'order' => 35005
		],
		'locations_assignments_container_map' => [
			'label_name' => 'Locations',
			'type' => 'subdetails',
			'details_rendering_type' => 'table',
			'details_new_rows' => 1,
			'details_parent_key' => '\Numbers\Users\Users\Model\User\Assignment\Locations',
			'details_key' => '\Numbers\Users\Users\Model\User\Assignment\Location\Map',
			'details_pk' => ['um_usrasslcnmap_country_code', 'um_usrasslcnmap_province_code', 'um_usrasslcnmap_location_id'],
			'order' => 35006,
		],
		'notifications_container' => [
			'type' => 'details',
			'details_rendering_type' => 'table',
			'details_new_rows' => 1,
			'details_key' => '\Numbers\Users\Users\Model\User\Notifications',
			'details_pk' => ['um_usrnoti_module_id', 'um_usernoti_feature_code'],
			'order' => 35000
		],
		'permissions_container' => [
			'type' => 'details',
			'details_rendering_type' => 'table',
			'details_new_rows' => 1,
			'details_key' => '\Numbers\Users\Users\Model\User\Permissions',
			'details_pk' => ['um_usrperm_resource_id', 'um_usrperm_method_code', 'um_usrperm_action_id'],
			'order' => 35000
		],
		'teams_container' => [
			'type' => 'details',
			'details_rendering_type' => 'table',
			'details_new_rows' => 1,
			'details_key' => '\Numbers\Users\Users\Model\User\Team\Map',
			'details_pk' => ['um_usrtmmap_team_id'],
			'order' => 35000
		],
		'security_answers_container' => [
			'type' => 'details',
			'details_rendering_type' => 'table',
			'details_new_rows' => 1,
			'details_key' => '\Numbers\Users\Users\Model\User\Security\Answers',
			'details_pk' => ['um_usrsecanswer_question_id'],
			'order' => 36000
		],
		// modal
		'google_map_modal' => [
			'default_row_type' => 'grid',
			'order' => 32200,
			'type' => 'modal',
			'label_name' => 'Add new geo service area:'
		],
		'geoarea_assignments_container' => [
			'type' => 'details',
			'details_rendering_type' => 'table',
			'details_new_rows' => 1,
			'details_key' => '\Numbers\Users\Users\Model\User\Assignment\GeoAreas',
			'details_pk' => ['um_usrassgeoarea_id'],
			'details_autoincrement' => ['um_usrassgeoarea_id'],
			'order' => 35003
		],
		'queues_assignments_container' => [
			'type' => 'details',
			'details_rendering_type' => 'table',
			'details_new_rows' => 1,
			'details_key' => '\Numbers\Users\Users\Model\User\Assignment\Queues',
			'details_pk' => ['um_usrassqueue_queue_type_id', 'um_usrassqueue_owner_type_id'],
			'order' => 35004
		],
		'queues_priorities_container' => [
			'label_name' => 'Priorities',
			'type' => 'subdetails',
			'details_rendering_type' => 'table',
			'details_new_rows' => 1,
			'details_parent_key' => '\Numbers\Users\Users\Model\User\Assignment\Queues',
			'details_key' => '\Numbers\Users\Users\Model\Queue\Priorities',
			'details_pk' => ['um_quepriority_service_id', 'um_quepriority_location_id'],
			'order' => 35007,
		],
	];
	public $rows = [
		'top' => [
			'um_user_id' => ['order' => 100],
			'um_user_name' => ['order' => 200],
		],
		'tabs' => [
			'general' => ['order' => 100, 'label_name' => 'General'],
			'login' => ['order' => 200, 'label_name' => 'Login'],
			'organizations' => ['order' => 300, 'label_name' => 'Organizations'],
			'roles' => ['order' => 400, 'label_name' => 'Roles'],
			'photo' => ['order' => 420, 'label_name' => 'Photo'],
			'permissions' => ['order' => 440, 'label_name' => 'Permissions'],
			//'notifications' => ['order' => 450, 'label_name' => 'Notifications'],
			'assignments' => ['order' => 500, 'label_name' => 'Assignments'],
			\Numbers\Countries\Widgets\Addresses\Base::ADDRESSES => \Numbers\Countries\Widgets\Addresses\Base::ADDRESSES_DATA,
			\Numbers\Tenants\Widgets\Attributes\Base::ATTRIBUTES => \Numbers\Tenants\Widgets\Attributes\Base::ATTRIBUTES_DATA,
		],
		'tabs2' => [
			'teams' => ['order' => 50, 'label_name' => 'Teams'],
			'internalization' => ['order' => 100, 'label_name' => 'Internalization']
		],
		'tabs3' => [
			'user_assignments' => ['order' => 100, 'label_name' => 'User Assignments'],
			'postal_code_assignments' => ['order' => 200, 'label_name' => 'Postal Codes'],
			'territories_assignments' => ['order' => 300, 'label_name' => 'Territories', 'acl' => ['ON::TERRITORIES']],
			'locations_assignments' => ['order' => 400, 'label_name' => 'Locations'],
			'geoarea_assignments' => ['order' => 500, 'label_name' => 'Geo Areas', 'acl' => ['SM::POSTGIS']],
			'queues_assignments' => ['order' => 600, 'label_name' => 'Queues'],
		],
	];
	public $elements = [
		'top' => [
			'um_user_id' => [
				'um_user_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'User #', 'domain' => 'user_id_sequence', 'percent' => 50, 'navigation' => true],
				'um_user_code' => ['order' => 2, 'label_name' => 'Code', 'domain' => 'group_code', 'null' => true, 'percent' => 50, 'required' => 'c', 'navigation' => true]
			],
			'um_user_name' => [
				'um_user_name' => ['order' => 1, 'row_order' => 200, 'label_name' => 'Name', 'domain' => 'name', 'percent' => 100, 'required' => 'c'],
			]
		],
		'tabs' => [
			'general' => [
				'general' => ['container' => 'general_container', 'order' => 100],
				'contact' => ['container' => 'contact_container', 'order' => 200]
			],
			'login' => [
				'login' => ['container' => 'login_container', 'order' => 100],
				'security_answers' => ['container' => 'security_answers_container', 'order' => 200],
			],
			'roles' => [
				'roles' => ['container' => 'roles_container', 'order' => 100],
			],
			'organizations' => [
				'organizations' => ['container' => 'organizations_container', 'order' => 100],
			],
			'photo' => [
				'photo' => ['container' => 'photo_container', 'order' => 100],
			],
			'permissions' => [
				'permissions' => ['container' => 'permissions_container', 'order' => 100],
				'notifications' => ['container' => 'notifications_container', 'order' => 200],
			],
			'assignments' => [
				'tabs3' => ['container' => 'tabs3', 'order' => 100],
			]
		],
		'tabs2' => [
			'teams' => [
				'teams' => ['container' => 'teams_container', 'order' => 100],
			],
			'internalization' => [
				'internalization' => ['container' => 'internalization_container', 'order' => 100],
			]
		],
		'tabs3' => [
			'user_assignments' => [
				'user_assignments' => ['container' => 'assignments_container', 'order' => 100],
				'assignments_reverse' => ['container' => 'assignments_reverse_container', 'order' => 200],
			],
			'postal_code_assignments' => [
				'postal_code_assignments' => ['container' => 'postal_codes_assignments_container', 'order' => 100],
			],
			'territories_assignments' => [
				'territories_assignments' => ['container' => 'territories_assignments_container', 'order' => 100],
			],
			'locations_assignments' => [
				'locations_assignments' => ['container' => 'locations_assignments_container', 'order' => 100],
			],
			'geoarea_assignments' => [
				'geoarea_assignments' => ['container' => 'geoarea_assignments_container', 'order' => 100],
			],
			'queues_assignments' => [
				'queues_assignments' => ['container' => 'queues_assignments_container', 'order' => 100],
			]
		],
		'general_container' => [
			'um_user_type_id' => [
				'um_user_type_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Type', 'domain' => 'type_id', 'default' => 10, 'percent' => 20, 'required' => true, 'no_choose' => true, 'method' => 'select', 'options_model' => '\Numbers\Users\Users\Model\User\Types'],
				'\Numbers\Users\Users\Model\User\Group\Map' => ['order' => 2, 'label_name' => 'Groups', 'domain' => 'group_id', 'multiple_column' => 'um_usrgrmap_group_id', 'percent' => 70, 'method' => 'multiselect', 'options_model' => '\Numbers\Users\Users\Model\User\Groups::optionsActive'],
				'um_user_hold' => ['order' => 3, 'label_name' => 'Hold', 'type' => 'boolean', 'percent' => 5],
				'um_user_inactive' => ['order' => 4, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 5]
			],
			'um_user_title' => [
				'um_user_title' => ['order' => 1, 'row_order' => 200, 'label_name' => 'Title', 'domain' => 'personal_title', 'null' => true, 'percent' => 20, 'required' => false, 'method' => 'select', 'options_model' => '\Numbers\Users\Users\Model\User\Titles::optionsActive'],
				'um_user_first_name' => ['order' => 2, 'label_name' => 'First Name', 'domain' => 'personal_name', 'null' => true, 'percent' => 40, 'required' => 'c'],
				'um_user_last_name' => ['order' => 3, 'label_name' => 'Last Name', 'domain' => 'personal_name', 'null' => true, 'percent' => 40, 'required' => 'c'],
			],
			'um_user_company' => [
				'um_user_company' => ['order' => 1, 'row_order' => 300, 'label_name' => 'Company', 'domain' => 'name', 'null' => true, 'percent' => 100, 'required' => 'c'],
			],
			'separator_1' => [
				self::SEPARATOR_HORIZONTAL => ['order' => 1, 'row_order' => 350, 'label_name' => 'Operating Location', 'icon' => 'far fa-flag', 'percent' => 100],
			],
			'um_user_operating_country_code' => [
				'um_user_operating_country_code' => ['order' => 1, 'row_order' => 360, 'label_name' => 'Operating Country', 'domain' => 'country_code', 'null' => true, 'method' => 'select', 'options_model' => '\Numbers\Countries\Countries\Model\Countries::optionsActive', 'onchange' => 'this.form.submit();'],
				'um_user_operating_province_code' => ['order' => 2, 'label_name' => 'Operating Province', 'domain' => 'province_code', 'null' => true, 'method' => 'select', 'options_model' => '\Numbers\Countries\Countries\Model\Provinces::optionsActive', 'options_depends' => ['cm_province_country_code' => 'um_user_operating_country_code']],
			],
			'separator_2' => [
				self::SEPARATOR_HORIZONTAL => ['order' => 1, 'row_order' => 400, 'label_name' => 'Contact Information', 'icon' => 'far fa-envelope', 'percent' => 100],
			],
			'um_user_email' => [
				'um_user_email' => ['order' => 1, 'row_order' => 500, 'label_name' => 'Primary Email', 'domain' => 'email', 'null' => true, 'percent' => 50, 'required' => false],
				'um_user_email2' => ['order' => 2, 'label_name' => 'Secondary Email', 'domain' => 'email', 'null' => true, 'percent' => 50, 'required' => false],
			],
			'um_user_phone' => [
				'um_user_phone' => ['order' => 1, 'row_order' => 600, 'label_name' => 'Primary Phone', 'domain' => 'phone', 'null' => true, 'percent' => 50, 'required' => false],
				'um_user_phone2' => ['order' => 2, 'label_name' => 'Secondary Phone', 'domain' => 'phone', 'null' => true, 'percent' => 50, 'required' => false],
			],
			'um_user_cell' => [
				'um_user_cell' => ['order' => 1, 'row_order' => 700, 'label_name' => 'Cell Phone', 'domain' => 'phone', 'null' => true, 'percent' => 50, 'required' => false],
				'um_user_fax' => ['order' => 2, 'label_name' => 'Fax', 'domain' => 'phone', 'null' => true, 'percent' => 50, 'required' => false],
			],
			self::HIDDEN => [
				'um_user_numeric_phone' => ['label_name' => 'Primary Phone (Numeric)', 'domain' => 'numeric_phone', 'null' => true],
			]
		],
		'login_container' => [
			'um_user_login_enabled' => [
				'um_user_login_enabled' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Login Enabled', 'type' => 'boolean', 'percent' => 50, 'skip_during_export' => true],
				'um_user_login_username' => ['order' => 2, 'label_name' => 'Username', 'domain' => 'login', 'null' => true, 'percent' => 50, 'required' => 'c', 'skip_during_export' => true]
			],
			'um_user_login_last_set' => [
				'um_user_login_last_set' => ['order' => 1, 'row_order' => 200, 'label_name' => 'Password Last Changed', 'type' => 'date', 'persistent' => true, 'method' => 'calendar', 'calendar_icon' => 'right', 'percent' => 50, 'readonly' => true, 'skip_during_export' => true],
				'um_user_login_password_new' => ['order' => 2, 'label_name' => 'Reset Password', 'domain' => 'password', 'method' => 'password', 'percent' => 50, 'required' => false, 'empty_value' => true, 'skip_during_export' => true]
			]
		],
		'security_answers_container' => [
			'row1' => [
				'um_usrsecanswer_question_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Question', 'domain' => 'group_id', 'null' => true, 'details_unique_select' => true, 'percent' => 75, 'required' => true, 'method' => 'select', 'options_model' => '\Numbers\Users\Users\Model\Security\Questions::optionsActive'],
				'um_usrsecanswer_answer' => ['order' => 2, 'label_name' => 'Answer', 'type' => 'text', 'null' => true, 'percent' => 25, 'required' => true],
			]
		],
		'internalization_container' => [
			'um_usri18n_group_id' => [
				'um_usri18n_group_id' => ['order' => 1, 'row_order' => 300, 'label_name' => 'Group', 'domain' => 'group_id', 'null' => true, 'percent' => 100, 'method' => 'select', 'options_model' => '\Numbers\Internalization\Internalization\Model\Groups::optionsActive'],
			],
			'um_usri18n_language_code' => [
				'um_usri18n_language_code' => ['order' => 1, 'row_order' => 300, 'label_name' => 'Language', 'domain' => 'language_code', 'null' => true, 'percent' => 50, 'method' => 'select', 'options_model' => '\Numbers\Internalization\Internalization\Model\Language\Codes::optionsActive'],
				'um_usri18n_locale_code' => ['order' => 2, 'label_name' => 'Locale', 'domain' => 'locale_code', 'null' => true, 'percent' => 50, 'method' => 'select', 'options_model' => '\Numbers\Internalization\Internalization\Model\Locales::optionsActive'],
			],
			'um_usri18n_timezone_code' => [
				'um_usri18n_timezone_code' => ['order' => 1, 'row_order' => 400, 'label_name' => 'Timezone', 'domain' => 'timezone_code', 'null' => true, 'percent' => 50, 'method' => 'select', 'options_model' => '\Numbers\Internalization\Internalization\Model\Timezones::optionsActive'],
				'um_usri18n_organization_id' => ['order' => 2, 'label_name' => 'Organization', 'domain' => 'organization_id', 'null' => true, 'percent' => 50, 'method' => 'select', 'options_model' => '\Numbers\Users\Organizations\DataSource\Organizations::optionsActive'],
			],
			'format' => [
				self::SEPARATOR_HORIZONTAL => ['order' => 100, 'row_order' => 500, 'label_name' => 'Format', 'icon' => 'far fa-hourglass', 'percent' => 100],
			],
			'um_usri18n_format_date' => [
				'um_usri18n_format_date' => ['order' => 1, 'row_order' => 600, 'label_name' => 'Date Format', 'domain' => 'code', 'null' => true, 'percent' => 25, 'placeholder' => 'Y-m-d', 'description' => 'Y - year, m - month, d - day'],
				'um_usri18n_format_time' => ['order' => 2, 'label_name' => 'Time Format', 'domain' => 'code', 'null' => true, 'percent' => 25, 'placeholder' => 'H:i:s', 'description' => 'H - hour, i - minute, s = second, g - short hour, a - am/pm'],
				'um_usri18n_format_datetime' => ['order' => 3, 'label_name' => 'Datetime Format', 'domain' => 'code', 'null' => true, 'percent' => 25, 'placeholder' => 'Y-m-d H:i:s', 'description' => 'Y - year, m - month, d - day, H - hour, i - minute, s = second, g - short hour, a - am/pm'],
				'um_usri18n_format_timestamp' => ['order' => 4, 'label_name' => 'Timestamp Format', 'domain' => 'code', 'null' => true, 'percent' => 25, 'placeholder' => 'Y-m-d H:i:s.u', 'description' => 'Y - year, m - month, d - day, H - hour, i - minute, s = second, g - short hour, a - am/pm, u - miliseconds']
			],
			'um_usri18n_format_uom' => [
				'um_usri18n_format_uom' => ['order' => 1, 'row_order' => 650, 'label_name' => 'Unit of Measures', 'domain' => 'group_code', 'null' => true, 'default' => 'METRIC', 'method' => 'select', 'options_model' => '\Object\Format\UoM'],
			],
			'um_usri18n_format_amount_frm' => [
				'um_usri18n_format_amount_frm' => ['order' => 1, 'row_order' => 700, 'label_name' => 'Amounts In Forms', 'domain' => 'type_id', 'null' => true, 'method' => 'select', 'options_model' => '\Object\Format\Amounts'],
				'um_usri18n_format_amount_fs' => ['order' => 2, 'label_name' => 'Amounts In Financial Statement', 'domain' => 'type_id', 'null' => true, 'method' => 'select', 'options_model' => '\Object\Format\Amounts']
			],
			'print' => [
				self::SEPARATOR_HORIZONTAL => ['order' => 100, 'row_order' => 800, 'label_name' => 'Print', 'icon' => 'fas fa-print', 'percent' => 100],
			],
			'um_usri18n_print_format' => [
				'um_usri18n_print_format' => ['order' => 1, 'row_order' => 900, 'label_name' => 'Print Format', 'domain' => 'code', 'null' => true, 'method' => 'select', 'options_model' => '\Numbers\Internalization\Internalization\Model\Print2\Formats::options'],
				'um_usri18n_print_font' => ['order' => 2, 'label_name' => 'Print Font', 'domain' => 'code', 'null' => true, 'method' => 'select', 'options_model' => '\Numbers\Internalization\Internalization\Model\Print2\Fonts::options'],
			]
		],
		'roles_container' => [
			'row1' => [
				'um_usrrol_role_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Role', 'domain' => 'role_id', 'required' => true, 'null' => true, 'details_unique_select' => true, 'percent' => 95, 'method' => 'select', 'options_model' => '\Numbers\Users\Users\DataSource\Roles', 'onchange' => 'this.form.submit();'],
				'um_usrrol_inactive' => ['order' => 2, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 5]
			]
		],
		'organizations_container' => [
			'row1' => [
				'um_usrorg_organization_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Organization', 'domain' => 'organization_id', 'required' => true, 'null' => true, 'details_unique_select' => true, 'percent' => 80, 'method' => 'select', 'options_model' => '\Numbers\Users\Organizations\DataSource\Organizations::optionsActive', 'onchange' => 'this.form.submit();'],
				'um_usrorg_primary' => ['order' => 2, 'label_name' => 'Primary', 'type' => 'boolean', 'percent' => 15],
				'um_usrorg_inactive' => ['order' => 3, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 5]
			]
		],
		'photo_container' => [
			'__logo_upload' => [
				'__logo_upload' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Upload Photo', 'type' => 'mixed', 'method' => 'file', 'validator_method' => '\Numbers\Users\Documents\Base\Validator\Files::validate', 'validator_params' => ['types' => ['images'], 'image_size' => '250x250', 'thumbnail_size' => '50x50'], 'description' => 'Extensions: ' . \Numbers\Users\Documents\Base\Helper\Validate::IMAGE_EXTENSIONS . '. Size: 250x250.', 'skip_during_export' => true],
			],
			'__logo_preview' => [
				'__logo_preview' => ['order' => 1, 'row_order' => 200, 'label_name' => 'Preview Photo', 'custom_renderer' => '\Numbers\Users\Documents\Base\Helper\Preview::renderPreview', 'preview_file_id' => 'um_user_photo_file_id', 'skip_during_export' => true],
			],
			self::HIDDEN => [
				'um_user_photo_file_id' => ['label_name' => 'Logo File #', 'domain' => 'file_id', 'null' => true, 'method' => 'hidden', 'skip_during_export' => true],
			]
		],
		'assignments_container' => [
			'row1' => [
				'um_usrassign_assignment_code' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Assignment Type', 'domain' => 'type_code', 'readonly' => true, 'percent' => 85, 'method' => 'select', 'options_model' => '\Numbers\Users\Users\Model\User\Assignment\Types'],
				'um_usrassign_multiple' => ['order' => 3, 'label_name' => 'Multiple', 'type' => 'boolean', 'readonly' => true, 'percent' => 15],
			],
			'row2' => [
				'um_usrassign_child_user_id' => ['order' => 1, 'row_order' => 200, 'label_name' => 'User(s)', 'domain' => 'user_id', 'multiple_column' => 'um_usrassign_child_user_id', 'percent' => 100, 'method' => 'multiselect', 'searchable' => true, 'options_model' => '\Numbers\Users\Users\DataSource\Users::optionsActive', 'options_depends' => ['selected_roles' => 'um_usrassign_child_role_id'], 'options_params' => ['skip_acl' => true]]
			],
			self::HIDDEN => [
				'um_usrassign_parent_role_id' => ['order' => 1, 'row_order' => 200, 'label_name' => 'Parent Role #', 'domain' => 'role_id'],
				'um_usrassign_child_role_id' => ['order' => 2, 'label_name' => 'Child Role #', 'domain' => 'role_id'],
				'um_usrassign_mandatory' => ['order' => 2, 'label_name' => 'Mandatory', 'type' => 'boolean', 'readonly' => true, 'percent' => 5],
			]
		],
		'assignments_reverse_container' => [
			'row1' => [
				'um_usrassign_assignment_code' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Assignment Type', 'domain' => 'type_code', 'readonly' => true, 'percent' => 70, 'method' => 'select', 'options_model' => '\Numbers\Users\Users\Model\User\Assignment\Types'],
				'um_usrassign_mandatory' => ['order' => 2, 'label_name' => 'Mandatory', 'type' => 'boolean', 'readonly' => true, 'percent' => 15],
				'um_usrassign_multiple' => ['order' => 3, 'label_name' => 'Multiple', 'type' => 'boolean', 'readonly' => true, 'percent' => 15],
			],
			'row2' => [
				'um_usrassign_parent_user_id' => ['order' => 1, 'row_order' => 200, 'label_name' => 'User(s)', 'domain' => 'user_id', 'multiple_column' => 'um_usrassign_parent_user_id', 'percent' => 100, 'method' => 'multiselect', 'searchable' => true, 'options_model' => '\Numbers\Users\Users\DataSource\Users::optionsActive', 'options_depends' => ['selected_roles' => 'um_usrassign_parent_role_id'], 'options_params' => ['skip_acl' => true]]
			],
			self::HIDDEN => [
				'um_usrassign_parent_role_id' => ['order' => 1, 'row_order' => 300, 'label_name' => 'Parent Role #', 'domain' => 'role_id', 'method' => 'hidden'],
				'um_usrassign_child_role_id' => ['order' => 2, 'label_name' => 'Child Role #', 'domain' => 'role_id', 'method' => 'hidden'],
			]
		],
		'postal_codes_assignments_container' => [
			'row1' => [
				'um_usrasspostal_service_id' => ['order' => 1, 'row_order' => 100, 'order_for_defaults' => 31000, 'label_name' => 'Service', 'domain' => 'service_id', 'null' => true, 'required' => true, 'percent' => 50, 'method' => 'select', 'options_model' => '\Numbers\Users\Organizations\Model\Services::optionsActive', 'options_params' => ['on_service_assignment_type_id' => 20], 'onchange' => 'this.form.submit();'],
				'um_usrasspostal_brand_id' => ['order' => 2, 'order_for_defaults' => 31100, 'label_name' => 'Brand', 'domain' => 'brand_id', 'null' => true, 'required' => true, 'percent' => 45, 'method' => 'select', 'options_model' => '\Numbers\Users\Organizations\Model\Brands::optionsActive', 'onchange' => 'this.form.submit();'],
				'um_usrasspostal_inactive' => ['order' => 3, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 5]
			],
			'row2' => [
				'um_usrasspostal_location_id' => ['order' => 1, 'row_order' => 200, 'order_for_defaults' => 33000, 'label_name' => 'Location', 'domain' => 'location_id', 'null' => true, 'required' => true, 'percent' => 50, 'method' => 'select', 'options_model' => '\Numbers\Users\Organizations\Model\Locations::optionsActive', 'options_depends' => ['on_location_organization_id' => 'um_usrasspostal_organization_id']],
				'um_usrasspostal_postal_codes' => ['order' => 2, 'label_name' => 'Postal Codes', 'domain' => 'postal_codes', 'null' => true, 'required' => true, 'percent' => 50, 'method' => 'textarea'],
			],
			self::HIDDEN => [
				'um_usrasspostal_organization_id' => ['order' => 1, 'row_order' => 300, 'order_for_defaults' => 32000,'label_name' => 'Organization', 'domain' => 'organization_id', 'null' => true, 'default' => 'dependent::101', 'method' => 'hidden'],
			]
		],
		'territories_assignments_container' => [
			'row1' => [
				'um_usrassterr_service_id' => ['order' => 1, 'row_order' => 100, 'order_for_defaults' => 31000, 'label_name' => 'Service', 'domain' => 'service_id', 'null' => true, 'required' => true, 'percent' => 50, 'method' => 'select', 'options_model' => '\Numbers\Users\Organizations\Model\Services::optionsActive', 'options_params' => ['on_service_assignment_type_id' => [13, 17]], 'onchange' => 'this.form.submit();'],
				'um_usrassterr_brand_id' => ['order' => 2, 'order_for_defaults' => 31100, 'label_name' => 'Brand', 'domain' => 'brand_id', 'null' => true, 'required' => true, 'percent' => 50, 'method' => 'select', 'options_model' => '\Numbers\Users\Organizations\Model\Brands::optionsActive', 'onchange' => 'this.form.submit();'],
				'um_usrassterr_inactive' => ['order' => 4, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 5]
			],
			self::HIDDEN => [
				'um_usrassterr_organization_id' => ['order' =>1, 'row_order' => 200, 'order_for_defaults' => 32000,'label_name' => 'Organization', 'domain' => 'organization_id', 'null' => true, 'default' => 'dependent::101', 'method' => 'hidden'],
			]
		],
		'territories_assignments_container_map' => [
			'row1' => [
				'um_usrasstrrmap_territory_id' => ['order' => 1, 'row_order' => 100, 'order_for_defaults' => 31000, 'label_name' => 'Territory', 'domain' => 'territory_id', 'null' => true, 'required' => true, 'details_unique_select' => true, 'percent' => 85, 'method' => 'select', 'tree' => true, 'searchable' => true, 'options_model' => '\Numbers\Users\Organizations\Model\Location\Territories::optionsGroupped', 'onchange' => 'this.form.submit();'],
				'um_usrasstrrmap_inactive' => ['order' => 2, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 15]
			]
		],
		'locations_assignments_container' => [
			'row1' => [
				'um_usrassloc_service_id' => ['order' => 1, 'row_order' => 100, 'order_for_defaults' => 31000, 'label_name' => 'Service', 'domain' => 'service_id', 'null' => true, 'required' => true, 'percent' => 50, 'method' => 'select', 'options_model' => '\Numbers\Users\Organizations\Model\Services::optionsActive', 'options_params' => ['on_service_assignment_type_id' => 30], 'onchange' => 'this.form.submit();'],
				'um_usrassloc_brand_id' => ['order' => 2, 'order_for_defaults' => 31100, 'label_name' => 'Brand', 'domain' => 'brand_id', 'null' => true, 'required' => true, 'percent' => 50, 'method' => 'select', 'options_model' => '\Numbers\Users\Organizations\Model\Brands::optionsActive', 'onchange' => 'this.form.submit();'],
				'um_usrassloc_inactive' => ['order' => 3, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 5]
			],
			self::HIDDEN => [
				'um_usrassloc_organization_id' => ['order' =>1, 'row_order' => 200, 'order_for_defaults' => 32000,'label_name' => 'Organization', 'domain' => 'organization_id', 'null' => true, 'default' => 'dependent::101', 'method' => 'hidden'],
			]
		],
		'locations_assignments_container_map' => [
			'row1' => [
				'um_usrasslcnmap_country_code' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Country', 'domain' => 'country_code', 'null' => true, 'required' => true, 'percent' => 50, 'method' => 'select', 'options_model' => '\Numbers\Countries\Countries\Model\Countries::optionsActive', 'onchange' => 'this.form.submit();'],
				'um_usrasslcnmap_province_code' => ['order' => 2, 'label_name' => 'Province', 'domain' => 'province_code', 'null' => true, 'required' => true, 'percent' => 45, 'method' => 'select', 'options_model' => '\Numbers\Countries\Countries\Model\Provinces::optionsActive', 'options_depends' => ['cm_province_country_code' => 'um_usrasslcnmap_country_code'], 'onchange' => 'this.form.submit();'],
				'um_usrasslcnmap_inactive' => ['order' => 3, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 5]
			],
			'row2' => [
				'um_usrasslcnmap_location_id' => ['order' => 1, 'row_order' => 200, 'label_name' => 'Location', 'domain' => 'location_id', 'null' => true, 'required' => true, 'percent' => 100, 'method' => 'select', 'options_model' => '\Numbers\Users\Organizations\Model\Locations::optionsActive', 'options_depends' => ['on_location_country_code' => 'um_usrasslcnmap_country_code', 'on_location_province_code' => 'um_usrasslcnmap_province_code']],
			]
		],
		'notifications_container' => [
			'row1' => [
				'um_usrnoti_module_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Notification', 'domain' => 'module_id', 'required' => true, 'details_unique_select' => true, 'null' => true, 'percent' => 95, 'placeholder' => 'Notification', 'method' => 'select', 'options_model' => '\Numbers\Tenants\Tenants\DataSource\Module\Features::optionsJson', 'options_params' => ['sm_feature_type' => 20], 'tree' => true, 'searchable' => true, 'onchange' => 'this.form.submit();', 'json_contains' => ['module_id' => 'um_usrnoti_module_id', 'feature_code' => 'um_usrnoti_feature_code']],
				'um_usrnoti_inactive' => ['order' => 2, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 5]
			],
			self::HIDDEN => [
				'um_usrnoti_feature_code' => ['order' => 4, 'label_name' => 'Feature', 'domain' => 'feature_code', 'required' => true, 'null' => true, 'method' => 'hidden']
			]
		],
		'permissions_container' => [
			'row1' => [
				'um_usrperm_resource_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Resource', 'domain' => 'resource_id', 'required' => true, 'null' => true, 'percent' => 60, 'method' => 'select', 'options_model' => '\Numbers\Users\Users\DataSource\ACL\Controllers2::optionsJson', 'options_params' => ['sm_resource_acl_permission' => 1, 'acl_handle_exceptions' => true], 'tree' => true, 'searchable' => true, 'onchange' => 'this.form.submit();', 'json_contains' => ['module_id' => 'um_usrperm_module_id', 'resource_id' => 'um_usrperm_resource_id']],
				'um_usrperm_action_id' => ['order' => 2, 'label_name' => 'Action', 'domain' => 'action_id', 'required' => true, 'null' => true, 'percent' => 35, 'method' => 'select', 'options_model' => '\Numbers\Backend\System\Modules\DataSource\Resource\Map::optionsJson', 'options_depends' => ['sm_rsrcmp_resource_id' => 'um_usrperm_resource_id'], 'tree' => true, 'searchable' => true, 'onchange' => 'this.form.submit();', 'json_contains' => ['action_id' => 'um_usrperm_action_id', 'method_code' => 'um_usrperm_method_code']],
				'um_usrperm_inactive' => ['order' => 3, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 5]
			],
			self::HIDDEN => [
				'um_usrperm_method_code' => ['order' => 1, 'label_name' => 'Method', 'domain' => 'code', 'required' => true, 'null' => true, 'method' => 'hidden'],
				'um_usrperm_module_id' => ['order' => 2, 'label_name' => 'Module #', 'domain' => 'module_id', 'required' => true, 'null' => true, 'method' => 'hidden'],
			]
		],
		'teams_container' => [
			'row1' => [
				'um_usrtmmap_team_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Team', 'domain' => 'team_id', 'required' => true, 'null' => true, 'details_unique_select' => true, 'percent' => 50, 'method' => 'select', 'options_model' => '\Numbers\Users\Users\Model\User\Teams', 'onchange' => 'this.form.submit();'],
				'um_usrtmmap_role_id' => ['order' => 2, 'label_name' => 'Role', 'domain' => 'role_id', 'null' => true, 'percent' => 45, 'required' => true, 'method' => 'select', 'options_model' => '\Numbers\Users\Users\Model\User\Team\Roles::optionsActive'],
				'um_usrtmmap_inactive' => ['order' => 3, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 5]
			]
		],
		'geoarea_assignments_container' => [
			'row1' => [
				'um_usrassgeoarea_service_id' => ['order' => 1, 'row_order' => 100, 'order_for_defaults' => 31000, 'label_name' => 'Service', 'domain' => 'service_id', 'null' => true, 'required' => true, 'percent' => 50, 'method' => 'select', 'options_model' => '\Numbers\Users\Organizations\Model\Services::optionsActive', 'options_params' => ['on_service_assignment_type_id' => 40], 'onchange' => 'this.form.submit();'],
				'um_usrassgeoarea_brand_id' => ['order' => 2, 'order_for_defaults' => 31100, 'label_name' => 'Brand', 'domain' => 'brand_id', 'null' => true, 'required' => true, 'percent' => 50, 'method' => 'select', 'options_model' => '\Numbers\Users\Organizations\Model\Brands::optionsActive', 'onchange' => 'this.form.submit();'],
				'um_usrassgeoarea_inactive' => ['order' => 3, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 5]
			],
			'row2' => [
				'um_usrassgeoarea_location_id' => ['order' => 1, 'row_order' => 150, 'label_name' => 'Location', 'domain' => 'location_id', 'null' => true, 'required' => true, 'percent' => 70, 'method' => 'select', 'options_model' => '\Numbers\Users\Organizations\Model\Locations::optionsActive'],
				'show_google_map' => ['order' => 2, 'label_name' => null, 'percent' => 30, 'value' => 'Draw Area', 'method' => 'button', 'onclick' => 'Numbers.Modal.show(\'form_um_users_modal_google_map_modal_dialog\'); Numbers.NumbersUsersUsersFormUsers.initialize(this);'],
			],
			self::HIDDEN => [
				'um_usrassgeoarea_organization_id' => ['order' => 1, 'order_for_defaults' => 32000, 'label_name' => 'Organization', 'domain' => 'organization_id', 'null' => true, 'default' => 'dependent::101', 'method' => 'hidden'],
				'um_usrassgeoarea_polygon' => ['order' => 2, 'label_name' => 'Polygon', 'type' => 'geometry', 'null' => true, 'required' => true, 'class' => 'um_usrassgeoarea_polygon'],
				'um_usrassgeoarea_polygon__geometry' => ['order' => 3, 'label_name' => 'Polygon (JSON)', 'type' => 'geometry', 'null' => true, 'required' => true, 'class' => 'um_usrassgeoarea_polygon__geometry'],
			]
		],
		'google_map_modal' => [
			'google_map_div' => [
				'google_map_div' => ['order' => 1, 'row_order' => 100, 'label_name' => null, 'percent' => 100, 'method' => 'div', 'style' => 'height: 500px;']
			],
			'buttons' => [
				self::BUTTON_SUBMIT_OTHER => self::BUTTON_SUBMIT_OTHER_DATA + ['row_order' => 32000, 'onclick' => 'Numbers.NumbersUsersUsersFormUsers.setPolygon(); Numbers.Modal.hide(\'form_um_users_modal_google_map_modal_dialog\'); return false;'],
				'__remove_selected_polygon' => ['order' => 32000, 'button_group' => 'right', 'value' => 'Delete', 'type' => 'danger', 'method' => 'button2', 'icon' => 'far fa-trash-alt', 'class' => 'float-right', 'onclick' => 'Numbers.NumbersUsersUsersFormUsers.deleteSelectedShape(); return false;']
			]
		],
		'queues_assignments_container' => [
			'row1' => [
				'um_usrassqueue_queue_type_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Queue Type', 'domain' => 'type_id', 'null' => true, 'required' => true, 'percent' => 50, 'method' => 'select', 'options_model' => '\Numbers\Users\Organizations\Model\Queue\Types', 'onchange' => 'this.form.submit();'],
				'um_usrassqueue_owner_type_id' => ['order' => 2, 'label_name' => 'Owner Type', 'domain' => 'type_id', 'null' => true, 'required' => true, 'percent' => 45, 'method' => 'select', 'options_model' => '\Numbers\Users\Organizations\Model\Queue\OwnerTypes', 'onchange' => 'this.form.submit();'],
				'um_usrassqueue_inactive' => ['order' => 3, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 5]
			]
		],
		'queues_priorities_container' => [
			'row1' => [
				'um_quepriority_service_id' => ['order' => 1, 'row_order' => 100, 'order_for_defaults' => 31000, 'label_name' => 'Service', 'domain' => 'service_id', 'null' => true, 'required' => true, 'percent' => 85, 'method' => 'select', 'options_model' => '\Numbers\Users\Organizations\Model\Services::optionsActive', 'onchange' => 'this.form.submit();'],
				'um_quepriority_inactive' => ['order' => 2, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 15]
			],
			'row2' => [
				'um_quepriority_location_id' => ['order' => 1, 'row_order' => 200, 'label_name' => 'Location', 'domain' => 'location_id', 'null' => true, 'required' => true, 'percent' => 70, 'method' => 'select', 'options_model' => '\Numbers\Users\Organizations\Model\Locations::optionsActive', 'onchange' => 'this.form.submit();'],
				'um_quepriority_priority' => ['order' => 2, 'label_name' => 'Priority', 'domain' => 'percent', 'null' => true, 'percent' => 30],
			]
		],
		'buttons' => [
			self::BUTTONS => self::BUTTONS_DATA_GROUP
		]
	];
	public $collection = [
		'name' => 'Users',
		'model' => '\Numbers\Users\Users\Model\Users',
		'acl_datasource' => '\Numbers\Users\Users\DataSource\Users',
		'acl_parameters' => [
			'only_id_column' => true
		],
		'details' => [
			'\Numbers\Users\Users\Model\User\Group\Map' => [
				'name' => 'Groups',
				'pk' => ['um_usrgrmap_tenant_id', 'um_usrgrmap_user_id', 'um_usrgrmap_group_id'],
				'type' => '1M',
				'map' => ['um_user_tenant_id' => 'um_usrgrmap_tenant_id', 'um_user_id' => 'um_usrgrmap_user_id']
			],
			'\Numbers\Users\Users\Model\User\Team\Map' => [
				'name' => 'Groups',
				'pk' => ['um_usrtmmap_tenant_id', 'um_usrtmmap_user_id', 'um_usrtmmap_team_id'],
				'type' => '1M',
				'map' => ['um_user_tenant_id' => 'um_usrtmmap_tenant_id', 'um_user_id' => 'um_usrtmmap_user_id']
			],
			'\Numbers\Users\Users\Model\User\Roles' => [
				'name' => 'Roles',
				'pk' => ['um_usrrol_tenant_id', 'um_usrrol_user_id', 'um_usrrol_role_id'],
				'type' => '1M',
				'map' => ['um_user_tenant_id' => 'um_usrrol_tenant_id', 'um_user_id' => 'um_usrrol_user_id']
			],
			'\Numbers\Users\Users\Model\User\Organizations' => [
				'name' => 'Organizations',
				'pk' => ['um_usrorg_tenant_id', 'um_usrorg_user_id', 'um_usrorg_organization_id'],
				'type' => '1M',
				'map' => ['um_user_tenant_id' => 'um_usrorg_tenant_id', 'um_user_id' => 'um_usrorg_user_id']
			],
			'\Numbers\Users\Users\Model\User\Internalization' => [
				'name' => 'Internalization',
				'pk' => ['um_usri18n_tenant_id', 'um_usri18n_user_id'],
				'type' => '11',
				'map' => ['um_user_tenant_id' => 'um_usri18n_tenant_id', 'um_user_id' => 'um_usri18n_user_id']
			],
			'\Numbers\Users\Users\Model\User\Assignments' => [
				'name' => 'User Assignments',
				'pk' => ['um_usrassign_tenant_id', 'um_usrassign_assignment_code', 'um_usrassign_parent_user_id', 'um_usrassign_child_user_id'],
				'type' => '1M',
				'map' => ['um_user_tenant_id' => 'um_usrassign_tenant_id', 'um_user_id' => 'um_usrassign_parent_user_id']
			],
			'\Numbers\Users\Users\Model\User\Assignment\Reverse' => [
				'name' => 'User Assignments (Reverse)',
				'pk' => ['um_usrassign_tenant_id', 'um_usrassign_assignment_code', 'um_usrassign_parent_user_id', 'um_usrassign_child_user_id'],
				'type' => '1M',
				'map' => ['um_user_tenant_id' => 'um_usrassign_tenant_id', 'um_user_id' => 'um_usrassign_child_user_id']
			],
			'\Numbers\Users\Users\Model\User\Assignment\PostalCodes' => [
				'name' => 'Postal Code Assignments',
				'pk' => ['um_usrasspostal_tenant_id', 'um_usrasspostal_user_id', 'um_usrasspostal_organization_id', 'um_usrasspostal_service_id', 'um_usrasspostal_brand_id', 'um_usrasspostal_location_id'],
				'type' => '1M',
				'map' => ['um_user_tenant_id' => 'um_usrasspostal_tenant_id', 'um_user_id' => 'um_usrasspostal_user_id']
			],
			'\Numbers\Users\Users\Model\User\Assignment\Territories' => [
				'name' => 'Territories Assignments',
				'acl' => ['ON::TERRITORIES'],
				'pk' => ['um_usrassterr_tenant_id', 'um_usrassterr_user_id', 'um_usrassterr_organization_id', 'um_usrassterr_service_id', 'um_usrassterr_brand_id'],
				'type' => '1M',
				'map' => ['um_user_tenant_id' => 'um_usrassterr_tenant_id', 'um_user_id' => 'um_usrassterr_user_id'],
				'details' => [
					'\Numbers\Users\Users\Model\User\Assignment\Territory\Map' => [
						'name' => 'Territory Map Assignments',
						'pk' => ['um_usrasstrrmap_tenant_id', 'um_usrasstrrmap_user_id', 'um_usrasstrrmap_organization_id', 'um_usrasstrrmap_service_id', 'um_usrasstrrmap_brand_id', 'um_usrasstrrmap_territory_id'],
						'type' => '1M',
						'map' => ['um_usrassterr_tenant_id' => 'um_usrasstrrmap_tenant_id', 'um_usrassterr_user_id' => 'um_usrasstrrmap_user_id', 'um_usrassterr_organization_id' => 'um_usrasstrrmap_organization_id', 'um_usrassterr_service_id' => 'um_usrasstrrmap_service_id', 'um_usrassterr_brand_id' => 'um_usrasstrrmap_brand_id'],
					]
				]
			],
			'\Numbers\Users\Users\Model\User\Assignment\Locations' => [
				'name' => 'Locations Assignments',
				'pk' => ['um_usrassloc_tenant_id', 'um_usrassloc_user_id', 'um_usrassloc_organization_id', 'um_usrassloc_service_id', 'um_usrassloc_brand_id'],
				'type' => '1M',
				'map' => ['um_user_tenant_id' => 'um_usrassloc_tenant_id', 'um_user_id' => 'um_usrassloc_user_id'],
				'details' => [
					'\Numbers\Users\Users\Model\User\Assignment\Location\Map' => [
						'name' => 'Location Map Assignments',
						'pk' => ['um_usrasslcnmap_tenant_id', 'um_usrasslcnmap_user_id', 'um_usrasslcnmap_organization_id', 'um_usrasslcnmap_service_id', 'um_usrasslcnmap_brand_id', 'um_usrasslcnmap_country_code', 'um_usrasslcnmap_province_code', 'um_usrasslcnmap_location_id'],
						'type' => '1M',
						'map' => ['um_usrassloc_tenant_id' => 'um_usrasslcnmap_tenant_id', 'um_usrassloc_user_id' => 'um_usrasslcnmap_user_id', 'um_usrassloc_organization_id' => 'um_usrasslcnmap_organization_id', 'um_usrassloc_service_id' => 'um_usrasslcnmap_service_id', 'um_usrassloc_brand_id' => 'um_usrasslcnmap_brand_id'],
					]
				]
			],
			'\Numbers\Users\Users\Model\User\Assignment\GeoAreas' => [
				'name' => 'Geo Areas Assignments',
				'acl' => ['SM::POSTGIS'],
				'pk' => ['um_usrassgeoarea_tenant_id', 'um_usrassgeoarea_user_id', 'um_usrassgeoarea_id'],
				'type' => '1M',
				'map' => ['um_user_tenant_id' => 'um_usrassgeoarea_tenant_id', 'um_user_id' => 'um_usrassgeoarea_user_id'],
			],
			'\Numbers\Users\Users\Model\User\Assignment\Queues' => [
				'name' => 'Queues',
				'pk' => ['um_usrassqueue_tenant_id', 'um_usrassqueue_user_id', 'um_usrassqueue_queue_type_id', 'um_usrassqueue_owner_type_id'],
				'type' => '1M',
				'map' => ['um_user_tenant_id' => 'um_usrassqueue_tenant_id', 'um_user_id' => 'um_usrassqueue_user_id'],
				'details' => [
					'\Numbers\Users\Users\Model\Queue\Priorities' => [
						'name' => 'Queue Priorities',
						'pk' => ['um_quepriority_tenant_id', 'um_quepriority_user_id', 'um_quepriority_queue_type_id', 'um_quepriority_owner_type_id', 'um_quepriority_service_id', 'um_quepriority_location_id'],
						'type' => '1M',
						'map' => ['um_usrassqueue_tenant_id' => 'um_quepriority_tenant_id', 'um_usrassqueue_user_id' => 'um_quepriority_user_id', 'um_usrassqueue_queue_type_id' => 'um_quepriority_queue_type_id', 'um_usrassqueue_owner_type_id' => 'um_quepriority_owner_type_id'],
					]
				]
			],
			'\Numbers\Users\Users\Model\User\Notifications' => [
				'name' => 'Notifications',
				'pk' => ['um_usrnoti_tenant_id', 'um_usrnoti_user_id', 'um_usrnoti_module_id', 'um_usrnoti_feature_code'],
				'type' => '1M',
				'map' => ['um_user_tenant_id' => 'um_usrnoti_tenant_id', 'um_user_id' => 'um_usrnoti_user_id']
			],
			'\Numbers\Users\Users\Model\User\Permissions' => [
				'name' => 'Permissions',
				'pk' => ['um_usrperm_tenant_id', 'um_usrperm_user_id', 'um_usrperm_module_id', 'um_usrperm_resource_id', 'um_usrperm_method_code', 'um_usrperm_action_id'],
				'type' => '1M',
				'map' => ['um_user_tenant_id' => 'um_usrperm_tenant_id', 'um_user_id' => 'um_usrperm_user_id']
			],
			'\Numbers\Users\Users\Model\User\Security\Answers' => [
				'name' => 'Security Answers',
				'pk' => ['um_usrsecanswer_tenant_id', 'um_usrsecanswer_user_id', 'um_usrsecanswer_question_id'],
				'type' => '1M',
				'map' => ['um_user_tenant_id' => 'um_usrsecanswer_tenant_id', 'um_user_id' => 'um_usrsecanswer_user_id']
			]
		]
	];
	public $notification = [
		'feature_code' => 'UM::EMAIL_USERS_CHANGED'
	];

	public function overrides(& $form) {
		\Layout::addJs('https://maps.googleapis.com/maps/api/js?key=' . \Application::get('google.maps.api_key') . '&libraries=drawing', 10000);
	}

	public function validate(& $form) {
		// personal type
		if ($form->values['um_user_type_id'] == 10) {
			if (empty($form->values['um_user_first_name'])) $form->error('danger', \Object\Content\Messages::REQUIRED_FIELD, 'um_user_first_name');
			if (empty($form->values['um_user_last_name'])) $form->error('danger', \Object\Content\Messages::REQUIRED_FIELD, 'um_user_last_name');
			$name = concat_ws(' ', $form->values['um_user_title'], $form->values['um_user_first_name'], $form->values['um_user_last_name']);
		} else if ($form->values['um_user_type_id'] == 20) { // business
			if (empty($form->values['um_user_company'])) $form->error('danger', \Object\Content\Messages::REQUIRED_FIELD, 'um_user_company');
			$name = $form->values['um_user_company'];
		}
		// set name
		if (!$form->hasErrors() && empty($form->values['um_user_name'])) {
			$form->values['um_user_name'] = $name;
		}
		// login enabled
		if (!empty($form->values['um_user_login_enabled'])) {
			if (empty($form->values['um_user_email']) && empty($form->values['um_user_phone']) && empty($form->values['um_user_login_username'])) {
				$form->error('danger', 'You must provide email, phone or username!', 'um_user_email');
				$form->error('danger', 'You must provide email, phone or username!', 'um_user_phone');
				$form->error('danger', 'You must provide email, phone or username!', 'um_user_login_username');
			}
		}
		// primary organizations
		$primary_organization_id = $form->validateDetailsPrimaryColumn(
			'\Numbers\Users\Users\Model\User\Organizations',
			'um_usrorg_primary',
			'um_usrorg_inactive',
			'um_usrorg_organization_id'
		);
		// password
		if (!empty($form->values['um_user_login_password_new'])) {
			// see if we can change password for this role
			$roles = array_extract_values_by_key($form->values['\Numbers\Users\Users\Model\User\Roles'], 'um_usrrol_role_id');
			if (\Numbers\Users\Users\Helper\Role\Manages::can(\User::get('role_ids'), $roles, 'um_rolman_reset_password', 1)) {
				$crypt = new \Crypt();
				$form->values['um_user_login_password'] = $crypt->passwordHash($form->values['um_user_login_password_new']);
			} else {
				$form->error(DANGER, 'You do not have permission to reset password!', 'um_user_login_password_new');
			}
		}
		// validate assigments
		foreach ($form->values['\Numbers\Users\Users\Model\User\Assignment\Virtual\Reverse'] as $k => $v) {
			$key = "\Numbers\Users\Users\Model\User\Assignment\Virtual\Reverse[$k][um_usrassign_parent_user_id]";
			if (!empty($v['um_usrassign_mandatory']) && empty($v['um_usrassign_parent_user_id'])) {
				$form->error(DANGER, \Object\Content\Messages::REQUIRED_FIELD, $key);
			}
		}
		foreach ($form->values['\Numbers\Users\Users\Model\User\Assignment\Territories'] as $k => $v) {
			if (empty($v['\Numbers\Users\Users\Model\User\Assignment\Territory\Map'])) {
				$form->error(DANGER, \Object\Content\Messages::REQUIRED_FIELD, "\Numbers\Users\Users\Model\User\Assignment\Territories[$k][\Numbers\Users\Users\Model\User\Assignment\Territory\Map][1][um_usrasstrrmap_territory_id]");
			}
		}
		foreach ($form->values['\Numbers\Users\Users\Model\User\Assignment\Locations'] as $k => $v) {
			if (empty($v['\Numbers\Users\Users\Model\User\Assignment\Location\Map'])) {
				$form->error(DANGER, \Object\Content\Messages::REQUIRED_FIELD, "\Numbers\Users\Users\Model\User\Assignment\Locations[$k][\Numbers\Users\Users\Model\User\Assignment\Location\Map][1][um_usrasslcnmap_country_code]");
			}
		}
		// photo
		if (!$form->hasErrors() && !empty($form->values['__logo_upload'])) {
			$form->values['__logo_upload']['__image_properties'] = $form->fields['__logo_upload']['options']['validator_params'] ?? [];
			$model = new \Numbers\Users\Documents\Base\Base();
			// remove file if exists
			if (!empty($form->values['um_user_photo_file_id'])) {
				$result = $model->delete($form->values['um_user_photo_file_id']);
				if (!$result['success']) {
					$form->error(DANGER, $result['error']);
					return;
				}
				$form->values['um_user_photo_file_id'] = null;
			}
			// add file
			$catalog = $model->fetchPrimaryCatalog($primary_organization_id);
			if (empty($catalog)) {
				$form->error(DANGER, 'You must set primary catalog!');
				return;
			}
			$result = $model->upload($form->values['__logo_upload'], $catalog);
			if (!$result['success']) {
				$form->error(DANGER, $result['error']);
				return;
			}
			$form->values['um_user_photo_file_id'] = $result['file_id'];
		}
		// polygons
		if ($form->hasErrors() && !empty($form->errors['fields'])) {
			foreach ($form->errors['fields'] as $k => $v) {
				if (strpos($k, 'um_usrassgeoarea_polygon') !== false) {
					$form->errors['fields'][str_replace('um_usrassgeoarea_polygon', 'show_google_map', $k)] = $v;
				}
			}
		}
		// numeric phone
		if (!empty($form->values['um_user_phone'])) {
			$form->values['um_user_numeric_phone'] = \Object\Validator\Phone::plainNumber($form->values['um_user_phone']);
		} else {
			$form->values['um_user_numeric_phone'] = null;
		}
	}

	public function post(& $form) {
		// send password reset email
		if (!empty($form->values['um_user_login_password_new'])) {
			\Numbers\Users\Users\Helper\User\Notifications::sendPasswordChangeEmail($form->values['um_user_id']);
		}
	}

	/**
	 * Cached services
	 *
	 * @var array
	 */
	private $temp_services_cached;

	public function processOptionsModels(& $form, $field_name, $details_key, $details_parent_key, & $where, $neighbouring_values, $details_value) {
		if ($field_name == 'um_usrrol_role_id') {
			$where['selected_organizations'] = array_extract_values_by_key($form->values['\Numbers\Users\Users\Model\User\Organizations'], 'um_usrorg_organization_id', ['unique' => true]);
		}
		if (in_array($field_name, ['um_usrasspostal_service_id', 'um_usrassterr_service_id', 'um_usrassloc_service_id'])) {
			$where['on_service_organization_id'] = array_extract_values_by_key($form->values['\Numbers\Users\Users\Model\User\Organizations'], 'um_usrorg_organization_id', ['unique' => true]);
			if (empty($where['on_service_organization_id'])) {
				$where['on_service_organization_id'] = null;
			}
		}
		if ($field_name == 'um_usrasstrrmap_territory_id' && !empty($details_value['um_usrassterr_service_id'])) {
			//print_r2($details_value);
			if (!isset($this->temp_services_cached)) {
				$this->temp_services_cached = \Numbers\Users\Organizations\Model\Services::getStatic([
					'pk' => ['on_service_id'],
					'columns' => [
						'on_service_id', 'on_service_assignment_type_id'
					]
				]);
			}
			if (in_array($this->temp_services_cached[$details_value['um_usrassterr_service_id']]['on_service_assignment_type_id'], [13, 17])) {
				$where['on_territory_type_id'] = $this->temp_services_cached[$details_value['um_usrassterr_service_id']]['on_service_assignment_type_id'];
			}
		}
	}

	public function processAllValues(& $form) {
		if (empty($form->values['\Numbers\Users\Users\Model\User\Roles'])) return;
		// direct assigments
		if (empty($form->values['\Numbers\Users\Users\Model\User\Assignment\Virtual']) || strpos($form->options['input']['__form_onchange_field_values_key'] ?? '', 'um_usrrol_role_id') !== false) {
			$virtual = $form->values['\Numbers\Users\Users\Model\User\Assignment\Virtual'] ?? [];
			$form->values['\Numbers\Users\Users\Model\User\Assignment\Virtual'] = [];
			$model = new \Numbers\Users\Users\DataSource\Role\Assignments();
			$data = $model->get([
				'where' => [
					'parent_role_ids' => array_extract_values_by_key($form->values['\Numbers\Users\Users\Model\User\Roles'], 'um_usrrol_role_id')
				]
			]);
			foreach ($data as $k => $v) {
				$form->values['\Numbers\Users\Users\Model\User\Assignment\Virtual'][$k] = [
					'um_usrassign_assignment_code' => $v['um_rolassign_assignment_code'],
					'um_usrassign_parent_role_id' => $v['um_rolassign_parent_role_id'],
					'um_usrassign_child_role_id' => $v['um_rolassign_child_role_id'],
					'um_usrassign_mandatory' => $v['um_rolassign_mandatory'],
					'um_usrassign_multiple' => $v['um_assigntype_multiple'],
					'um_usrassign_child_user_id' => $virtual[$k]['um_usrassign_child_user_id'] ?? []
				];
				foreach ($form->values['\Numbers\Users\Users\Model\User\Assignments'] ?? [] as $v2) {
					if ($v['um_rolassign_assignment_code'] == $v2['um_usrassign_assignment_code'] && $v['um_rolassign_parent_role_id'] == $v2['um_usrassign_parent_role_id'] && $v['um_rolassign_child_role_id'] == $v2['um_usrassign_child_role_id']) {
						$form->values['\Numbers\Users\Users\Model\User\Assignment\Virtual'][$k]['um_usrassign_child_user_id'][$v2['um_usrassign_child_user_id']]['um_usrassign_child_user_id'] = $v2['um_usrassign_child_user_id'];
					}
				}
			}
		}
		// create direct assigmnets
		foreach ($form->values['\Numbers\Users\Users\Model\User\Assignment\Virtual'] ?? [] as $k => $v) {
			foreach ($v['um_usrassign_child_user_id'] as $k2 => $v2) {
				if (is_array($v2)) {
					$value = $v2['um_usrassign_child_user_id'];
				} else {
					$value = $v2;
				}
				$key = \Tenant::id() . '::' . $v['um_usrassign_assignment_code'] . '::' . ($form->values['um_user_id'] ?? '') . '::' . $value;
				$form->values['\Numbers\Users\Users\Model\User\Assignments'][$key] = [
					'um_usrassign_assignment_code' => $v['um_usrassign_assignment_code'],
					'um_usrassign_parent_user_id' => $form->values['um_user_id'],
					'um_usrassign_child_user_id' => (int) $value,
					'um_usrassign_parent_role_id' => $v['um_usrassign_parent_role_id'],
					'um_usrassign_child_role_id' => $v['um_usrassign_child_role_id'],
				];
			}
		}
		// reverse assigmnents
		if (empty($form->values['\Numbers\Users\Users\Model\User\Assignment\Virtual\Reverse']) || strpos($form->options['input']['__form_onchange_field_values_key'] ?? '', 'um_usrrol_role_id') !== false) {
			$virtual = $form->values['\Numbers\Users\Users\Model\User\Assignment\Virtual\Reverse'] ?? [];
			$form->values['\Numbers\Users\Users\Model\User\Assignment\Virtual\Reverse'] = [];
			$model = new \Numbers\Users\Users\DataSource\Role\Assignments();
			$data = $model->get([
				'where' => [
					'child_role_ids' => array_extract_values_by_key($form->values['\Numbers\Users\Users\Model\User\Roles'], 'um_usrrol_role_id')
				]
			]);
			foreach ($data as $k => $v) {
				$form->values['\Numbers\Users\Users\Model\User\Assignment\Virtual\Reverse'][$k] = [
					'um_usrassign_assignment_code' => $v['um_rolassign_assignment_code'],
					'um_usrassign_parent_role_id' => $v['um_rolassign_parent_role_id'],
					'um_usrassign_child_role_id' => $v['um_rolassign_child_role_id'],
					'um_usrassign_mandatory' => $v['um_rolassign_mandatory'],
					'um_usrassign_multiple' => $v['um_assigntype_multiple'],
					'um_usrassign_parent_user_id' => $virtual[$k]['um_usrassign_parent_user_id'] ?? []
				];
				foreach ($form->values['\Numbers\Users\Users\Model\User\Assignment\Reverse'] ?? [] as $v2) {
					if ($v['um_rolassign_assignment_code'] == $v2['um_usrassign_assignment_code'] && $v['um_rolassign_parent_role_id'] == $v2['um_usrassign_parent_role_id'] && $v['um_rolassign_child_role_id'] == $v2['um_usrassign_child_role_id']) {
						$form->values['\Numbers\Users\Users\Model\User\Assignment\Virtual\Reverse'][$k]['um_usrassign_parent_user_id'][$v2['um_usrassign_parent_user_id']]['um_usrassign_parent_user_id'] = $v2['um_usrassign_parent_user_id'];
					}
				}
			}
		}
		// create direct assigmnets
		foreach ($form->values['\Numbers\Users\Users\Model\User\Assignment\Virtual\Reverse'] ?? [] as $k => $v) {
			foreach ($v['um_usrassign_parent_user_id'] as $k2 => $v2) {
				if (is_array($v2)) {
					$value = $v2['um_usrassign_parent_user_id'];
				} else {
					$value = $v2;
				}
				$key = \Tenant::id() . '::' . $v['um_usrassign_assignment_code'] . '::' . $value . '::' . ($form->values['um_user_id'] ?? '');
				$form->values['\Numbers\Users\Users\Model\User\Assignment\Reverse'][$key] = [
					'um_usrassign_assignment_code' => $v['um_usrassign_assignment_code'],
					'um_usrassign_parent_user_id' => (int) $value,
					'um_usrassign_child_user_id' => $form->values['um_user_id'],
					'um_usrassign_parent_role_id' => $v['um_usrassign_parent_role_id'],
					'um_usrassign_child_role_id' => $v['um_usrassign_child_role_id'],
				];
			}
		}
	}

	public function processDefaultValue(& $form, $key, $default, & $value, & $neighbouring_values, $changed_field = [], $options = []) {
		if ($key == 'um_usrasspostal_organization_id') {
			if (!empty($neighbouring_values['um_usrasspostal_service_id'])) {
				$data = \Numbers\Users\Organizations\Model\Services::loadById($neighbouring_values['um_usrasspostal_service_id']);
				$value = $neighbouring_values['um_usrasspostal_organization_id'] = $data['on_service_organization_id'];
			} else {
				$value = $neighbouring_values['um_usrasspostal_organization_id'] = null;
			}
		}
		if ($key == 'um_usrassterr_organization_id') {
			if (!empty($neighbouring_values['um_usrassterr_service_id'])) {
				$data = \Numbers\Users\Organizations\Model\Services::loadById($neighbouring_values['um_usrassterr_service_id']);
				$value = $neighbouring_values['um_usrassterr_organization_id'] = $data['on_service_organization_id'];
			} else {
				$value = $neighbouring_values['um_usrassterr_organization_id'] = null;
			}
		}
		if ($key == 'um_usrassloc_organization_id') {
			if (!empty($neighbouring_values['um_usrassloc_service_id'])) {
				$data = \Numbers\Users\Organizations\Model\Services::loadById($neighbouring_values['um_usrassloc_service_id']);
				$value = $neighbouring_values['um_usrassloc_organization_id'] = $data['on_service_organization_id'];
			} else {
				$value = $neighbouring_values['um_usrassloc_organization_id'] = null;
			}
		}
		if ($key == 'um_usrassgeoarea_organization_id') {
			if (!empty($neighbouring_values['um_usrassgeoarea_service_id'])) {
				$data = \Numbers\Users\Organizations\Model\Services::loadById($neighbouring_values['um_usrassgeoarea_service_id']);
				$value = $neighbouring_values['um_usrassgeoarea_organization_id'] = $data['on_service_organization_id'];
			} else {
				$value = $neighbouring_values['um_usrassgeoarea_organization_id'] = null;
			}
		}
	}

	public function overrideFieldValue(& $form, & $options, & $value, & $neighbouring_values) {
		if ($options['options']['field_name'] == 'um_usrassign_child_user_id' || $options['options']['field_name'] == 'um_usrassign_parent_user_id') {
			if (empty($neighbouring_values['um_usrassign_multiple'])) {
				$options['options']['method'] = 'select';
			}
		}
	}

	public function owners(& $form) {
		return [
			'organization_id' => array_extract_values_by_key($form->values['\Numbers\Users\Users\Model\User\Organizations'], 'um_usrorg_organization_id'),
		];
	}

	public function overrideTabs(& $form, & $options, & $tab, & $neighbouring_values) {
		$result = [];
		if ($tab == 'photo' && (empty($form->values['um_user_id']) || !\Can::systemModuleExists('DT'))) {
			$result['hidden'] = true;
		}
		if ($tab == 'territories_assignments' && !\Can::systemFeatureExists('ON::TERRITORIES')) {
			$result['hidden'] = true;
		}
		if ($tab == 'postal_code_assignments' && !\Can::systemFeatureExists('CM::COUNTRIES')) {
			$result['hidden'] = true;
		}
		if (in_array($tab, ['postal_code_assignments', 'territories_assignments', 'locations_assignments']) && !\Can::systemFeatureExists('ON::SERVICES')) {
			$result['hidden'] = true;
		}
		return $result;
	}
}