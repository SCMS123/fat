<?php

namespace App\DataTables;

use App\Models\MotorPrivate;
use App\Models\Action;
use App\Models\Role;
use App\Models\AdminPermission;
use App\Helpers\AdminHelper;
use Auth;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class MotorPrivateDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $status_action = Action::where('action_slug','status')->first();
        $checkStatusAction = Role::where('name_slug','motor_private')->whereRaw("find_in_set('".$status_action->id."',action_id)")->first();
        $roles = Role::where('name_slug','motor_private')->first();
        $checkStatusPermission = AdminPermission::where('user_id',Auth::user()->id)->whereRaw("find_in_set('status',action_id)")->first();

        return datatables()
            ->eloquent($query)
            ->editColumn('category', function($row) {
                if (!empty($row->category)) {
                    $data = AdminHelper::get_title('policy_categories',$row->category,'name');
                    return $data;
                }else{
                    return 'Not Found';
                }
            })
            ->editColumn('sub_category', function($row) {
                if (!empty($row->sub_category)) {
                    $data = AdminHelper::get_title('policy_sub_categories',$row->sub_category,'name');
                    return $data;
                }else{
                    return 'Not Found';
                }
            })
            ->editColumn('status', function($row) use ($checkStatusAction,$checkStatusPermission) {
                if (!empty($checkStatusAction) && (!empty($checkStatusPermission) || Auth::user()->user_type == 'admin')) {
                    if($row->status == '1'){
                        return '<a href="'.route("motor_private.status",$row->id).'" class="btn btn-success btn-sm" onclick="return confirm("Are you sure want to change status?")">Active</a>';
                    }
                    if($row->status == '0'){
                        return '<a href="'.route("motor_private.status",$row->id).'" class="btn btn-danger btn-sm" onclick="return confirm("Are you sure want to change status?")">Inactive</a>';
                    }
                }else{
                    if($row->status == '1'){
                        return '<a href="javascript:void(0)" class="btn btn-success btn-sm">Active</a>';
                    }
                    if($row->status == '0'){
                        return '<a href="javascript:void(0)" class="btn btn-danger btn-sm">Inactive</a>';
                    }
                }
            })
            ->editColumn('action', function($row) use ($roles) {
                $action_ids = explode(',', $roles->action_id);
                foreach ($action_ids as $key => $action_id) {
                    $action = Action::find($action_id);
                    if ($action->action_slug == 'edit' || $action->action_slug == 'delete' || $action->action_slug == 'view') {
                        $btn .= '<a href="'.route("motor_private.$action->action_slug",$row->id).'" class="btn btn-'.$action->class.' btn-sm" data-placement="top" data-original-title="'.$action->action_title.'"><i class="'.$action->icon.'"></i>'.$action->action_title.'</a>&nbsp;';
                    }
                }

                return $btn;
            })
            ->escapeColumns([]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\ActionDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(MotorPrivate $model)
    {
        //return $model->newQuery();
        $data = MotorPrivate::select('motor_private.*','motor_private.category_id as category','motor_private.sub_category_id as sub_category');

        return $this->applyScopes($data);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(0,'ASC');
                    // ->buttons(
                    //     Button::make('export'),
                    //     Button::make('print')
                    // );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'id'=> [
                'title' => 'Sr. No.', 
                'orderable' => true, 
                'searchable' => false, 
                'render' => function() {
                        return 'function(data,type,fullData,meta){return meta.settings._iDisplayStart+meta.row+1;}';
                    }
            ],
            'category' => ['name'=>'motor_private.category_id'],
            'sub_category' => ['name'=>'motor_private.sub_category_id'],
            'title',
            'status',
            'action' => [
                'searchable' => false,
                'visible' => true, 
                'printable' => false, 
                'exportable' => false
            ],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Export_' . date('YmdHis');
    }
}
