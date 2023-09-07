<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\File\UploadedFile;

trait ImageUploadTrait
{
    /**
     * upLoadImageFileToS3
     *
     * @param  UploadedFile $imageFile
     * @param  string $directoryName
     * @return array
     */
    public function upLoadImageFileToS3(UploadedFile $imageFile, string $directoryName): array
    {
        $initial = [
            'status' => false,
            'fileName' => '',
            'filePath' => ''
        ];
        if ($imageFile) {
            $originName = $imageFile->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $imageFile->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '.' . $extension;
            $path = 'images/' . $directoryName . '/' . $fileName;
            Storage::disk('s3')->put($path, file_get_contents($imageFile), 's3');
            $initial = [
                'status' => true,
                'fileName' => $fileName,
                'filePath' => $path
            ];
        }
        return $initial;
    }

    /**
     * deleteImageS3
     *
     * @param  string $pathAvatar
     * @return void
     */
    public function deleteImageS3(string $pathAvatar): void
    {
        if (!empty($pathAvatar) && Storage::disk('s3')->exists($pathAvatar)) {
            Storage::disk('s3')->delete($pathAvatar);
        }
    }
}
