<?php

namespace App\DataTables;

use App\Models\Department;
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

class DepartmentDataTable extends DataTable
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
        $checkStatusAction = Role::where('name_slug','departments')->whereRaw("find_in_set('".$status_action->id."',action_id)")->first();
        $roles = Role::where('name_slug','departments')->first();
        $checkStatusPermission = AdminPermission::where('user_id',Auth::user()->id)->whereRaw("find_in_set('status',action_id)")->first();

        return datatables()
            ->eloquent($query)
            ->editColumn('branch_id', function($row) {
                if (!empty($row->branch_id)) {
                    $data = AdminHelper::get_title('branches',$row->branch_id,'branch_name');
                    return $data;
                }else{
                    return 'Branch Not Found';
                }
            })
            ->editColumn('action', function($row) use ($roles) {
                $action_ids = explode(',', $roles->action_id);
                foreach ($action_ids as $key => $action_id) {
                    $action = Action::find($action_id);
                    if ($action->action_slug == 'edit' || $action->action_slug == 'delete' || $action->action_slug == 'view') {
                        $btn .= '<a href="'.route("departments.$action->action_slug",$row->id).'" class="btn btn-'.$action->class.' btn-sm" data-placement="top" data-original-title="'.$action->action_title.'"><i class="'.$action->icon.'"></i>'.$action->action_title.'</a>&nbsp;';
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
    public function query(Department $model)
    {
        //return $model->newQuery();
        $data = Department::select();

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
            'branch_id',
            'department_code',
            'department_name',
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
