<?php
/**
 * Created by PhpStorm.
 * User: sam
 * Date: 22/11/2017
 * Time: 10:56
 */
namespace Coccoc\Hydrators;

use Coccoc\Components\Hydrator\HydratorInterface;
use Coccoc\Entities\FileInfoEntity;

class FileInfoHydrator implements HydratorInterface
{

    public function hydrate(array $data): FileInfoEntity
    {
        $fileInfo = new FileInfoEntity();
        $fileInfo->setFilePath($data['file_path']);
        $fileInfo->setFileSize($data['file_size']);
        $fileInfo->setSentPeerJid($data['sent_peer_jid']);

        return $fileInfo;
    }
}

