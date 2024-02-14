<?php

declare(strict_types=1);

arch('it verifies that all classes in a folder are interfaces')
    ->expect('App\Contracts')
    ->toBeInterfaces();
