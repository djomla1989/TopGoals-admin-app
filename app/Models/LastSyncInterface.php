<?php

namespace App\Models;

interface LastSyncInterface
{
    public function getLastSync(): \DateTime;
}
