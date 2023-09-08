<?php

use App\Models\Banner;

// COMMON
if (!defined('NOTIFICATION_SUCCESS')) define('NOTIFICATION_SUCCESS', 'success');
if (!defined('NOTIFICATION_ERROR')) define('NOTIFICATION_ERROR', 'error');
// END COMMON

// MEDIA COLLECTIONS
//-- Banner --
if (!defined('BANNER_COLLECTION')) define('BANNER_COLLECTION', Banner::BANNER_COLLECTION);
if (!defined('BANNER_RESIZE_NAME')) define('BANNER_RESIZE_NAME', Banner::BANNER_RESIZE_NAME);
//-- end Banner --

// END MEDIA COLLECTIONS