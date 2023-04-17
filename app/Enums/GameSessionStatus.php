<?php

namespace App\Enums;

enum GameSessionStatus: int
{
    case Ongoing = 1;
    case Finished = 2;
}
