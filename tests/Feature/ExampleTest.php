<?php

it('returns a successful response', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
});


it('returns da successful response', function () {

    $response = $this->get('orders');

    $response->assertStatus(200);
});
