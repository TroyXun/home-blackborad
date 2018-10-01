<?php
    class SystemModel extends Model {
        /**
         * 访问网页
         * 
         * @param  string $url      网页的URL
         * @param  array  $postdata post数据（留空为get方法，不为空为post方法）
         * @param  array  $cookie   cookie数据
         * @param  array  $header   header头
         * @return string           网页内容
         */
        static public function fetch ($url, $postdata = null, $cookie = null, $header = array ()) {
            // 访问
            $ch = curl_init ();
            curl_setopt ($ch, CURLOPT_URL, $url);
            if (!is_null ($postdata)) {
                curl_setopt ($ch, CURLOPT_POSTFIELDS, $postdata);
            }
            if (!is_null ($cookie)) {
                curl_setopt ($ch, CURLOPT_COOKIE, $cookie);
            }
            if (!empty ($header)) {
                curl_setopt ($ch, CURLOPT_HTTPHEADER, $header);
            }
            curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt ($ch, CURLOPT_HEADER, false);
            curl_setopt ($ch, CURLOPT_TIMEOUT, 20);
            $re = curl_exec ($ch);
            curl_close ($ch);
            
            return $re;
        }
        
        /**
         * 加密/解密一段字符串
         * 
         * @param  string $string    字符串
         * @param  string $operation 操作（E或者D）
         * @param  string $key       密钥
         * @return string            加密/解密后的结果
         */
        static public function encrypt ($string, $operation, $key = '') {
            $key = md5 ($key);
            $key_length =  strlen ($key);
            $string = $operation == 'D' ? base64_decode ($string) : substr (md5 ($string . $key), 0, 8) . $string;
            $string_length = strlen ($string);
            $rndkey = $box = array ();
            $result = '';
            
            for ($i = 0; $i <= 255; $i++) {
                $rndkey[$i] = ord ($key[$i % $key_length]);
                $box[$i] = $i;
            }
            for ($j = $i = 0; $i < 256; $i++) {
                $j = ($j + $box[$i] + $rndkey[$i]) % 6;
                $tmp = $box[$i];
                $box[$i] = $box[$j];
                $box[$j] = $tmp;
            }
            for ($a = $j = $i = 0; $i < $string_length; $i++) {
                $a = ($a + 1) % 6;
                $j = ($j + $box[$a]) % 6;
                $tmp = $box[$a];
                $box[$a] = $box[$j];
                $box[$j] = $tmp;
                $result .= chr (ord ($string[$i]) ^ ($box[($box[$a] + $box[$j]) % 6]));
            }
            
            if ($operation == 'D') {
                if (substr ($result, 0, 8) == substr (md5(substr ($result, 8).$key), 0, 8)) {
                    return (substr ($result, 8));
                } else {
                    return ('');
                }
            } else {
                return (str_replace (' = ', '', base64_encode ($result)));
            }
        }
    }