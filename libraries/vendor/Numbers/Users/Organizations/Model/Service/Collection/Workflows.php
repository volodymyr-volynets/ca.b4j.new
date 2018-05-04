<?php

namespace Numbers\Users\Organizations\Model\Service\Collection;
class Workflows extends \Object\Collection {
	public $data = [
		'name' => 'Workflows',
		'model' => '\Numbers\Users\Organizations\Model\Service\Workflows',
		'details' => [
			'\Numbers\Users\Organizations\Model\Service\Workflow\Canvas' => [
				'name' => 'Canvas',
				'pk' => ['on_workcanvas_tenant_id', 'on_workcanvas_workflow_id', 'on_workcanvas_id'],
				'type' => '1M',
				'map' => ['on_workflow_tenant_id' => 'on_workcanvas_tenant_id', 'on_workflow_id' => 'on_workcanvas_workflow_id'],
				'details' => [
					'\Numbers\Users\Organizations\Model\Service\Workflow\Canvas\Lines' => [
						'name' => 'Line Settings',
						'pk' => ['on_workcanvline_tenant_id', 'on_workcanvline_workflow_id', 'on_workcanvline_canvas_id'],
						'type' => '11',
						'map' => ['on_workcanvas_tenant_id' => 'on_workcanvline_tenant_id', 'on_workcanvas_workflow_id' => 'on_workcanvline_workflow_id', 'on_workcanvas_id' => 'on_workcanvline_canvas_id']
					],
					'\Numbers\Users\Organizations\Model\Service\Workflow\Canvas\Shapes' => [
						'name' => 'Shape Settings',
						'pk' => ['on_workcanvshape_tenant_id', 'on_workcanvshape_workflow_id', 'on_workcanvshape_canvas_id'],
						'type' => '11',
						'map' => ['on_workcanvas_tenant_id' => 'on_workcanvshape_tenant_id', 'on_workcanvas_workflow_id' => 'on_workcanvshape_workflow_id', 'on_workcanvas_id' => 'on_workcanvshape_canvas_id']
					]
				]
			],
			'\Numbers\Users\Organizations\Model\Service\Workflow\Steps' => [
				'name' => 'Steps',
				'pk' => ['on_workstep_tenant_id', 'on_workstep_workflow_id', 'on_workstep_id'],
				'type' => '1M',
				'map' => ['on_workflow_tenant_id' => 'on_workstep_tenant_id', 'on_workflow_id' => 'on_workstep_workflow_id'],
				'details' => [
					'\Numbers\Users\Organizations\Model\Service\Workflow\Step\Next' => [
						'name' => 'Next Steps',
						'pk' => ['on_workstpnext_tenant_id', 'on_workstpnext_workflow_id', 'on_workstpnext_step_id', 'on_workstpnext_next_step_id'],
						'type' => '1M',
						'map' => ['on_workstep_tenant_id' => 'on_workstpnext_tenant_id', 'on_workstep_workflow_id' => 'on_workstpnext_workflow_id', 'on_workstep_id' => 'on_workstpnext_step_id'],
					],
					'\Numbers\Users\Organizations\Model\Service\Workflow\Step\Fields' => [
						'name' => 'Form Fields',
						'pk' => ['on_workstpfield_tenant_id', 'on_workstpfield_workflow_id', 'on_workstpfield_step_id', 'on_workstpfield_field_id'],
						'type' => '1M',
						'map' => ['on_workstep_tenant_id' => 'on_workstpfield_tenant_id', 'on_workstep_workflow_id' => 'on_workstpfield_workflow_id', 'on_workstep_id' => 'on_workstpfield_step_id'],
					]
				]
			]
		]
	];
}