<?php

declare(strict_types=1);

namespace pocketmine\block\inventory;

use pocketmine\inventory\SimpleInventory;
use pocketmine\world\Position;

class GrindstoneInventory extends SimpleInventory implements BlockInventory{
	use BlockInventoryTrait;

	public const SLOT_INPUT = 0;

	public const SLOT_ADDITIONAL = 1;

	public function __construct(Position $holder){
		$this->holder = $holder;
		parent::__construct(2);
	}
}