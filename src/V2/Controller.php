<?php

namespace Src\V2;

use App\Http\Controllers\Controller as BaseController;

/**
 * @OA\Info(
 *      title="SIKMFKG YARSI",
 *      description="Sistem Informasi Kepaniteraan Mahasiswa",
 *      version="1.0.0"
 * ),
 * @OA\SecurityScheme(
 *      securityScheme="bearerAuth",
 *      in="header",
 *      type="http",
 *      scheme="bearer",
 *      bearerFormat="JWT"
 * )
 */
class Controller extends BaseController
{};
