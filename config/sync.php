<?php

return [
    'rateLimit' => [
        'jobs' => 5, //number of jobs executed
        'interval' => 1, //timespan for jobs
        'releaseAfter' => 10, //release after seconds
    ],
    'syncInactive' => false,
];
