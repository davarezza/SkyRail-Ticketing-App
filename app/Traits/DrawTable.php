<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use stdClass;

trait DrawTable
{
    protected $model;

    protected $request;

    function __construct()
    {
        parent::__construct();
        $this->request = app(Request::class);
        $this->model = $this;
    }

    public function draw($relation = null)
    {
        if ($this->request->isMethod('POST')) {

            $listData = $this->getDatatables($relation);
            $recordsTotal = $listData->countFiltered;
            $recordsFiltered = $listData->countFiltered;
            $lists = $listData->lists;

            $data  = [];
            $no    = $this->request->input('start');

            foreach ($lists as &$list) {
                $list->rowData = [
                    'id' => ($list->{$this->primaryKey}) ? $list->{$this->primaryKey} : null
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

    public function getDatatables($relation = null)
    {
        if ($relation) {
            $this->model = $this->model->with($relation);
        }
        $this->getDatatablesQuery();
        $return = new stdClass;
        $return->countFiltered = $this->model->count();

        if ($this->request->input('length') != -1) {
            $return->lists  = $this->model->offset((int) $this->request->input('start'))->limit((int) $this->request->input('length'))->get();
        } else {
            $return->lists = $this->model->get();
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
                $this->model = $this->model->orderBy(
                    $this->getColumn()[$this->request->input('order')['0']['column']],
                    $this->request->input('order')['0']['dir']
                );
            } else {
                $this->model = $this->model->orderBy(
                    $this->request->input('columns')[$this->request->input('order')['0']['column']]['data'],
                    $this->request->input('order')['0']['dir']
                );
            }
        }
    }

    public function getColumn()
    {
        if ($this->mode != '') {
            return $this->view[$this->table][$this->mode];
        } else {
            if (isset($this->view[$this->table]['datatable'])) {
                return $this->view[$this->table]['datatable'];
            } else {
                return Schema::getColumnListing($this->table);
            }
        }
    }

    private function getFilterDatatable()
    {
        $request = $this->request->input();
        $listColumn = (is_array($this->datatableFilters)) ? $this->datatableFilters : $this->getColumn();

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
            foreach ($fields as $k => $item) {
                if ($k === 0) {
                    if ($item['searchable'] == 'true') {
                        $this->model = $this->model->where($item['data'], 'LIKE', '%' . $this->request->input('search')['value'] . '%');
                    }
                } else {
                    if ($item['searchable'] == 'true') {
                        $this->model = $this->model->orWhere($item['data'], 'LIKE', '%' . $this->request->input('search')['value'] . '%');
                    }
                }
            }
        }
    }

    private function getFilterAllDatatable()
    {
        $fields = $this->getColumn();
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