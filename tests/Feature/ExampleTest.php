<?php

it('returns a successful response', function () {
    $this->seed();

    $response = $this->get('/');

    $response->assertStatus(200);
});
