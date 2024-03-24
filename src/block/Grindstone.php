<?php

declare(strict_types=1);

namespace pocketmine\block;

use pocketmine\block\inventory\GrindstoneInventory;
use pocketmine\block\utils\FacesOppositePlacingPlayerTrait;
use pocketmine\block\utils\GrindstoneAttachment;
use pocketmine\data\runtime\RuntimeDataDescriber;
use pocketmine\item\Item;
use pocketmine\math\Facing;
use pocketmine\math\Vector3;
use pocketmine\player\Player;
use pocketmine\world\BlockTransaction;

class Grindstone extends Transparent{
	use FacesOppositePlacingPlayerTrait{
		describeBlockOnlyState as describeFacingState;
		place as placeFacing;
	}

	private int $attachmentBit = 0;

	protected function describeBlockOnlyState(RuntimeDataDescriber $w) : void{
		$this->describeFacingState($w);
		$w->int(2, $this->attachmentBit);
	}

	public function setAttachment(GrindstoneAttachment $attachment) : self{
		$this->attachmentBit = $attachment->toBit();
		return $this;
	}

	public function getAttachment() : GrindstoneAttachment{
		return GrindstoneAttachment::fromBit($this->attachmentBit);
	}

	public function onInteract(Item $item, int $face, Vector3 $clickVector, ?Player $player = null, array &$returnedItems = []) : bool{
		$player?->setCurrentWindow(new GrindstoneInventory($this->position));
		return true;
	}

	public function place(BlockTransaction $tx, Item $item, Block $blockReplace, Block $blockClicked, int $face, Vector3 $clickVector, ?Player $player = null) : bool{
		if($player !== null){
			$this->setAttachment(match($face){
				Facing::DOWN => GrindstoneAttachment::HANGING,
				Facing::UP => GrindstoneAttachment::STANDING,
				default => GrindstoneAttachment::SIDE
			});
		}
		return $this->placeFacing($tx, $item, $blockReplace, $blockClicked, $face, $clickVector, $player);
	}
}