<?php

use App\Models\Participant;

it('allows mass assignment for user_id', function () {
    $participant = new Participant();

    expect($participant->getFillable())->toContain('user_id');
});
