<?php

namespace App\Services\Telegram\Types;

use stdClass;
use App\Enums\TelegramUpdateType;
use App\Services\Telegram\Types\ChatMemberUpdated;

class TelegramUpdate
{
	private int $update_id;
	private ?TelegramUpdateType $type;
	private stdClass $properties;

	private array $entitiesMap = [
		'my_chat_member' => ChatMemberUpdated::class
	];

	public function __construct(
		stdClass $update,
	) {
		$this->properties = $update;
		$this->update_id = $update->update_id;
		$this->type = TelegramUpdateType::tryFrom($this->findType($update));		
	}

	public function getEntity(): ChatMemberUpdated | null
    {
        $type = $this->type ? $this->type->value : null;

        if (isset($this->entitiesMap[$type])) {
            $entityClass = $this->entitiesMap[$type];
            return new $entityClass($this->properties->{$type});
        }

        return null;
    }

	public function getChat(): ?TelegramChat
	{
		$entity = $this->getEntity();

		if($entity) {
			return $entity->getChat();
		}

		return null; 
	}

	public function getUpdateId(): int
	{
		return $this->update_id;
	}

	public function getType(): ?TelegramUpdateType
	{
 		return $this->type;
	}

	private function findType($update)
	{
 		$values = TelegramUpdateType::values();
		$attributes = get_object_vars($update);
		
		$matchedAttributes = array_intersect($values, array_keys($attributes));
		$firstMatchedAttribute = reset($matchedAttributes);
		
		return $firstMatchedAttribute ?: null;
	}
}
