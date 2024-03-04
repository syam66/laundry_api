<?php

namespace App\Repositories;

use App\Contracts\BaseInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class BaseRepository implements BaseInterface
{
    protected $table;

    function __construct()
    {
        $this->table = '';
    }

    public function query()
    {
        return DB::table($this->table);
    }

    public function all()
    {
        if(Schema::hasColumn($this->table, 'deleted_at'))
        {
            return $this->query()->whereNull('deleted_at')->get();
        } else {
            return $this->query()->get();
        }

    }

    public function find($id)
    {
        return $this->query()->where('id', $id)->first();
    }

    public function create(array $data)
    {
        return $this->query()->insertGetId($data);
    }

    public function update($id, array $data)
    {
        return $this->query()->where('id', $id)->update($data);
    }

    public function delete($id)
    {
        if(Schema::hasColumn($this->table, 'deleted_at'))
        {
            return $this->query()->where('id', $id)->update([
                'deleted_at' => now(),
                'deleted_by' => auth()->user()->username
            ]);
        } else {
            return $this->permanentDelete($id);
        }
    }

    public function permanentDelete($id)
    {
        return $this->query()->where('id', $id)->delete();
    }
}
