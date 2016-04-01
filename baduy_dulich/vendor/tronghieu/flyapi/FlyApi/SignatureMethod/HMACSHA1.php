<?php

namespace FlyApi\SignatureMethod;


use FlyApi\Consumer;
use FlyApi\Request;
use FlyApi\SignatureMethod;
use FlyApi\Util;

class HMACSHA1 extends SignatureMethod {
    function getName() {
        return "HMAC-SHA1";
    }

    public function buildSignature(Request $request, Consumer $consumer) {
        $base_string = $request->getSignatureBaseString();
        $request->baseString = $base_string;
        $key_parts = array(
            $consumer->secret
        );
        $key_parts = Util::urlEncodeRfc3986($key_parts);
        $key = implode('&', $key_parts);

        $result = base64_encode(hash_hmac('sha1', $base_string, $key, true));
        return $result;
    }
}