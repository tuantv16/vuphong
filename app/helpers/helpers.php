<?php 
     function _cutTect($str, $length, $minword = 3) {
         $sub = '';
         $len = 0;
         foreach (explode(' ', $str) as $word) {
             $part = (($sub != '') ? ' ' : '') . $word;
             $sub .= $part;
             $len += strlen($part);
             if (strlen($word) > $minword && strlen($sub) >= $length) {
                 break;
             }
         }
         return $sub . (($len < strlen($str)) ? '...' : '');
     }
     
     function replaceWhitespace($str) {
         $result = $str;
         foreach (array(
     "  ", " \t", " \r", " \n",
     "\t\t", "\t ", "\t\r", "\t\n",
     "\r\r", "\r ", "\r\t", "\r\n",
     "\n\n", "\n ", "\n\t", "\n\r",
         ) as $replacement) {
             $result = str_replace($replacement, $replacement[0], $result);
         }
         return $str !== $result ? replaceWhitespace($result) : $result;
     }
     function getplaintextintrofromhtml($html) {
         // Remove the HTML tags
         $html = strip_tags($html, '<style>');
         $html = html_entity_decode($html, ENT_QUOTES, 'UTF-8');
         $html = html_entity_decode($html, ENT_QUOTES, 'UTF-8');
         return replaceWhitespace($html);
     }

     function cat_fixed($classify) {
        $text='';
        switch ($classify)
        {
            case 1:
            {
                $text = 'Bài viết nổi bật';
                break;
            }
            case 2:
            {
                $text = "Thông báo toàn trường";
                break;
            }
            case 3:
            {
                $text = "Kế hoạch của trường";
                break;
            }
            case 4:
            {
                $text = "Thông tin chung";
                break;
            }
            case 5:
            {
                $text = "Kết quả điểm thi các kỳ";
                break;
            }
            case 'tuyen-sinh':
            {
                $text = "Tuyển sinh";
                break;
            }
            case 7:
            {
                $text = "Thời khóa biểu";
                break;
            }
            case 8:
            {
                $text = "Tài liệu môn học";
                break;
            }

            case 9:
            {
                $text = "Thành tích";
                break;
            }

            case 10:
            {
                $text = "Kết quả đạt được";
                break;
            }

            case 11:
            {
                $text = "Học sinh tiêu biểu";
                break;
            }

            case 12:
            {
                $text = "Báo đài";
                break;
            }

            default:
            {
                echo 'Không thuộc danh mục nào';
            }
        }
        return $text;
     }
?>