<?php
namespace App\Services;

class MediaManager
{
    private $uploadDir;
    private $allowedTypes;
    private $maxSize;

    public function __construct($uploadDir, $allowedTypes, $maxSize)
    {
        $this->uploadDir = $uploadDir;
        $this->allowedTypes = $allowedTypes;
        $this->maxSize = $maxSize;
    }

    public function uploadFile($file)
    {
        if ($file['error'] !== UPLOAD_ERR_OK)
        {
            throw new \Exception('Ошибка загрузки файла: ' . $file['error']);
        }

        if ($file['size'] > $this->maxSize)
        {
            throw new \Exception('Файл слишком большой. Максимальный размер: ' . $this->maxSize . 'MB');
        }

        $fileExtension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        if (!in_array($fileExtension, $this->allowedTypes))
        {
            throw new \Exception('Недопустимый тип файла. Разрешены: ' . implode(',', $this->allowedTypes));
        }

        $filename = uniqid() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '_', strtolower($file['name']));
        $filepath = $this->uploadDir . $filename;

        if (move_uploaded_file($file['tmp_name'], $filepath))
        {
            return [
                'filename' => $filename,
                'original_name' => $file['name'],
                'size' => $file['size'],
                'type' => $fileExtension,
                'url'  => '/uploads/' . $filename
            ];
        }

        throw new \Exception('Ошибка при сохранении файла');
    }

    public function getMediaFiles()
    {
        $files = [];
        $items = glob($this->uploadDir . '*');

        foreach ($items as $item)
        {
            if (is_file($item))
            {
                $files[] = [
                  'name' => basename($item),
                  'size' => filesize($item),
                  'modified' => filemtime($item),
                    'url' => '/uploads/' . basename($item)
                ];
            }
        }

        usort($files, function ($a, $b) {
            return $b['modified'] - $a['modified'];
        });

        return $files;
    }

    public function deleteFile($filename)
    {
        $filepath = $this->uploadDir . $filename;
        return file_exists($filepath);
    }

    public function isImage($filename)
    {
        $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        $imageTypes = ['jpg', 'jpeg', 'gif', 'webp'];
        return in_array($extension, $imageTypes);
    }
}
?>