<?php

namespace App\Services\Telegram\Types;

use stdClass;

class TelegramUser
{
    private bool $is_bot;
    private int $id;
    private string $first_name;
    private ?string $last_name;
    private ?string $username;
    private ?string $language_code;
    private ?bool $is_premium;
    private ?bool $added_to_attachment_menu;
    private ?bool $can_join_groups;
    private ?bool $can_read_all_group_messages;
    private ?bool $supports_inline_queries;

    public function __construct(
        stdClass $properties,
    )
    {
        $this->is_bot                      = $properties->is_bot;
        $this->id                          = $properties->id;
        $this->first_name                  = $properties->first_name;
        $this->last_name                   = $properties->last_name ?? null;
        $this->username                    = $properties->username ?? null;
        $this->language_code               = $properties->language_code ?? null;
        $this->is_premium                  = $properties->is_premium ?? null;
        $this->added_to_attachment_menu    = $properties->added_to_attachment_menu ?? null;
        $this->can_join_groups             = $properties->can_join_groups ?? null;
        $this->can_read_all_group_messages = $properties->can_read_all_group_messages ?? null;
        $this->supports_inline_queries     = $properties->supports_inline_queries ?? null;
    }

    public function isBot(): bool
    {
        return $this->is_bot;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getFirstName(): string
    {
        return $this->first_name;
    }

    public function getLastName(): ?string
    {
        return $this->last_name;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function getLanguageCode(): ?string
    {
        return $this->language_code;
    }

    public function isPremium(): ?bool
    {
        return $this->is_premium;
    }

    public function isAddedToAttachmentMenu(): ?bool
    {
        return $this->added_to_attachment_menu;
    }

    public function canJoinGroups(): ?bool
    {
        return $this->can_join_groups;
    }

    public function canReadAllGroupMessages(): ?bool
    {
        return $this->can_read_all_group_messages;
    }

    public function supportsInlineQueries(): ?bool
    {
        return $this->supports_inline_queries;
    }
}