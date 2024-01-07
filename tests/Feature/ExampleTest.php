<?php

test('welcome page is ok', function () {
    $this
        ->get('/')
        ->assertOk();
});
