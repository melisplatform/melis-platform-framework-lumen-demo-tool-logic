<?php


$isCliReqs = php_sapi_name() == 'cli' ? true : false;
//third party file
$thirdPartyFolder = !$isCliReqs ? $_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'thirdparty/Laravel' : 'thirdparty/Lumen';

if (!is_dir($thirdPartyFolder))
    MelisPlatformFrameworks\Support\MelisPlatformFrameworks::downloadFrameworkSkeleton('lumen');