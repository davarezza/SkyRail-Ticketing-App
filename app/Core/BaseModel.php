<?php

namespace App\Core;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Builder;
use stdClass;

class BaseModel extends Model
{
    use HasFactory;

    protected $useView = false;

    const DELETED_AT = 'deleted_at';

    /**
     * @var array
     */
    protected $datatableFilters = false;

    protected $request;

    protected $model;

    function __construct()
    {
        parent::__construct();
        $this->request = app(Request::class);
        $this->model = $this;
    }

    public function newEloquentBuilder($query)
    {
        return new BaseBuilder($query, $this->model, $this->view, $this->getDeletedAtColumn());
    }

    /**
     * @param string
     * Gunakan fungsi ini jika anda ingin mengganti nama table ke view
     */
    public function setView($view = '')
    {
        // $this->setTable($view);
        $this->model = $this->setTable($view);
        $this->model->useView = true;
        return $this->model;
    }

    /**
     * @param string
     * Untuk meringkas select di model anda bisa menambahkan mode untuk menempatkan satu titik di model
     * */
    public function setMode($mode = '')
    {
        if (isset($this->view[$this->table][$mode])) {
            $this->mode = $mode;
            $this->model = $this->model->select($this->view[$this->table][$mode]);
        }
        return $this->model;
    }

    public function getDeletedAtColumn() {
        return defined('static::DELETED_AT') ? static::DELETED_AT : 'deleted_at';
    }

    public function handlePaginate($perPage = 10, $config = [])
    {
        try {
            $perPage = (isset($config['perPage'])) ? $config['perPage'] : 10;
            $pager = $this->model->paginate($perPage);
            $countPerpage = ($pager->currentPage() * $pager->perPage() + 1);

            return [
                'success' => true,
                'code' => 200,
                'errors' => null,
                'page' => [
                    'currentPage' => $pager->currentPage(),
                    'perPage' => $pager->perPage(),
                    'from' => ($countPerpage - $pager->perPage()),
                    'to' => ($countPerpage - 1),
                    'total' => $pager->total(),
                    'lastPage' => $pager->lastPage(),
                    'pageCount' => $pager->lastPage(),
                ],
                'links' => [
                    'first' => $pager->url(1),
                    'prev' => $pager->previousPageUrl(),
                    'next' => $pager->nextPageUrl(),
                    'last' => $pager->url($pager->lastPage()),
                ],
                'data'  => $pager->items(),
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'code' => $e->getCode(),
                'status' => $e->getCode(),
                'errors' => $e->getMessage(),
            ];
        }
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
        // die('fire');
        $this->getDatatablesQuery();
        $return = new stdClass;
        $return->countFiltered = $this->model->count();

        if ($this->request->input('length') != -1) {
            if($relation) {
                $return->lists  = $this->model->offset((int) $this->request->input('start'))->limit((int) $this->request->input('length'))->with($relation)->get();
            }
            else {
                $return->lists  = $this->model->offset((int) $this->request->input('start'))->limit((int) $this->request->input('length'))->get();
            }
        } else {
            if ($relation) {
                // $this->model = $this->model->with($relation);
                $return->lists = $this->model->with($relation)->get();
            }
            else {
                $return->lists = $this->model->get();
            }
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
