<?php

use App\Enums\ResponseStatus;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

function showToastr(string $message, ResponseStatus $status = ResponseStatus::SUCCESS): void
{
    session()->flash('status', $status);
    session()->flash('message', $message);
}

function strLimit(string $string, int $number = 100): string
{
    return Str::limit($string, $number, '...');
}

function getImageUrl(string $imagePath = '', string $disk = ''): string
{
    if ($disk && $imagePath && Storage::disk($disk)->exists($imagePath)) {
        return Storage::disk($disk)->url($imagePath);
    }
    if ($imagePath && !checkImageBase64($imagePath)) {
        $host = File::exists($imagePath) ? env('APP_URL') : config('const.image_host');
        if (!filter_var($imagePath, FILTER_VALIDATE_URL) && !str_contains($imagePath, $host)) {
            $imagePath = $host . $imagePath;
        }
    }
    return $imagePath;
}

function checkImageBase64(string $string): bool
{
    return strpos($string, 'data:image/') === 0;
}

function isTokenExpired(string $token): bool
{
    $tokenExplode = explode('_time_', base64_decode($token));
    $tokenTime = end($tokenExplode);
    $expiredTokenDay = Carbon::parse($tokenTime)->addDays(config('const.registered_token_expires'));
    return $expiredTokenDay->lt(now());
}

function countCharacters(string $text): string
{
    $string = preg_replace('/(\\r|>)/m', '', $text);
    return mb_strlen($string);
}

function formatDateTimeJp(string $time)
{
    return Carbon::parse($time)->format(config('const.format_Y年m月d日H時'));
}

function formatDateTimeDefault(string $time)
{
    return Carbon::parse($time)->format(config('const.format_date_Y-m-d_H_i_s'));
}

/**
 * up Load Image or attachment To S3
 * @param  string $directoryPath
 * @return array
 */
function upLoadImageOrAttachmentToS3($file, string $directoryPath): array
{
    $initial = [
        'status' => false,
        'fileName' => '',
        'filePath' => ''
    ];
    if ($file) {
        $originName = $file->getClientOriginalName();
        $fileName = pathinfo($originName, PATHINFO_FILENAME);
        $extension = $file->getClientOriginalExtension();
        $fileName = $fileName . '_' . time() . '.' . $extension;
        $path = $directoryPath . '/' . $fileName;
        Storage::disk('s3')->put($path, file_get_contents($file), 's3');
        $initial = [
            'status' => true,
            'fileName' => $fileName,
            'filePath' => $path,
            'fullPath' => config('filesystems.disks.s3.url').$path
        ];
    }
    return $initial;
}

function isSelectedOption($currentValue, $selectedValue): string
{
    return (isset($selectedValue) && $currentValue == $selectedValue) ? 'selected' : '';
}
