<?php

namespace Numbers\Users\Workflow\Model\Collection;
class Workflows extends \Object\Collection {
	public $data = [
		'name' => 'Workflows',
		'model' => '\Numbers\Users\Workflow\Model\Workflows',
		'details' => [
			'\Numbers\Users\Workflow\Model\Workflow\Canvas' => [
				'name' => 'Canvas',
				'pk' => ['ww_wrkflwcanvas_tenant_id', 'ww_wrkflwcanvas_workflow_id', 'ww_wrkflwcanvas_id'],
				'type' => '1M',
				'map' => ['ww_workflow_tenant_id' => 'ww_wrkflwcanvas_tenant_id', 'ww_workflow_id' => 'ww_wrkflwcanvas_workflow_id'],
				'details' => [
					'\Numbers\Users\Workflow\Model\Workflow\Canvas\Lines' => [
						'name' => 'Line Settings',
						'pk' => ['ww_wrkflwcnvsline_tenant_id', 'ww_wrkflwcnvsline_workflow_id', 'ww_wrkflwcnvsline_canvas_id'],
						'type' => '11',
						'map' => ['ww_wrkflwcanvas_tenant_id' => 'ww_wrkflwcnvsline_tenant_id', 'ww_wrkflwcanvas_workflow_id' => 'ww_wrkflwcnvsline_workflow_id', 'ww_wrkflwcanvas_id' => 'ww_wrkflwcnvsline_canvas_id']
					],
					'\Numbers\Users\Workflow\Model\Workflow\Canvas\Shapes' => [
						'name' => 'Shape Settings',
						'pk' => ['ww_wrkflwcnvsshape_tenant_id', 'ww_wrkflwcnvsshape_workflow_id', 'ww_wrkflwcnvsshape_canvas_id'],
						'type' => '11',
						'map' => ['ww_wrkflwcanvas_tenant_id' => 'ww_wrkflwcnvsshape_tenant_id', 'ww_wrkflwcanvas_workflow_id' => 'ww_wrkflwcnvsshape_workflow_id', 'ww_wrkflwcanvas_id' => 'ww_wrkflwcnvsshape_canvas_id']
					]
				]
			],
			'\Numbers\Users\Workflow\Model\Workflow\Steps' => [
				'name' => 'Steps',
				'pk' => ['ww_wrkflwstep_tenant_id', 'ww_wrkflwstep_workflow_id', 'ww_wrkflwstep_id'],
				'type' => '1M',
				'map' => ['ww_workflow_tenant_id' => 'ww_wrkflwstep_tenant_id', 'ww_workflow_id' => 'ww_wrkflwstep_workflow_id'],
				'details' => [
					'\Numbers\Users\Workflow\Model\Workflow\Step\Next' => [
						'name' => 'Next Steps',
						'pk' => ['ww_wrkflwstepnext_tenant_id', 'ww_wrkflwstepnext_workflow_id', 'ww_wrkflwstepnext_step_id', 'ww_wrkflwstepnext_next_step_id'],
						'type' => '1M',
						'map' => ['ww_wrkflwstep_tenant_id' => 'ww_wrkflwstepnext_tenant_id', 'ww_wrkflwstep_workflow_id' => 'ww_wrkflwstepnext_workflow_id', 'ww_wrkflwstep_id' => 'ww_wrkflwstepnext_step_id'],
					]
				]
			]
		]
	];
}