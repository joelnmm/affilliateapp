<?php

/**
 * User: joelm
 * Date: 10/11/22
 * Time: 14:01
 */

namespace common\AWS;

require '../../vendor/autoload.php';

use Aws\S3\S3Client;
use Aws\Exception\AwsException;
Use Aws\Credentials\Credentials;

class S3 {

    public static function getS3Client(){
        $AccessKey = 'AKIAUD5HO7SG3OUSAR6D';
        $SecretKey = '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';
        
        $credentials = new Credentials($AccessKey, $SecretKey);

        return new S3Client([
            'region' => 'us-east-1',
            'version' => 'latest',
            'credentials' => $credentials,
        ]);

    }

    public static function subirArchivoS3($fileNameProperty,$model) {

        $s3Client = self::getS3Client();
        $bucketName = 'bittadvise-images';
        $file_content = $_FILES[$model]["tmp_name"]['imagen'];
        // $name = $_FILES[$model]["name"]['imagen'];
        $name = $fileNameProperty;
        $ext = explode('.', $name);
        $dateTime = date("Y-m-d H:i:s");
        $num_random = (string) rand(1000000, 1000000000);
        $filename = $bucketName . '_' . strtotime($dateTime) . '_' . $num_random . '.' . $name;

        $content = '';
        switch ($ext[1]) {
            case 'pdf':
                $content = 'application/pdf';
                break;
            case 'png':
                $content = 'application/image';
                break;
            case 'jpg':
                $content = 'application/image';
                break;
        }

        try {
            $s3Client->putObject([
                'Bucket' => $bucketName,
                'Key' => $filename,
                'Body' => fopen($file_content, 'r'),
                'ACL' => 'public-read',
                'ContentType' => $content,
                'StorageClass' => 'REDUCED_REDUNDANCY',

            ]);

            $url = 'https://bittadvise-images.s3.amazonaws.com/'. $filename;
            return $url;

        } catch (S3Exception $e) {
            return json_encode($e);
        }

    }

    public static function eliminarArchivoS3($filenameUrl){
        
        $s3Client = self::getS3Client();
        $bucketName = 'bittadvise-images';
        $file = explode('/',$filenameUrl)[3];

        try {

            $s3Client->deleteObject(array(
                'Bucket' => $bucketName,
                'Key'    => $file
            ));

            return true;

        } catch (S3Exception $e) {
            return json_encode($e);
        }
    }

}
