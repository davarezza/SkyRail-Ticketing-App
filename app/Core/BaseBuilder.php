<?php

namespace App\Core;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;

use stdClass;
use App\Core\BaseModel;

class BaseBuilder extends Builder
{

    protected $query;
    protected $request;
    protected $model;
    protected $datatableFilters;
    protected $view;
    protected $softdelete;
    protected $softdelete_field;


    function __construct($query, $modelInstance, $view, $softdeletefield)
    {
        $this->query = $query;
        $this->request = app(Request::class);
        $this->model = $modelInstance;
        $this->view = $view;
        $this->softdelete = in_array('Illuminate\Database\Eloquent\SoftDeletes', class_uses($this->model));
        $this->softdelete_field = $softdeletefield;
    }

    public function draw()
    {
        if ($this->request->isMethod('POST')) {
            if(isset($this->model->getAttributes()['mode'])){
                $this->query = $this->query->select($this->view[$this->model->getTable()][$this->model->getAttributes()['mode']]);
            }
            $listData = $this->getDatatables();
            $recordsTotal = $listData->countFiltered;
            $recordsFiltered = $listData->countFiltered;
            $lists = $listData->lists;
            $primaryKey = $this->model->getKeyName();

            $data  = [];
            $no    = $this->request->input('start');

            foreach ($lists as &$list) {
                $list->rowData = [
                    'id' => ($list->{$primaryKey}) ? $list->{$primaryKey} : null
                ];
                $list->no = ($no + 1);
                $no++;
            }
            $data = $lists;

            return [
                'draw' => $this->request->input('draw'),
                'recordsTotal' => $recordsTotal,
                'recordsFiltered' => $recordsFiltered,
                'data' => $data
            ];
        }
    }

    public function getDatatables()
    {
        $this->getDatatablesQuery();
        $return = new stdClass;
        $return->countFiltered =($this->softdelete) ? $this->query->where($this->softdelete_field, NULL)->count() : $this->query->count(); 

        if($this->softdelete){
            $this->query = $this->query->where($this->softdelete_field, NULL);
        }

        if ($this->request->input('length') != -1) {
            $return->lists  = $this->query->offset((int) $this->request->input('start'))->limit((int) $this->request->input('length'))->get();
        } else {
            $return->lists = $this->query->get();
        }

        return $return;
    }

    private function getDatatablesQuery()
    {
        if ($this->datatableFilters) {
            $this->getFilterDatatable();
        } else {
            if ($this->request->input('columns')['0']['data'] == 0) {
                $this->getFilterAllDatatable();
            } else {
                $this->getFilterJSDatatable();
            }
        }

        if ($this->request->input('order')) {
            if ($this->request->input('columns')['0']['data'] == 0) {
                $this->query = $this->query->orderBy(
                    $this->model->getColumn()[$this->request->input('order')['0']['column']],
                    $this->request->input('order')['0']['dir']
                );
            } else {
                $this->query = $this->query->orderBy(
                    $this->request->input('columns')[$this->request->input('order')['0']['column']]['data'],
                    $this->request->input('order')['0']['dir']
                );
            }
        }
    }

    private function getFilterDatatable()
    {
        $request = $this->request->input();
        $listColumn = (is_array($this->datatableFilters)) ? $this->datatableFilters : $this->model->getColumn();

        if (isset($request['search']) && $request['search']['value'] != '') {
            for ($i = 0, $countColumn = count($listColumn); $i < $countColumn; $i++) {
                if (isset($request['columns'][$i])) {
                    $item = $listColumn[$i];
                    if ($i === 0) {
                        $this->model = $this->model->where($item, 'LIKE', '%' . $this->request->input('search')['value'] . '%');
                    } else {
                        $this->model = $this->model->orWhere($item, 'LIKE', '%' . $this->request->input('search')['value'] . '%');
                    }
                }
            }
        }
    }

    private function getFilterJSDatatable()
    {
        $request = $this->request->input();
        $fields = $request['columns'];
        if (array_reduce(array_column($fields, 'searchable'), function ($carry, $item) {
            return $carry + (filter_var($item, FILTER_VALIDATE_BOOLEAN) == true);
        }, 0) == 0) return;

        if ((isset($this->request->input('search')['value']))) {
            $this->query = $this->query->where(function ($query) use ($fields) {
                foreach ($fields as $k => $item) {
                    if ($k === 0) {
                        if ($item['searchable'] == 'true') {
                            $query->where($item['data'], 'LIKE', '%' . $this->request->input('search')['value'] . '%');
                        }
                    } else {
                        if ($item['searchable'] == 'true') {
                            $query->orWhere($item['data'], 'LIKE', '%' . $this->request->input('search')['value'] . '%');
                        }
                    }
                }
            });
        }
    }

    private function getFilterAllDatatable()
    {
        $fields = $this->model->getColumn();
        $i = 0;
        foreach ($fields as $item) {
            if ((isset($this->request->input('search')['value']))) {
                if ($i === 0) {
                    $this->model = $this->model->where($item, 'LIKE', '%' . $this->request->input('search')['value'] . '%');
                } else {
                    $this->model = $this->model->orWhere($item, 'LIKE', '%' . $this->request->input('search')['value'] . '%');
                }
            }
            $i++;
        }
    }

}
