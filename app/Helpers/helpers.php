<?php

use App\Models\Player;

if (! function_exists('updateRanking')) {
    /**
     * Định dạng số điện thoại
     *
     * @param int $id
     * @return void
     */

    function updateRanking($id)
    {
        $player = Player::find($id);
        $point = $player->point;
        
        foreach (Player::POINT_RANKING as $key => $value) {
            if ($point == $key) {
                $player->player_ranking->ranking_id = $value;
                break;
            }
        }
        $player->player_ranking->save();
    }
}

if (! function_exists('markdownToHtml')) {
    /**
     * Chuyển đổi Markdown thành HTML
     *
     * @param string $markdown
     * @return string
     */
    function markdownToHtml($markdown)
    {
        if (empty($markdown)) {
            return '';
        }

        // Chuyển đổi các định dạng cơ bản
        $html = $markdown;
        
        // Bold: **text** -> <strong>text</strong>
        $html = preg_replace('/\*\*(.*?)\*\*/', '<strong>$1</strong>', $html);
        
        // Italic: *text* -> <em>text</em>
        $html = preg_replace('/\*(.*?)\*/', '<em>$1</em>', $html);
        
        // Underline: __text__ -> <u>text</u>
        $html = preg_replace('/__(.*?)__/', '<u>$1</u>', $html);
        
        // Separators: --- -> <hr>
        $html = preg_replace('/^---$/m', '<hr>', $html);
        
        // Image placeholders: [IMAGE_1: filename] -> <img>
        $html = preg_replace('/\[IMAGE_(\d+): ([^\]]+)\]/', '<div class="content-image"><img src="/storage/news/content/$2" alt="$2" loading="lazy"></div>', $html);
        
        // Bullet lists: • -> <li>
        $html = preg_replace('/^• (.+)$/m', '<li>$1</li>', $html);
        
        // Numbered lists: 1. -> <li>
        $html = preg_replace('/^\d+\. (.+)$/m', '<li>$1</li>', $html);
        
        // Wrap consecutive <li> elements in <ul>
        $html = preg_replace('/(<li>.*<\/li>)(\s*<li>.*<\/li>)*/', '<ul>$0</ul>', $html);
        
        // Line breaks: \n\n -> </p><p>
        $html = preg_replace('/\n\n/', '</p><p>', $html);
        
        // Single line breaks: \n -> <br>
        $html = preg_replace('/\n/', '<br>', $html);
        
        // Wrap in paragraphs
        $html = '<p>' . $html . '</p>';
        
        // Clean up empty paragraphs
        $html = preg_replace('/<p><\/p>/', '', $html);
        $html = preg_replace('/<p><br><\/p>/', '', $html);
        $html = preg_replace('/<p>\s*<\/p>/', '', $html);
        
        return $html;
    }
}
