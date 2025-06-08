<?php

namespace App\Enums;

enum DegreeLevel: int
{
    case ASSOCIATE = 1;
    case BACHELOR = 2;
    case MASTER = 3;
    case PHD = 4;

    public function label(): string
    {
        return match($this) {
            self::ASSOCIATE => 'کاردانی',
            self::BACHELOR => 'کارشناسی',
            self::MASTER => 'کارشناسی ارشد',
            self::PHD => 'دکتری',
        };
    }

    public static function fromLabel(string $label): self
    {
        return match($label) {
            'کاردانی' => self::ASSOCIATE,
            'کارشناسی' => self::BACHELOR,
            'کارشناسی ارشد' => self::MASTER,
            'دکتری' => self::PHD,
            default => throw new \InvalidArgumentException('Invalid degree level label'),
        };
    }
} 