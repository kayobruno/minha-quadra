<?php

declare(strict_types=1);

arch('to ensure that all files within a given namespace have a __construct method.')
    ->expect('App\DataTransferObjects')
    ->toHaveConstructor();
