<?php

//function imagestyle($url, $style = 'small',$cache = true)
//{
//    $params = '';
//    if ($style == 'fit200x200') $params = '?w=200&h=200&fit=crop';
//    elseif ($style == 'fit100x100') $params = '?w=100&h=100&fit=crop';
//    elseif ($style == 'round300') $params = '?w=300&h=300&fit=crop';
//    elseif ($style == 'width750') $params = '?w=750';
//    elseif($style == 'fit500x280') $params = '?w=500&h=280&fit=crop';
//    elseif ($style == 'round200') $params = '?w=200&h=200&fit=crop';
//    elseif ($style == 'round100') $params = '?w=100&h=100&fit=crop';
//    elseif ($style == 'round50') $params = '?w=50&h=50&fit=crop';
//    elseif ($style == 'grayscale') $params = '?filt=greyscale';
//
//    if(starts_with($url, 'https://interacpedia.s3.us-west-2.amazonaws.com/')){
//        $url = str_replace('https://interacpedia.s3.us-west-2.amazonaws.com/','/img/', $url);
//    } else if(starts_with($url, '/images/')){
//        $url = '/img'.$url;
//    }
//    $url .= $params;
//    return $url;
//}


/**
 * Return browser prefered language
 * @param $available_languages
 * @param $http_accept_language
 * @param string $default_language
 * @return int|null|string
 */
function prefered_language($available_languages, $http_accept_language, $default_language = 'es')
{
    $available_languages = array_flip($available_languages);
    $langs               = array();
    preg_match_all('~([\w-]+)(?:[^,\d]+([\d.]+))?~', strtolower($http_accept_language), $matches, PREG_SET_ORDER);
    foreach ($matches as $match) {
        list($a, $b) = explode('-', $match[1]) + array('', '');
        $value = isset($match[2]) ? (float)$match[2] : 1.0;
        if (isset($available_languages[$match[1]])) {
            $langs[$match[1]] = $value;
            continue;
        }
        if (isset($available_languages[$a])) {
            $langs[$a] = $value - 0.1;
        }
    }
    if ($langs) {
        arsort($langs);
        return key($langs); // We don't need the whole array of choices since we have a match
    } else {
        return $default_language;
    }
}

/**+
 * Returns browser language
 * @param $websiteLanguages
 * @return string
 */
function getBrowserLocale($websiteLanguages)
{
    if (!isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
        $_SESSION['lang'] = 'es';
        return strtolower('es');
    }
    $lang = prefered_language($websiteLanguages, $_SERVER["HTTP_ACCEPT_LANGUAGE"], 'es');
    return $lang;
}

function url_exists($url) {
    if(!starts_with($url, 'http'))return false;
    $headers = @get_headers($url);
    return strstr(implode(' ',$headers),'200 OK');
}