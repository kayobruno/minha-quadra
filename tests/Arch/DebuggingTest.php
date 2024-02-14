<?php

declare(strict_types=1);

arch('it does not contain debug statements in code')
    ->expect(['dd', 'dump'])
    ->not->toBeUsed();
