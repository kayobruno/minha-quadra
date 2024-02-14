<?php

declare(strict_types=1);

arch('it verifies that all classes use strict types')
    ->expect('App')
    ->toUseStrictTypes();
