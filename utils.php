<?php
declare(strict_types=1);

function get_seat_price($key): int
{
    $seat_price = 0;
    if ($key == "A" | $key == "B" | $key == "C") {
        $seat_price = 5000;
    } elseif ($key == "D" | $key == "E" | $key == "F") {
        $seat_price = 3500;
    } else {
        $seat_price = 2000;
    }
    return $seat_price;
}
