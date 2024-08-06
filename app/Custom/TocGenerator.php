<?php

namespace App\Custom;

use Illuminate\Support\Collection;

class TocGenerator
{
    /**
     * Generate Table of Contents of the article content
     */
    public static function generateToc($content)
    {
        preg_match_all('/<h([1-6])*[^>]*>(.*?)<\/h[1-6]>/si', $content, $matches);
        
        // Check if no headings are found
        if (empty($matches[0])) {
            return ''; // Return an empty string or any default value you prefer
        }

        $toc = "<ul class='list--group small'>";
        $toc .= "<span class='small mb-2'>Table of Content</span>";
        $previous = 2;

        foreach ($matches[0] as $i => $match) {
            $current_heading = $matches[1][$i];
            $text = strip_tags($matches[2][$i]);
            $slug = strtolower(str_replace("--", "-", preg_replace('/[^\da-z]/i', '-', $text)));
            $heading_anchor = str_replace($text, '<a class="text-reset text-decoration-none" name="' . $slug . '">' . $text . '</a>', $match);
            $content = str_replace($match, $heading_anchor, $content);

            // Close previous levels
            if ($previous > $current_heading) {
                $toc .= str_repeat('</ul>', ($previous - $current_heading));
            }

            // Open new levels
            if ($previous < $current_heading) {
                $toc .= str_repeat('<ul>', ($current_heading - $previous));
            }

            $toc .= '<li class="list--group-item text-truncate"><a class="text-decoration-none fw-bold" href="#' . $slug . '">' . $text . '</a></li>';

            $previous = $current_heading;
        }

        // Close remaining open lists
        if ($previous > 2) {
            $toc .= str_repeat('</ul>', ($previous - 2));
        }

        $toc .= "</ul>";

        return $toc;
    }
}