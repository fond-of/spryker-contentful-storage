<?php

namespace FondOfSpryker\Zed\ContentfulStorage\Business\Url;

interface UrlFormatterInterface
{
    /**
     * @param string $url
     * @param string $locale
     *
     * @return string
     */
    public function format(string $url, string $locale): string;
}
