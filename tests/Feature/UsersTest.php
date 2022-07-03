<?php

it('has users page', function () {
    $response = $this->get('/pengguna');
    $response->assertStatus(302);
});

it('can access app', function () {
    $response = $this->get('/');
    $response->assertStatus(200);
});
