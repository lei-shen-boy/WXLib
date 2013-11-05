<?php
require_once 'HTTP/Request2.php';

class Basic
{
    
    const WX_API_HOST = 'https://api.weixin.qq.com';
    const WX_API_PATH = '/cgi-bin';
    
    const WX_API_TOKEN = '/token';
    const WX_API_UPLOAD_MEDIA = 'http://file.api.weixin.qq.com/cgi-bin/media/upload';
    const WX_API_DOWNLOAD_MEDIA = '/media/get';
    
    const WX_APPID = 'wxdd09ac20392be5cd';
    const WX_SECRET = '9092deff10e20af3af3b68e87aed800c';
    const WX_ACCESS_TOKEN = 'U3QwX-NAxOgtMi6wehc0zqFEJcHf04EoUKkzrCGYYeGlj6c--HbJW-JU8nGKaMAQ8VNZLTlJxbrPk4hWwPukWK7q2V4GTkwlZw4In2iuJMr1aXzltc6hmRINi3YEtEljRa2w8tbTJCmh2iAnNoldSg';
    
    
    static function getRequest($url='', $method=HTTP_Request2::METHOD_GET)
    {
        $request = new HTTP_Request2($url, $method);
        if ($request->getUrl()->getScheme() == 'https') {
            $request->setConfig(array(
                    'ssl_verify_peer' => false,
                    'ssl_verify_host' => false
            ));
        }
        
        /*
        $request->setConfig(array(
                'proxy_host'        => 'web-proxy.oa.com',
                'proxy_port'        => 8080,
        ));
        */
        
        return $request;
    }
    
    /**
     * 获取access_token
     * https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=APPID&secret=APPSECRET
     * https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=wxdd09ac20392be5cd&secret=9092deff10e20af3af3b68e87aed800c
     * @var unknown
     */
    static function getAccessTokenAPI()
    {
        return self::WX_API_HOST . self::WX_API_PATH . self::WX_API_TOKEN;
    }
    
    static function getUploadMediaAPI()
    {
        return self::WX_API_UPLOAD_MEDIA;
    }
    
    /**
     * access_token是公众号的全局唯一票据，公众号调用各接口时都需使用access_token。
     * 正常情况下access_token有效期为7200秒，重复获取将导致上次获取的access_token失效
     * @throws Exception
     * @return mixed
     */
    static function getAccessToken()
    {
        $request = self::getRequest(self::getAccessTokenAPI());
        $url = $request->getUrl();
        $url->setQueryVariables(array(
                'grant_type' => 'client_credential',
                'appid'       => self::WX_APPID,
                'secret' => self::WX_SECRET
        ));
        $response = $request->send();
        if ($response->getStatus() == 200) {
            $accessTokenArray = json_decode($response->getBody(), true);
            return $accessTokenArray['access_token'];
        } else {
            throw new Exception('get access token faild, https request status is ' . $response->getStatus());
        }
    }
    
    /**
     * 上传的多媒体文件有格式和大小限制，如下：
图片（image）: 256K，支持JPG格式
语音（voice）：256K，播放长度不超过60s，支持AMR与MP3格式
视频（video）：2MB，支持MP4格式
缩略图（thumb）：64KB，支持JPG格式
媒体文件在后台保存时间为3天，即3天后media_id失效。
     * @param unknown $type
     * @param unknown $file
     * @throws Exception
     * @return mixed
     */
    static function uploadMedia($type, $file)
    {
        $request = self::getRequest(self::getUploadMediaAPI(), HTTP_Request2::METHOD_POST);
        $url = $request->getUrl();
        $request->addPostParameter('access_token', self::WX_ACCESS_TOKEN);
        $request->addPostParameter('type', $type);
        $request->addUpload('media', $file);
        $response = $request->send();
        if ($response->getStatus() == 200) {
            $res = json_decode($response->getBody(), true);
            if ($res['errcode']) {
                throw new Exception('Error: ' . $res['errmsg']);
            }
            return $res;
        } else {
            throw new Exception('get access token faild, https request status is ' . $response->getStatus());
        }
    }
    
    static function getMediaUrl($mediaId)
    {
        // http://file.api.weixin.qq.com/cgi-bin/media/get?access_token=ACCESS_TOKEN&media_id=MEDIA_ID
        $request = self::getRequest('http://file.api.weixin.qq.com/cgi-bin/media/get');
        $url = $request->getUrl();
        $url->setQueryVariables(array(
                'access_token' => self::WX_ACCESS_TOKEN,
                'media_id' => $mediaId,
        ));
        return $url->getURL();
    }
    
    static function downloadMedia($mediaId, $des)
    {
        // http://file.api.weixin.qq.com/cgi-bin/media/get?access_token=ACCESS_TOKEN&media_id=MEDIA_ID
        $request = self::getRequest('http://file.api.weixin.qq.com/cgi-bin/media/get');
        $url = $request->getUrl();
        $url->setQueryVariables(array(
                'access_token' => self::WX_ACCESS_TOKEN,
                'media_id' => $mediaId,
        ));
        $url->getURL();
        file_put_contents($des, file_get_contents($url->getURL()));
    
        return 0;
    }
    
    static function uploadImage($image)
    {
        return self::uploadMedia('image', $image);
    }
}
?>