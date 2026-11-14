<?php
function request_string($source, $key)
{
    if (!isset($source[$key]) || !is_string($source[$key])) {
        return "";
    }

    return trim($source[$key]);
}

function is_valid_nis($nis)
{
    if (!preg_match('/^[0-9]+$/', $nis)) {
        return false;
    }

    $normalizedNis = ltrim($nis, "0");
    if ($normalizedNis === "") {
        return false;
    }

    return filter_var(
        $normalizedNis,
        FILTER_VALIDATE_INT,
        array("options" => array("min_range" => 1, "max_range" => 2147483647))
    ) !== false;
}

function is_valid_time($time)
{
    return preg_match('/^(?:[01][0-9]|2[0-3]):[0-5][0-9](?::[0-5][0-9])?$/', $time) === 1;
}

function is_valid_date($date)
{
    if (!preg_match('/^([0-9]{4})-([0-9]{2})-([0-9]{2})$/', $date, $matches)) {
        return false;
    }

    return checkdate((int) $matches[2], (int) $matches[3], (int) $matches[1]);
}

function show_page_error($status, $title, $message, $backUrl, $detail = "")
{
    http_response_code($status);
    $errorTitle = $title;
    $errorMessage = $message;
    $errorBackUrl = $backUrl;
    $errorDetail = $detail;
    include __DIR__ . "/page-error.php";
    exit;
}

function redirect_to($url)
{
    header("Location: " . $url);
    exit;
}
