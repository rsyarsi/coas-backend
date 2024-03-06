<?php

namespace Src\V2\Hospitals\Repositories\Contracts;

interface HospitalContract
{
    /**
     * @return mixed
     */
    public function select();

    /**
     * @param array $querystring|[]
     * @return mixed
     */
    public function all($querystring = []);

    /**
     * @param int|string $identifier
     * @param array $querystring|[]
     * @return mixed
     */
    public function get($identifier, $querystring = []);

    /**
     * @param array $data
     * @return mixed
     */
    public function create($data);

    /**
     * @param int|string $identifier
     * @param array $data
     * @return mixed
     */
    public function update($identifier, $data);

    /**
     * @param int|string $identifier
     * @return mixed
     */
    public function delete($identifier);

    /**
     * @param int|string $identifier
     * @return mixed
     */
    public function activate($identifier);

    /**
     * @param int|string $identifier
     * @return mixed
     */
    public function deactivate($identifier);
};
