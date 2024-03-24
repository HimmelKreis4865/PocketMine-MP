<?php

declare(strict_types=1);

namespace pocketmine\block\utils;

enum GrindstoneAttachment : string{

	case STANDING = "standing";

	case HANGING = "hanging";

	case SIDE = "side";

	case MULTIPLE = "multiple";

	public function toBit() : int{
		return match($this){
			self::STANDING => 0,
			self::HANGING => 1,
			self::SIDE => 2,
			self::MULTIPLE => 3
		};
	}

	public static function fromBit(int $bit) : GrindstoneAttachment{
		return match($bit){
			0 => self::STANDING,
			1 => self::HANGING,
			2 => self::SIDE,
			3 => self::MULTIPLE
		};
	}
}