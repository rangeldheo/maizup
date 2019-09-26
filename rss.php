<?php

header('Content-Type: application/xml');

require './_app/Config.inc.php';
$Read = new Read;
$getFeed = filter_input(INPUT_GET, 'app', FILTER_DEFAULT);
$Feed = strip_tags(trim($getFeed));

echo '<?xml version="1.0" encoding="UTF-8" ?>' . "\r\n";

if ($Feed == 'instant-articles'):
    echo '<rss version="2.0" xmlns:content="http://purl.org/rss/1.0/modules/content/" xmlns:dc="http://purl.org/dc/elements/1.1/">' . "\r\n";
else:
    echo '<rss version="2.0">' . "\r\n";
endif;

echo '<channel>' . "\r\n";

echo '<title>' . SITE_NAME . ' - ' . SITE_SUBNAME . '</title>' . "\r\n";
echo '<link>' . BASE . '</link>' . "\r\n";
echo '<description>' . SITE_DESC . '</description>' . "\r\n";
echo '<language>pt-br</language>' . "\r\n";

switch ($Feed):
    case('products'):
        $Read->ExeRead(DB_PDT, "WHERE pdt_inventory >= 1 AND pdt_status = 1 ORDER BY pdt_created DESC");
        if ($Read->getResult()):
            foreach ($Read->getResult() as $ReadPdt):
                echo '<item>' . "\r\n";
                echo '<title>' . $ReadPdt['pdt_title'] . '</title>' . "\r\n";
                echo '<link>' . BASE . '/produto/' . $ReadPdt['pdt_name'] . '</link>' . "\r\n";
                echo '<pubDate>' . date('D, d M Y H:i:s O', strtotime($ReadPdt['pdt_created'])) . '</pubDate>' . "\r\n";
                echo '<description>' . str_replace('&', 'e', $ReadPdt['pdt_subtitle']) . '</description>' . "\r\n";
                echo '<enclosure type="image/*" url="' . BASE . '/uploads/' . $ReadPdt['pdt_cover'] . '"/>' . "\r\n";

                //FB ADS PRODUCTS
                echo '<id>product_' . $ReadPdt['pdt_id'] . '</id>' . "\r\n";
                echo '<image_link>' . BASE . "/uploads/" . $ReadPdt['pdt_cover'] . '</image_link>' . "\r\n";
                echo '<condition>new</condition>' . "\r\n";
                echo '<price>' . $ReadPdt['pdt_price'] . '</price>' . "\r\n";

                $Read->FullRead("SELECT SUM(stock_inventory) As PdtTotalStock FROM " . DB_PDT_STOCK . " WHERE pdt_id = :pdt", "pdt={$ReadPdt['pdt_id']}");
                if ($Read->getResult()['0']['PdtTotalStock'] >= 1):
                    echo '<availability>in stock</availability>' . "\r\n";
                else:
                    echo '<availability>out of stock</availability>' . "\r\n";
                endif;

                $Read->LinkResult(DB_PDT_BRANDS, "brand_id", $ReadPdt['pdt_brand'], 'brand_title');
                $PdtGetBrand = ($Read->getResult() ? $Read->getResult()[0]['brand_title'] : SITE_NAME);
                echo '<brand>' . $PdtGetBrand . '</brand>' . "\r\n";

                $Read->LinkResult(DB_PDT_CATS, "cat_id", $ReadPdt['pdt_subcategory'], 'cat_title');
                $PdtGetSubCategory = $Read->getResult()[0]['cat_title'];
                echo '<google_product_category>' . "{$PdtGetSubCategory}" . '</google_product_category>' . "\r\n";
                echo '</item>' . "\r\n";
            endforeach;
        endif;
        break;
    case('realty'):
        $Read->ExeRead(DB_IMOBI, "WHERE realty_status = 1 ORDER BY realty_date DESC");
        if ($Read->getResult()):
            foreach ($Read->getResult() as $ReadRealty):
                echo '<item>' . "\r\n";
                echo '<title>' . $ReadRealty['realty_title'] . '</title>' . "\r\n";
                echo '<link>' . BASE . '/imovel/' . $ReadRealty['realty_name'] . '</link>' . "\r\n";
                echo '<pubDate>' . date('D, d M Y H:i:s O', strtotime($ReadRealty['realty_date'])) . '</pubDate>' . "\r\n";
                echo '<description>' . str_replace('&', 'e', Check::Words($ReadRealty['realty_desc'], 10)) . '</description>' . "\r\n";
                echo '<enclosure type="image/*" url="' . BASE . '/uploads/' . $ReadRealty['realty_cover'] . '"/>' . "\r\n";

                //FB ADS PRODUCTS
                echo '<id>realty_' . $ReadRealty['realty_id'] . '</id>' . "\r\n";
                echo '<image_link>' . BASE . "/uploads/" . $ReadRealty['realty_cover'] . '</image_link>' . "\r\n";
                echo '<condition>new</condition>' . "\r\n";
                echo '<price>' . ($ReadRealty['realty_price'] ? $ReadRealty['realty_price'] : '0.00') . '</price>' . "\r\n";
                echo '<availability>in stock</availability>' . "\r\n";
                echo '<brand>' . SITE_NAME . '</brand>' . "\r\n";
                echo '<google_product_category>Imóvel</google_product_category>' . "\r\n";
                echo '</item>' . "\r\n";
            endforeach;
        endif;
        break;
    case('courses'):
        $Read->ExeRead(DB_EAD_COURSES, "WHERE course_status = 1 ORDER BY course_title ASC");
        if ($Read->getResult()):
            foreach ($Read->getResult() as $ReadCourse):
                echo '<item>' . "\r\n";
                echo '<title>' . $ReadCourse['course_title'] . '</title>' . "\r\n";
                echo '<link>' . BASE . "/curso/{$ReadCourse['course_name']}" . '</link>' . "\r\n";
                echo '<pubDate>' . date('D, d M Y H:i:s O', strtotime($ReadCourse['course_created'])) . '</pubDate>' . "\r\n";
                echo '<description>' . str_replace('&', 'e', Check::Words($ReadCourse['course_headline'], 10)) . '</description>' . "\r\n";
                echo '<enclosure type="image/*" url="' . BASE . '/uploads/' . $ReadCourse['course_cover'] . '"/>' . "\r\n";

                //FB ADS PRODUCTS
                echo '<id>course_' . $ReadCourse['course_id'] . '</id>' . "\r\n";
                echo '<image_link>' . BASE . "/uploads/" . $ReadCourse['course_cover'] . '</image_link>' . "\r\n";
                echo '<condition>new</condition>' . "\r\n";
                echo '<price>' . $ReadCourse['course_vendor_price'] . '</price>' . "\r\n";
                echo '<availability>in stock</availability>' . "\r\n";
                echo '<brand>' . SITE_NAME . '</brand>' . "\r\n";
                $Read->FullRead("SELECT segment_title FROM " . DB_EAD_COURSES_SEGMENTS . " WHERE segment_id = :seg", "seg={$ReadCourse['course_segment']}");
                $Segment = ($Read->getResult() ? $Read->getResult()[0]['segment_title'] : 'Curso Online');
                echo '<google_product_category>' . $Segment . '</google_product_category>' . "\r\n";
                echo '</item>' . "\r\n";
            endforeach;
        endif;
        break;
    case ('instant-articles'):
        $Read->FullRead("SELECT "
                . "u.user_id, "
                . "u.user_name, "
                . "p.* "
                . "FROM " . DB_POSTS . " p "
                . "INNER JOIN " . DB_USERS . " u ON u.user_id = p.post_author "
                . "WHERE p.post_status = 1 "
                . "AND p.post_instant_article = 1 "
                . "AND p.post_date <= NOW() ORDER BY p.post_date DESC");

        if ($Read->getResult()):

            $Content = array();
            $InstantArt = new InstantArticles;

            foreach ($Read->getResult() as $ReadPosts):

                // Slides 
                $Slides = null;
                $Read->ExeRead(DB_POSTS_IMAGE, " WHERE post_id = :pid", "pid={$ReadPosts['post_id']}");
                if ($Read->getResult()) {
                    foreach ($Read->getResult() as $slide):
                        $Slides[] = BASE . '/uploads/' . $slide['image'];
                    endforeach;
                }

                // Atigos Relacionados
                $ArtRel = null;
                $Read->FullRead("SELECT * FROM " . DB_POSTS . " WHERE post_status = 1 AND post_date <= NOW() AND post_category = {$ReadPosts['post_category']} AND post_id != {$ReadPosts['post_id']} ORDER BY post_date DESC LIMIT 5");
                if ($Read->getResult()) {
                    foreach ($Read->getResult() as $rel):
                        $ArtRel[] = BASE . '/artigo/' . $rel['post_name'];
                    endforeach;
                }

                $AnalyticsCode = '';
                $Read->ExeRead(DB_WC_CODE);
                if ($Read->getResult()):
                    foreach ($Read->getResult() as $code):
                        $AnalyticsCode = $AnalyticsCode . $code['code_script'];
                    endforeach;
                endif;

                $Content = [
                    'canonical' => BASE . '/artigo/' . $ReadPosts['post_name'], // Obrigatório
                    'title' => $ReadPosts['post_title'], // Obrigatório
                    'desc' => str_replace('&', 'e', $ReadPosts['post_subtitle']), // Obrigatório
                    'capa' => BASE . '/uploads/' . $ReadPosts['post_cover'], // Obrigatório
                    'data_pub' => $ReadPosts['post_date'], // Obrigatório
                    'data_mod' => $ReadPosts['post_date'], // Obrigatório
                    'conteudo' => $ReadPosts['post_content'], // Obrigatório
                    'site_name' => SITE_NAME, // Obrigatório
                    'author' => $ReadPosts['user_name'], // Opcional
                    'slides' => $Slides, // Opcional - é um array('slide01', 'slide02', 'slide03')
                    'artigos_rel' => $ArtRel, // Opcional - é um array('aticle01', 'aticle02', 'aticle03') com max de 3 links - links - http://example.com/article.html
                    'analytics' => $AnalyticsCode // Opcional - código analytics
                ];

                echo '<item>' . "\r\n";
                echo '<title>' . $ReadPosts['post_title'] . '</title>' . "\r\n";
                echo '<link>' . BASE . '/artigo/' . $ReadPosts['post_name'] . '</link>' . "\r\n";
                echo '<pubDate>' . date('D, d M Y H:i:s O', strtotime($ReadPosts['post_date'])) . '</pubDate>' . "\r\n";
                echo '<author>' . $ReadPosts['user_name'] . '</author>' . "\r\n";
                echo '<description>' . str_replace('&', 'e', $ReadPosts['post_subtitle']) . '</description>' . "\r\n";
                echo '<enclosure type="image/*" url="' . BASE . '/uploads/' . $ReadPosts['post_cover'] . '"/>' . "\r\n";
                echo '<content:encoded>' . str_replace('</figure></p>', '</figure>', str_replace('<p><figure>', '<figure>', $InstantArt->ArtCreate($Content))) . '</content:encoded>' . "\r\n";
                echo '</item>' . "\r\n";

                $Content = null;
            endforeach;
        endif;
        break;
    default:
        $Read->ExeRead(DB_POSTS, "WHERE post_status = 1 AND post_date <= NOW() ORDER BY post_date DESC");
        if ($Read->getResult()):
            foreach ($Read->getResult() as $ReadPosts):
                echo '<item>' . "\r\n";
                echo '<title>' . $ReadPosts['post_title'] . '</title>' . "\r\n";
                echo '<link>' . BASE . '/artigo/' . $ReadPosts['post_name'] . '</link>' . "\r\n";
                echo '<pubDate>' . date('D, d M Y H:i:s O', strtotime($ReadPosts['post_date'])) . '</pubDate>' . "\r\n";
                echo '<description>' . str_replace('&', 'e', $ReadPosts['post_subtitle']) . '</description>' . "\r\n";
                echo '<enclosure type="image/*" url="' . BASE . '/uploads/' . $ReadPosts['post_cover'] . '"/>' . "\r\n";
                echo '</item>' . "\r\n";
            endforeach;
        endif;
        break;
endswitch;

echo '</channel>' . "\r\n";
echo '</rss>' . "\r\n";
