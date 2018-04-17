<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: sam
 * Date: 22/11/2017
 * Time: 10:51
 */
namespace Coccoc\Entities;

class FileInfoEntity
{
    protected $filePath;

    protected $fileSize;

    protected $sentPeerJid;

    /**
     * @return mixed
     */
    public function getFilePath()
    {
        return $this->filePath;
    }

    /**
     * @param mixed $filePath
     */
    public function setFilePath($filePath)
    {
        $this->filePath = $filePath;
    }

    /**
     * @return mixed
     */
    public function getFileSize()
    {
        return $this->fileSize;
    }

    /**
     * @param mixed $fileSize
     */
    public function setFileSize($fileSize)
    {
        $this->fileSize = $fileSize;
    }

    /**
     * @return mixed
     */
    public function getSentPeerJid()
    {
        return $this->sentPeerJid;
    }

    /**
     * @param mixed $sentPeerJid
     */
    public function setSentPeerJid($sentPeerJid)
    {
        $this->sentPeerJid = $sentPeerJid;
    }

    public function toArray(): array
    {
        return [
            'file_path' => $this->getFilePath(),
            'file_size' => $this->getFileSize(),
            'sent_peer_jid' => $this->getSentPeerJid()
        ];
    }
}