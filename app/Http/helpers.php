<?php

use System\Config\Config;
use Morilog\Jalali\Jalalian;
use Morilog\Jalali\CalendarUtils;

function activeMenu($url, $name = null)
{
    return currentUrl() == $url || strpos(currentUrl(), $name) !== false ? "active" : "";
}

function isValid($name)
{
    if (error($name) != null) {
        return "is-invalid";
    }
}

function stmpToDate($stamps)
{
    date_default_timezone_set("Asia/Tehran");
    $time = date("Y-m-d H:i:s", (int) substr($stamps, 0, -3));
    return $time;
}

function sellStatus($input)
{
    if ($input == 0) {
        return 'bg-danger';
    } else if ($input == 1) {
        return 'rent';
    } else {
        return 'bg-info';
    }
}
function convertToShamsi($date)
{
    $date = Jalalian::forge($date)->format('%Y ، %B %d');
    return $date;
}

function pageInate($date, $perPage)
{
    $countDate = count($date);
    $slides = ceil($countDate / $perPage);
    $currentUrl = isset($_GET["page"]) ? (int) $_GET["page"] : 1;
    $currentUrl = min($currentUrl, $slides);
    $currentUrl = max($currentUrl, 1);
    $startItem = ($currentUrl - 1) * $perPage;
    $date = array_slice($date, $startItem, $perPage);
    return $date;
}

function pageInateView($date, $perPage)
{
    $countDate = count($date);
    $slides = (int) ceil($countDate / $perPage);
    $currentUrl = isset($_GET["page"]) ? (int) $_GET["page"] : 1;
    $currentUrl = min($currentUrl, $slides);
    $currentUrl = max($currentUrl, 1);

    $pageView = ($currentUrl != 1) ? '<li><a href="' . pageInateUrl($currentUrl - 1) . '"><</a></li> ' : '';
    $pageView .= ($currentUrl >= 4) ? '<li><a href="' . pageInateUrl(1) . '">1</a></li> ... ' : '';
    $pageView .= ($currentUrl - 2) >= 1 ? '<li><a href="' . pageInateUrl($currentUrl - 2) . '">' . ($currentUrl - 2) . '</a></li> ' : '';
    $pageView .= ($currentUrl - 1) >= 1 ? '<li><a href="' . pageInateUrl($currentUrl - 1) . '">' . ($currentUrl - 1) . '</a></li> ' : '';
    $pageView .= '<li class="active"><span>' . $currentUrl . '</span></li> ';
    $pageView .= ($currentUrl + 1) <= $slides ? '<li><a href= "' . pageInateUrl($currentUrl + 1) . '">' . ($currentUrl + 1) . '</a></li> ' : '';
    $pageView .= ($currentUrl + 2) <= $slides ? '<li><a href="' . pageInateUrl($currentUrl + 2) . '">' . ($currentUrl + 2) . '</a></li> ' : '';
    $pageView .= ($currentUrl != $slides) ? '<li><a href="' . pageInateUrl($slides) . '">></a></li>' : '';

    return '
    <div class="row mt-5">
        <div class="col text-center">
            <div class="block-27">
                <ul>
                     ' . $pageView . '
                </ul>
            </div>
        </div>
    </div>
    ';
}
function pageInateUrl($num)
{
    $arrayUrl = explode("?", currentUrl());
    if (!empty($arrayUrl[1])) {
        $_GET['page'] = $num;
        $getVariables = array_map(function ($key, $value) {
            return $key . '=' . $value;
        }, array_keys($_GET), array_values($_GET));
        return $arrayUrl[0] . "?"  . implode("&", $getVariables);
    } else {
        return currentUrl() . '?page=' . $num;
    }
}