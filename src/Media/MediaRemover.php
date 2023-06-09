<?php

namespace App\Media;

use App\Entity\Media;
use League\Flysystem\FilesystemOperator;

final readonly class MediaRemover
{
    public function __construct(private FilesystemOperator $mediaStorage)
    {
    }

    public function delete(Media $media): void
    {
        if (null === ($path = $media->getPath())) {
            return;
        }

        $this->mediaStorage->delete($path);
    }
}
