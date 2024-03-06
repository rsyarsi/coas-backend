<?php

namespace Src\V2\Hospitals\Repositories;

use Error;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Src\V2\Hospitals\Models\HospitalModel;
use Src\V2\Hospitals\Repositories\Contracts\HospitalContract;
use Tripteki\RequestResponseQuery\QueryBuilder;

class HospitalRepository implements HospitalContract
{
    /**
     * @return mixed
     */
    public function select()
    {
        $content = HospitalModel::all([ "id", "name", ]);

        return $content;
    }

    /**
     * @param array $querystring|[]
     * @return mixed
     */
    public function all($querystring = [])
    {
        $querystringed =
        [
            "limit" => $querystring["limit"] ?? request()->query("limit", 10),
            "current_page" => $querystring["current_page"] ?? request()->query("current_page", 1),
        ];
        extract($querystringed);

        $content = QueryBuilder::for(HospitalModel::class)->
        withoutGlobalScope("activation")->
        defaultSort("id")->
        allowedSorts([ "id", "name", "active", ])->
        allowedFilters([ "id", "name", "active", ])->
        paginate($limit, [ "*", ], "current_page", $current_page)->appends(empty($querystring) ? request()->query() : $querystringed);

        return $content;
    }

    /**
     * @param int|string $identifier
     * @param array $querystring|[]
     * @return mixed
     */
    public function get($identifier, $querystring = [])
    {
        $content = HospitalModel::findOrFail($identifier);

        return $content;
    }

    /**
     * @param int|string $identifier
     * @param array $data
     * @return mixed
     */
    public function update($identifier, $data)
    {
        $content = HospitalModel::findOrFail($identifier);

        DB::beginTransaction();

        try {

            $content->update($data);

            DB::commit();

        } catch (Exception $exception) {

            DB::rollback();

            Log::info($exception->getMessage());
        }

        return $content;
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create($data)
    {
        $content = null;

        DB::beginTransaction();

        try {

            $content = HospitalModel::create($data);

            DB::commit();

        } catch (Exception $exception) {

            DB::rollback();

            Log::info($exception->getMessage());
        }

        return $content;
    }

    /**
     * @param int|string $identifier
     * @return mixed
     */
    public function delete($identifier)
    {
        return $this->deactivate($identifier);
    }

    /**
     * @param int|string $identifier
     * @return mixed
     */
    public function activate($identifier)
    {
        $content = HospitalModel::withoutGlobalScope("activation")->findOrFail($identifier);

        DB::beginTransaction();

        try {

            $content->activate();

            DB::commit();

        } catch (Exception $exception) {

            DB::rollback();

            Log::info($exception->getMessage());
        }

        return $content;
    }

    /**
     * @param int|string $identifier
     * @return mixed
     */
    public function deactivate($identifier)
    {
        $content = HospitalModel::findOrFail($identifier);

        DB::beginTransaction();

        try {

            $content->deactivate();

            DB::commit();

        } catch (Exception $exception) {

            DB::rollback();

            Log::info($exception->getMessage());
        }

        return $content;
    }
};
