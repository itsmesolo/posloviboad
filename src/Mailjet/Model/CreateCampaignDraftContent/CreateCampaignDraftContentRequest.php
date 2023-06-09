<?php

namespace App\Mailjet\Model\CreateCampaignDraftContent;

final readonly class CreateCampaignDraftContentRequest
{
    public function __construct(public int $campaignId, public string $htmlPart)
    {
    }

    public function payload(): string
    {
        return json_encode([
            'Html-part' => $this->htmlPart,
        ], \JSON_THROW_ON_ERROR | \JSON_UNESCAPED_UNICODE);
    }
}
