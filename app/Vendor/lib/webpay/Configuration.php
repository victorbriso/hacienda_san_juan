<?php
namespace Transbank\Webpay;

class Configuration {

    private $environment;
    private $commerce_code;
    private $private_key;
    private $public_cert;
    private $webpay_cert;
    private $store_codes;

    private $commerce_mail;

    function __construct() {
    }

    public function Configuration() {
    }

    public function getEnvironment() {
        return $this->environment;
    }

    public function setEnvironment($environment) {
        $this->environment = $environment;
    }

    public function getCommerceCode() {
        return $this->commerce_code;
    }

    public function setCommerceCode($commerce_code) {
        $this->commerce_code = $commerce_code;
    }

    public function getPrivateKey() {
        return $this->private_key;
    }

    public function setPrivateKey($private_key) {
        $this->private_key = $private_key;
    }

    public function getPublicCert() {
        return $this->public_cert;
    }

    public function setPublicCert($public_cert) {
        $this->public_cert = $public_cert;
    }

    public function getWebpayCert() {
        return $this->webpay_cert;
    }

    public function setWebpayCert($webpay_cert) {
        $this->webpay_cert = $webpay_cert;
    }

    public function setStoreCodes($store_codes) {
        $this->store_codes = $store_codes;
    }

    public function getStoreCodes() {
        return $this->store_codes;
    }

    public function setCommerceMail($commerce_mail) {
        $this->commerce_mail = $commerce_mail;
    }

    public function getCommerceMail() {
        return $this->commerce_mail;
    }

    public function getEnvironmentDefault() {
        $modo = $this->environment;
        if (!isset($modo) || $modo == "") {
            $modo = "PRODUCCION";
        }
        return $modo;
    }

    public static function forTestingWebpayPlusNormal() {
        $configuration = new Configuration();
        $configuration->setCommerceCode(597035622535);
        $configuration->setPrivateKey(
            "-----BEGIN RSA PRIVATE KEY-----\n" .
            "MIIEpQIBAAKCAQEAxbkaKSQDoZrscYVoiyilu7XV1xFNVUmOPrUliupuPowsmYvM\n" .
            "mnIIz2d2NaYoGoNd87rCmjH9aozxn4QGuIy27NbwupY2zKm27IW7VPiWg4pU/51I\n" .
            "IG2tB+g89SYz+PV5PWFiiPQmXDyXN8mYFxYCxyZ9xzxvTyl9LLXrnZDJ0D7ypVDA\n" .
            "Sp3Q6AYZJ+4CenJJsiCJLn/IpoIy3yreDJfzD+sDr8xKG7vYAVpryrKCYsovmy7G\n" .
            "DXdusfkt0x8bPMwdsVWfNhXADZq+m0sxf8dk6jLnK8xcfMLGIkaH6aWW+cQJ2zJj\n" .
            "Qk+/nVTj+QhBRpZzq1D42e2vF+Uw87QOlHVBzwIDAQABAoIBAQC1saOYqr+rgfJF\n" .
            "X5LyTif+ltorCHtIJI/SkCQvw74LPES/1Pfv9VqjPTAjnMy9kHqFvtmVWNrHTz26\n" .
            "mFiUvrpaaipNTDyPVmYCc+Hx835c4oG5Y48kPaUD3yYlITYhUXJYNWWW9MVLfWJ4\n" .
            "oYhhrphe6cArlh2zYSzmKUabRLIv6goHlkc2iyLO/4sjp81Bbkx3PMptMuhjgD57\n" .
            "im2m3LYEtU6LmzRQQMhkKR2zbqSQUVm59qHY0+RCJ2AHq+mcGbMYUicyHJQQz/I6\n" .
            "QwkjJlJnPYU2aICJz/eBHyXQgz8p+EFjbzYms96VvqctixYKcTttqTUjWbzmrlne\n" .
            "94Xgf/wBAoGBAPGGaTqgI7dZ2fOuxL8wHFc4d4ZJpdNE5gLLon/eNemGIVqPEmcX\n" .
            "JeV8ye7VOO8/FY0HOQDnLxyqQ20wV/VsNYfcOLinAGvK5K8xMl7eoMqJwS7OiW7E\n" .
            "DrsQ/4mfvEfUSJjIuQYvWyj5ngIwK+PDmClu9FVQIPJPb24fLUI+NnyXAoGBANGS\n" .
            "qSjXjzZIG/v4zwGNAdMHoaiqpNEabpxe2loptsteWPMfMDq0pipnPpfFRPeH3P3w\n" .
            "Y0nYP1rqAcgNpKjoyWTsNwUCsF84w6Zb/vamY9viJRW6pxT0e/7Ap2fp+ZDKYa9B\n" .
            "D21Nz9bNfGdyIooJWwjP7gnGrQrcIsh8lIQkKbOJAoGABKAFTdkZNf6jfNYg8GRU\n" .
            "dpsfNtQcN9J+8RjDMN2pfKJT6y8INC8uS5m7KDavE23K1NuJjOngbhUYm3Osi4eZ\n" .
            "8tMVxvtzt5y4Cl7Pzx9GRvqiV2ofGZ7phU2LBzCm410+UqatXF/1x/AXxYT0ojTx\n" .
            "qgF07llNeDZrNNml/TnBw1sCgYEArdm6FjVrih4biNUH9ENjBgrIokCc5RHGPFW7\n" .
            "URxVlTM5GsX+nlSJm5d2JzTwV18PhmDKHNIVDHge7jPTKoOhveTuZ2upn/RY6UJb\n" .
            "qYSyRg+9r97dB9cgnV54AQ3ph6E7k8Sm5YetKIXh83aNDHFiYVcMInP7zIx9Fk+y\n" .
            "bEQLi/ECgYEAw02YwIL0Mx5MI1czJgT4bl4CvAXS2yqRFXbDMwA8DMqMqW037flB\n" .
            "j2z4i5vaEjhflsmaOGI8AWKHKqNre9IH+f1uhsnJlI2+54/6CsGuTc0b8Ok+vmbr\n" .
            "ElEEBRZxfUWfHfx52UOG2XjH+PFbqQcaAAn+lEhA6KT5IS+eiCT1qDw=\n" .
            "-----END RSA PRIVATE KEY-----"
        );
        $configuration->setPublicCert(
            "-----BEGIN CERTIFICATE-----\n" .
            "MIIDtjCCAp4CCQDLor1+TWmmmDANBgkqhkiG9w0BAQUFADCBnDELMAkGA1UEBhMC\n" .
            "Y2wxEzARBgNVBAgTCnZhbHBhcmFpc28xFDASBgNVBAcTC3NhbiBhbnRvbmlvMR8w\n" .
            "HQYDVQQKExZ2aW5hIGhhY2llbmRhIHNhbiBqdWFuMRUwEwYDVQQDEww1OTcwMzU2\n" .
            "MjI1MzUxKjAoBgkqhkiG9w0BCQEWG2NvbnRhY3RvQGhhY2llbmRhc2FuanVhbi5j\n" .
            "bDAeFw0yMDA3MjgxODQ3NDNaFw0yNDA3MjcxODQ3NDNaMIGcMQswCQYDVQQGEwJj\n" .
            "bDETMBEGA1UECBMKdmFscGFyYWlzbzEUMBIGA1UEBxMLc2FuIGFudG9uaW8xHzAd\n" .
            "BgNVBAoTFnZpbmEgaGFjaWVuZGEgc2FuIGp1YW4xFTATBgNVBAMTDDU5NzAzNTYy\n" .
            "MjUzNTEqMCgGCSqGSIb3DQEJARYbY29udGFjdG9AaGFjaWVuZGFzYW5qdWFuLmNs\n" .
            "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAxbkaKSQDoZrscYVoiyil\n" .
            "u7XV1xFNVUmOPrUliupuPowsmYvMmnIIz2d2NaYoGoNd87rCmjH9aozxn4QGuIy2\n" .
            "7NbwupY2zKm27IW7VPiWg4pU/51IIG2tB+g89SYz+PV5PWFiiPQmXDyXN8mYFxYC\n" .
            "xyZ9xzxvTyl9LLXrnZDJ0D7ypVDASp3Q6AYZJ+4CenJJsiCJLn/IpoIy3yreDJfz\n" .
            "D+sDr8xKG7vYAVpryrKCYsovmy7GDXdusfkt0x8bPMwdsVWfNhXADZq+m0sxf8dk\n" .
            "6jLnK8xcfMLGIkaH6aWW+cQJ2zJjQk+/nVTj+QhBRpZzq1D42e2vF+Uw87QOlHVB\n" .
            "zwIDAQABMA0GCSqGSIb3DQEBBQUAA4IBAQAWfhfX99eIVXbJpOPYq3lUiFbES8jE\n" .
            "4Aat6S07iPmRL4eUxrvCyz+VXOW5sScas8IRr/Zs0WReI/51myUMOgF0TqKnIRAv\n" .
            "9xstrw65emfDQhgRlWO84HgFvwaATdcyJIt+REsPsHg4cm3BTjRRnkVO+TmcD+c2\n" .
            "nuGGN091IXbjF51idM5uZBAtrt8J+rEBJIb3MmBjeAYVoQ2CB/vtxxH+Wm4lril1\n" .
            "Q2PABp4iHykQFtjBL34dn7esMdOaEBTiTAmewK3LAEwSBYM9PR9ub2/vYGKWI2mu\n" .
            "nwLI8izuHHyyABC5ReAXrMasXNVBqA/+TdEwvYEarrDkY8H5IWuSwRRV\n" .
            "-----END CERTIFICATE-----\n"
        );
        $configuration->setWebpayCert(Webpay::defaultCert());

        return $configuration;
    }

    public static function forTestingWebpayPlusMall() {
        $configuration = new Configuration();
        $configuration->setCommerceCode(597044444401);
        $configuration->setPrivateKey(
            "-----BEGIN RSA PRIVATE KEY-----\n" .
            "MIIEowIBAAKCAQEAq5x8P9EIq8xT6UtRAL6pmNpcgYuIXHUvtPuY+Ao28LtbsJQV\n" .
            "gPXJ2CrMYtq3GH1kPAajdF0tdfMOSQgxTnnWsMFdY6jel2vhF1vfKvm79yLMrqIR\n" .
            "X7l/fZbldWJdoSuq1b3xTPYBKKGFhe/SvYpO88dvOuH4WIiAfRT1gFXkEW9xyA70\n" .
            "vK/4RZR93f220ELh8sHBMwP39XnNp7c52A+f1fkJVP5F8G5UTAC/g/jDZMCrtnCw\n" .
            "xu37jyXTEpQATXUN1XrsjJirpvNBfIvXQlk4AeXEj5a7PYE4nASZfNwSc1kpDm7G\n" .
            "6PheDkUXN1JEFscC/x9BpVvZIAjaXML/QCFV7wIDAQABAoIBAF/oGoBHwELS9GpD\n" .
            "D0gNRhcIof48Dr8tNrY8jebBPqcW7k0m1UW3F1DZylPMy9rB6Qyq4RqdIFT0ux0R\n" .
            "mQy0hslNp3WU4KFbRvaY/4Wy/9tD9YP7Sx5mOtvjQuVxTcZO8zB08LAEI+2jJ04N\n" .
            "E4eeDjWrVXxg4TwJPVWqKvHIDqe26CfMlKohSpcCpmq3HQknnFfuxGGlNGdrX4YR\n" .
            "v4BeoSsAG8Ak+cCkGBJ2LcrZpw+GJjs0SkvOVO1+G+vixYPDcor1moB1AnQ/tkrz\n" .
            "gSrRIl+Et3nq5XmmxQejOgMMWaXR2RXutdgXq4w3s4FSwABv5Zw1zAA/yapfk1uH\n" .
            "zJ/OpuECgYEA22kVGXhoR0onMSKKHnbtO3s3tmrgLwVQAMaEwYy8KNnIWkCLszlT\n" .
            "KtJ7nmEDdMysbHpb1EeNAoKg/DKY0YgneWrmmh3JozUp18dXEeHqEVPH1X9XT017\n" .
            "M24nqe65deFu9SKhZv9SQdj69iJLnRxPHSae/p5wb2ORr/XG+9ZX6OkCgYEAyDrK\n" .
            "95yH2b5CcZXvT+9laIO8OZvppTP923a8stofPfBXRmqRZdhLLOVMJhBiQtRSGz4w\n" .
            "Tk0T1LC9FN9Y5y4HLbyYDuYxqda+MqdBoYgsvep4ozVNyE7UDdRTKOjin8xIArAn\n" .
            "mPvhjVBtpvQE+r9A4CfLe2smyHUtW48nAxgugRcCgYAjgfgGLTRDBT8edoZ/s6Nk\n" .
            "0uYLQXSSZ3uxBG+LmykAO25vHK7/DDHnZjTXRr/2cQEedRbTXdj2JQnEhrOwhSZO\n" .
            "QfybyGJPZVUmNH5kyHjG4RYf+QG6NcHQau1EVPvylc8NINOaBYvcWC8VEivGe0Ra\n" .
            "ZVupvR5ZCHYVUeMn8mI7sQKBgQDG5cgq8Z3tSVbdWBAyOl9k07+NBniwt5XLhQZr\n" .
            "L8trDqzTcRbfsVzzyw66nPnO4vRwxXTcwyoY1DvvWPIKKynMYBQ4cKgSyxOCY60J\n" .
            "VakEOr79ePy8Jrn0xt6Yu8Yq8JTzvqKHEGZ8ptFVz/6GSqeaQ02ZWtZauDOHSQt6\n" .
            "wnGnnwKBgFbTBEwXl89uZZ/25z1mA5D9nqHTj/A0GYc9762xc/bvkvi59DeYbNSH\n" .
            "J7jKHS50kE4sS/E4p7e9/G4jZTe/nvEsstfFZprRF31xlVY9Y/1OPysGYIJPOTAg\n" .
            "EBEKSypPpswFcn/jSeIGii7aEb5h6OyNpnSMbBvFxhhUJ1PPpUQG\n" .
            "-----END RSA PRIVATE KEY-----"
        );
        $configuration->setPublicCert(
            "-----BEGIN CERTIFICATE-----\n" .
            "MIIDrDCCApQCCQCDHU0/ZL/yojANBgkqhkiG9w0BAQsFADCBlzELMAkGA1UEBhMC\n" .
            "Y2wxEzARBgNVBAgMClNvbWUtU3RhdGUxETAPBgNVBAcMCHNhbnRpYWdvMSEwHwYD\n" .
            "VQQKDBhJbnRlcm5ldCBXaWRnaXRzIFB0eSBMdGQxFTATBgNVBAMMDDU5NzA0NDQ0\n" .
            "NDQwMTEmMCQGCSqGSIb3DQEJARYXYW1hbGRvbmFkb0B0cmFuc2JhbmsuY2wwHhcN\n" .
            "MTgwOTA0MTQwMzE4WhcNMjIwMzI3MTQwMzE4WjCBlzELMAkGA1UEBhMCY2wxEzAR\n" .
            "BgNVBAgMClNvbWUtU3RhdGUxETAPBgNVBAcMCHNhbnRpYWdvMSEwHwYDVQQKDBhJ\n" .
            "bnRlcm5ldCBXaWRnaXRzIFB0eSBMdGQxFTATBgNVBAMMDDU5NzA0NDQ0NDQwMTEm\n" .
            "MCQGCSqGSIb3DQEJARYXYW1hbGRvbmFkb0B0cmFuc2JhbmsuY2wwggEiMA0GCSqG\n" .
            "SIb3DQEBAQUAA4IBDwAwggEKAoIBAQCrnHw/0QirzFPpS1EAvqmY2lyBi4hcdS+0\n" .
            "+5j4Cjbwu1uwlBWA9cnYKsxi2rcYfWQ8BqN0XS118w5JCDFOedawwV1jqN6Xa+EX\n" .
            "W98q+bv3IsyuohFfuX99luV1Yl2hK6rVvfFM9gEooYWF79K9ik7zx2864fhYiIB9\n" .
            "FPWAVeQRb3HIDvS8r/hFlH3d/bbQQuHywcEzA/f1ec2ntznYD5/V+QlU/kXwblRM\n" .
            "AL+D+MNkwKu2cLDG7fuPJdMSlABNdQ3VeuyMmKum80F8i9dCWTgB5cSPlrs9gTic\n" .
            "BJl83BJzWSkObsbo+F4ORRc3UkQWxwL/H0GlW9kgCNpcwv9AIVXvAgMBAAEwDQYJ\n" .
            "KoZIhvcNAQELBQADggEBACv0krFTiPCwsw0pwKfHJUqhP+k2B7FkdSFhpdd8OiRX\n" .
            "50E9aY9oiasuojyYA0mdrWDZvyKsxvMGuSzxrxgg42Wsb2DPR5Uc99V2+9rpODFV\n" .
            "nPWeuhAgBUfNK3rZ+qIz1FyrzYUTPcK0BzStbpdclb+LEh7I0wTegSj7skctm8M2\n" .
            "BQmFaS67DUmr0ReI4ZHvWMkDjqjlK8mzx0f7nOdarq3Cxhg3QMqOilfGtvrZrtos\n" .
            "q8/WPGded+bP8kBZ2Rs6oUEBBQfVnAPI50YRXZJjyAzqSwx8MhFztAgE/LaYbvZs\n" .
            "xNB2I18V5oNmOCXHhfqneSstxMBWt3W8rd/0+JSfWLc=\n" .
            "-----END CERTIFICATE-----"
        );
        $configuration->setWebpayCert(Webpay::defaultCert());
        return $configuration;
    }

    public static function forTestingWebpayPlusCapture() {
        $configuration = new Configuration();
        $configuration->setCommerceCode(597044444404);
        $configuration->setPrivateKey(
            "-----BEGIN RSA PRIVATE KEY-----\n" .
            "MIIEpQIBAAKCAQEAq62F11DVV2ciL/S/zKr8NmesZNUoI3t/9EbZ5m97LjH/R1s2\n" .
            "0MxJWjmy0f+I64PvJkGOvQauBdJoGiiCeiV3qY+PppgOQmMo8xXaPzErrVr0F9bx\n" .
            "3gbqSuqi/uwJNJRWUs3tYmlQ/WQrKHSMxpRkVthWoIpyR3UEBpr9N9MhAdDarJCv\n" .
            "/df9Hyu3RpE7ULFCnCHi/y3DVPYi3TnXa4xo9fE3iVuxMNjCUO93GqETYVCRoIW/\n" .
            "237frd8tgZ3biNmYRqbxO6jIv/1uEJs2mxPaW+FmdpW4+yM1tK8e8mWV/OrqpslZ\n" .
            "O0mqUVY16phJJW7ad4fi0V3+TCRwgY0MC6x6uwIDAQABAoIBAQCktQoflXHZNR1b\n" .
            "nRkWp0TqfXSsGMU1pZsRJZiQuIwZueYM87oXgKcvZQPm7Z7TNfUPYv4q5Gm5NDCk\n" .
            "SBFGVwQDLbTIREIJ91CmR2ToE6iv3P8qkBHkzgWicpKGuLXsOBTJxL/nFtuY/61Y\n" .
            "Vtlo+514pH4X8DvLyrxeCfy+vlSAg+mcs+35wnxC+qvAESYXQKODorGljmthkqyd\n" .
            "P/ONKef+PsyJuUevne2YSkiqaDywGBe5JRS+Ij74UH7d+/+hDS9AMwj+nrlVE/Bj\n" .
            "Y1zCw0BijKNuwnoF9oHMZvshfV2GkpS237tmXDbn+fJOqWfonb/CkBtWsF86N79h\n" .
            "/x+gJQ8hAoGBANeQ8/fDA8azfh6z6Ar6C0XIxgZppLtGPac65JhyKCYtvH1kzhJU\n" .
            "dnBqcMOxj9K3zbK3A21Y3gBMZvNS9Wja8Pk7r0R6aHU7eMOlEiOoEdeoVtlOpj4p\n" .
            "Y87Yc8vojd0nnuWJpxw6R8MvzJBm750tIE0/rv2+vfDeaxiWUexhrq0FAoGBAMvh\n" .
            "I5saf9OTJLvBfu8gqldLGdlkG1+1eyxnJbQuHq6o+WsaxjFEwS5a8MOlD7my0tom\n" .
            "zm98fiFHpGX3HGoG9RQuvRKmWRCdj5qb7Bep3gWb9HOKYG+6DKGPPpmJ6fdjV9zh\n" .
            "o5ru5iFJoWHcE60/kVbOJsh6ugVXFzF6DJaBkRS/AoGBAK3Bv4VkgjS2FeD1rwK6\n" .
            "DkAP197vZMM3mRalGAHxcn9jul1w1dJclqOCiKaVB5MYaQu3DWIkkb231/wmUH5W\n" .
            "jIq5G0udR3nHmE5LTlXDca5dmLPM+597iWH/g0dHiqJK/3+R90t/hrzEWKXE8zvE\n" .
            "VhcuUAVkrIHtJnJJKHvbOQtpAoGAXEqPVrAZO0p5r3C5KECOO7PogKs7ZQj/OCt9\n" .
            "OuJBy2j8d0qIe1cXaAeMw9PdmX9kyZIVkww1AJWwyuOg/jImETvTJTUeTlI05pU8\n" .
            "u72OntVpREBYxVrgSuZQPSrcObvD015lNEZ+8ISnRGhek+eZwETT857yxGYXPrN0\n" .
            "LVF7vnsCgYEApWvaUImePJDN50+nExK6TWHGFNnlZPlqFuyEHCSIlC0moGkcdl1D\n" .
            "uILlje5JjmCI6hUreePcpFbyuiWcFcRJPdTgPWAcuWpPqFk3TyMVg8RQjZ4nIb4e\n" .
            "TB3lRTP7u4t4emHHeNZhSeakRMOUYWiylCgSLmmf1OKd/bWTQ6G7lk0=\n" .
            "-----END RSA PRIVATE KEY-----\n"
        );
        $configuration->setPublicCert(
            "-----BEGIN CERTIFICATE-----\n" .
            "MIIDrDCCApQCCQDxS6RHDwxUnjANBgkqhkiG9w0BAQsFADCBlzELMAkGA1UEBhMC\n" .
            "Q0wxEzARBgNVBAgMClNvbWUtU3RhdGUxETAPBgNVBAcMCHNhbnRpYWdvMSEwHwYD\n" .
            "VQQKDBhJbnRlcm5ldCBXaWRnaXRzIFB0eSBMdGQxFTATBgNVBAMMDDU5NzA0NDQ0\n" .
            "NDQwNDEmMCQGCSqGSIb3DQEJARYXYW1hbGRvbmFkb0B0cmFuc2JhbmsuY2wwHhcN\n" .
            "MTgwOTA0MTQxMDQ3WhcNMjIwMzI3MTQxMDQ3WjCBlzELMAkGA1UEBhMCQ0wxEzAR\n" .
            "BgNVBAgMClNvbWUtU3RhdGUxETAPBgNVBAcMCHNhbnRpYWdvMSEwHwYDVQQKDBhJ\n" .
            "bnRlcm5ldCBXaWRnaXRzIFB0eSBMdGQxFTATBgNVBAMMDDU5NzA0NDQ0NDQwNDEm\n" .
            "MCQGCSqGSIb3DQEJARYXYW1hbGRvbmFkb0B0cmFuc2JhbmsuY2wwggEiMA0GCSqG\n" .
            "SIb3DQEBAQUAA4IBDwAwggEKAoIBAQCrrYXXUNVXZyIv9L/Mqvw2Z6xk1Sgje3/0\n" .
            "Rtnmb3suMf9HWzbQzElaObLR/4jrg+8mQY69Bq4F0mgaKIJ6JXepj4+mmA5CYyjz\n" .
            "Fdo/MSutWvQX1vHeBupK6qL+7Ak0lFZSze1iaVD9ZCsodIzGlGRW2FaginJHdQQG\n" .
            "mv030yEB0NqskK/91/0fK7dGkTtQsUKcIeL/LcNU9iLdOddrjGj18TeJW7Ew2MJQ\n" .
            "73caoRNhUJGghb/bft+t3y2BnduI2ZhGpvE7qMi//W4QmzabE9pb4WZ2lbj7IzW0\n" .
            "rx7yZZX86uqmyVk7SapRVjXqmEklbtp3h+LRXf5MJHCBjQwLrHq7AgMBAAEwDQYJ\n" .
            "KoZIhvcNAQELBQADggEBACo42LiT6Da6Dq6kLrz3ja8dBge2SfCu/gnA+57lENAx\n" .
            "D1Nq3lMqOE2dAoQXM+qwkBvduPaqFUzb4HV1b11PoAgeWR3ksoaKiWwjY5+p/snl\n" .
            "Z/EITwHYhfl9cmuVQFC09AQC/3brrP62fYzKP03CkGrxfVFP0Q0eLzP3w8x4XMzG\n" .
            "9VmMMHFICFYEEyUiQT22X8SpFtUakNCfJzK65zXGAxJqZKTVYhjcYB+HBIAqitGS\n" .
            "hF+F68G9XN7twijNIuseJt/I98R7UazON7EeP7kAz/UylVNOVmYq+pQbU4fG9QjQ\n" .
            "CZ8F118V03v3IQYXwTmOHge9moBwyTkcnI5nql346jg=\n" .
            "-----END CERTIFICATE-----\n"
        );
        $configuration->setWebpayCert(Webpay::defaultCert());
        return $configuration;
    }

    public static function forTestingWebpayOneClickNormal() {
        $configuration = new Configuration();
        $configuration->setCommerceCode(597044444405);
        $configuration->setPrivateKey(
            "-----BEGIN RSA PRIVATE KEY-----\n" .
            "MIIEpAIBAAKCAQEA48S877GUtjlYrqIQDlZAMqg5kfNrrZlCZckC1LGzCfcPu7Lm\n" .
            "za2c2F1Q7zKELqVTo1wuZUS1inhYmtg4PexDKak/uryARR3uy2kqq3yG3IQNIdQY\n" .
            "RpAUl8SvNyJvUVtA0N6nwjaqsTv1EacOLsfR+9HNvRXaWSitXNFa7i2G0iN/pnXb\n" .
            "a796mUMVMwJPkV6Si6608566mvqkSnvzulAaC/eev1KIyH5oF22yjyWRIM+K9ZNx\n" .
            "7Cosnxgmt6e/8AazGBxA7gXxV6DQtOvL6k4AottUro2hMXLUZRS3x4GjtJDUjpLj\n" .
            "UIHpK5Tz66D8dGN+Kv/f/Y7bAWMHUQqrPHkAcQIDAQABAoIBAEEcqeJfwqKBLE/n\n" .
            "9m0SzRFuM978VmjvKiMM3qlND2Cm5zGCSCa+HdtgedWXfGAVVR6bKIw8oyUtmC7T\n" .
            "5ugU1XJgdt58KrMXhn9R1ifl1mvNuC9WgYYShECKsogxaN86FgJf1FdZ51v5Ruq/\n" .
            "9fb7mpTBem42hA/+5+hj1PnHvAXwI9/erX8nZIixtj9PVJOzUW/izlJVm9DoT2vM\n" .
            "JZAt/HXZqovvsSet5tRfTPTuFH+NTXnfpHbDGPDqQrC+fqTaZCFJXU0lgWemBdM2\n" .
            "HIafstxFhY5cbgYKl6nW8SQNQQUG7ifJ5ttz7jNqZ3X9hk2yIvK+0Dd1NKTlJoAS\n" .
            "5V8FL00CgYEA96jBRG4I2P0rbQl7Elf5A4xS9ruFgQtS6//9g5ezLmxtiVQhryl4\n" .
            "4PKKWY1nRPhQBQaQdp6H9w8rU5ccyAFjW4hDfD8jwTCE1On1dSfBWcrBir4LL/Dm\n" .
            "WbOgrh2jotvAmInkl6GohwRZIF77kRQXc+Zv2Xle2o+JMv4keBmuk+sCgYEA63B9\n" .
            "yoV0qhuTnrFNW99rQTQ8WnfUYdmau/4W2CSkNVgZ04j5xKe2FzBkQHnvCDX5THkW\n" .
            "YVsq0J/F3BBApKvKwACVdri19odJRi2JgbJarMZb+xro8kqAZ3KvXkXTYpxkBk7S\n" .
            "hkHBrj6sXe+I3usNN3iH80z6ZTsg2dBU7cp4khMCgYEA0amCBKaKwviBnQubr0ne\n" .
            "vAw96DeUrEyj5LuRKahxvul4Sfx5j8qyVO3ABlRZiuAVDkwiXOmU/alP6rJRYVkb\n" .
            "fk/7oeHqKREkQwPWE1qWq6ek9goxemKdAG+7pevdrnAPupNyfJQVEkiyE1+V5Zp2\n" .
            "yF3bbub7UFiXtB3HTg2f6AUCgYEAt9DQ9TAywKjdHRXyfts1IuhEgqFx2J+LNmEP\n" .
            "ttsMtXU+XLBhyQ7jlME8VDaez/tL00/qkEIccFt9n+20epyBpFwQVWuq7Xn8VGUz\n" .
            "KWZ1ctU/dRIycxCFpb6dem3rtt7BHUenCBkIvSDDdGeSpfBAFmHtSqB8ElMSt9v2\n" .
            "otzkO68CgYBhIDz4rTMuOxmt9yily7rcd9J7RrbC7hPHMjM5EwPyOmawAYjTRM8X\n" .
            "rxe1w4MtKrXxn11EncMJuH0hLQ12MwmrTui7gllTi8IPkfe+e7yhgHzzB5Mnhax0\n" .
            "92jL5rYiTenvy/wIjmF3TDHwyX6dB6QuozltdYBE2rv/oXOrE19qCQ==\n" .
            "-----END RSA PRIVATE KEY-----\n"
        );
        $configuration->setPublicCert(
            "-----BEGIN CERTIFICATE-----\n" .
            "MIIDrDCCApQCCQCLlKISnBv1OTANBgkqhkiG9w0BAQsFADCBlzELMAkGA1UEBhMC\n" .
            "Y2wxEzARBgNVBAgMClNvbWUtU3RhdGUxETAPBgNVBAcMCHNhbnRpYWdvMSEwHwYD\n" .
            "VQQKDBhJbnRlcm5ldCBXaWRnaXRzIFB0eSBMdGQxFTATBgNVBAMMDDU5NzA0NDQ0\n" .
            "NDQwNTEmMCQGCSqGSIb3DQEJARYXYW1hbGRvbmFkb0B0cmFuc2JhbmsuY2wwHhcN\n" .
            "MTgwOTA0MTQxNDE0WhcNMjIwMzI3MTQxNDE0WjCBlzELMAkGA1UEBhMCY2wxEzAR\n" .
            "BgNVBAgMClNvbWUtU3RhdGUxETAPBgNVBAcMCHNhbnRpYWdvMSEwHwYDVQQKDBhJ\n" .
            "bnRlcm5ldCBXaWRnaXRzIFB0eSBMdGQxFTATBgNVBAMMDDU5NzA0NDQ0NDQwNTEm\n" .
            "MCQGCSqGSIb3DQEJARYXYW1hbGRvbmFkb0B0cmFuc2JhbmsuY2wwggEiMA0GCSqG\n" .
            "SIb3DQEBAQUAA4IBDwAwggEKAoIBAQDjxLzvsZS2OViuohAOVkAyqDmR82utmUJl\n" .
            "yQLUsbMJ9w+7subNrZzYXVDvMoQupVOjXC5lRLWKeFia2Dg97EMpqT+6vIBFHe7L\n" .
            "aSqrfIbchA0h1BhGkBSXxK83Im9RW0DQ3qfCNqqxO/URpw4ux9H70c29FdpZKK1c\n" .
            "0VruLYbSI3+mddtrv3qZQxUzAk+RXpKLrrTznrqa+qRKe/O6UBoL956/UojIfmgX\n" .
            "bbKPJZEgz4r1k3HsKiyfGCa3p7/wBrMYHEDuBfFXoNC068vqTgCi21SujaExctRl\n" .
            "FLfHgaO0kNSOkuNQgekrlPProPx0Y34q/9/9jtsBYwdRCqs8eQBxAgMBAAEwDQYJ\n" .
            "KoZIhvcNAQELBQADggEBAGQWdgUHhWXnGIiqE/0b1N2YPr2l1CTu86edj/3ySp1A\n" .
            "7yIeWOiI1NUhMVXTt/uGw4C1WC4Ir3nhB1E0yrc65VF0GboE8m9ilj98NbkQKz0/\n" .
            "dr3/TFb9Fc37WIMFoKsG2tnEXhLZxaahglEDdBcoL+I78K+JFtL92N7+Sns5zAmy\n" .
            "DDKf/7bKvTBF5vXQzgYWkrGFweppVU1xfgCn5KFdqQSJZzvcu1xuCRSngLbcpBEW\n" .
            "JlzTNzZ7K+siy5V9cKQtUW3h/KyMeP9KCE0YUnXvtiGr2yeqUviUAqDiSzcCmQDR\n" .
            "XE4/CA2Yzlv/+n9JVsvFBTAyIvYfG3mqr8KdkL238sc=\n" .
            "-----END CERTIFICATE-----\n"
        );
        $configuration->setWebpayCert(Webpay::defaultCert());
        return $configuration;
    }

    public static function forTestingPatPassByWebpayNormal($commerceMail) {
        $configuration = new Configuration();

        $configuration->setCommerceCode(597020000548);
        $configuration->setPublicCert(
            "-----BEGIN CERTIFICATE-----\n" .
            "MIIDujCCAqICCQDHWKiW6dFYqjANBgkqhkiG9w0BAQsFADCBnjELMAkGA1UEBhMC\n" .
            "Q0wxETAPBgNVBAgMCFNhbnRpYWdvMRIwEAYDVQQKDAlUcmFuc2JhbmsxETAPBgNV\n" .
            "BAcMCFNhbnRpYWdvMRUwEwYDVQQDDAw1OTcwMjAwMDA1NDgxFzAVBgNVBAsMDkNh\n" .
            "bmFsZXNSZW1vdG9zMSUwIwYJKoZIhvcNAQkBFhZpbnRlZ3JhZG9yZXNAdmFyaW9z\n" .
            "LmNsMB4XDTE2MDYyODIwMDQ0N1oXDTI0MDYyNjIwMDQ0N1owgZ4xCzAJBgNVBAYT\n" .
            "AkNMMREwDwYDVQQIDAhTYW50aWFnbzESMBAGA1UECgwJVHJhbnNiYW5rMREwDwYD\n" .
            "VQQHDAhTYW50aWFnbzEVMBMGA1UEAwwMNTk3MDIwMDAwNTQ4MRcwFQYDVQQLDA5D\n" .
            "YW5hbGVzUmVtb3RvczElMCMGCSqGSIb3DQEJARYWaW50ZWdyYWRvcmVzQHZhcmlv\n" .
            "cy5jbDCCASIwDQYJKoZIhvcNAQEBBQADggEPADCCAQoCggEBANLeHJx5wK/9OSmM\n" .
            "JPts4mClAMZPxNC4aRvCksiafSpdRtPSPMQYUpxdt16RJuoK4Cpsc2xrY/LfLvT+\n" .
            "eLDcTa3LNLWsFdKh387Eut4QCddueC3mQLk1aVl1JxJeA1iPT6uuzllKL1Dy/5kM\n" .
            "3GQSUobKQus19Lp31kZ6A3jbcdO2o/8atD117ajhCYcmOhMkbDvV1j1SiJuWZ1Qg\n" .
            "YPZra2WZMMEThE5Q+uZnghOoGAulhaweRVL40u9gpwNGcpxY/1W+GJoujreTN39D\n" .
            "ZhhvatJMHjkHzcr/nv0KAeylRy66THXCju9A/iLTyuMHVJTn202SWFlGiuhf89i5\n" .
            "BdADw9ECAwEAATANBgkqhkiG9w0BAQsFAAOCAQEARz2BbG8QGKqjUYorkCe+eaE5\n" .
            "WnZN5q8/ihisJtsa9yXO7DUe8912094Wd/ZqwYQ1eBr0vEdwQ1Mit2lkBOkyNqR3\n" .
            "af3/8znCxiTqvJdo4r3sp6nZV2m6zjicQwJ3aWFP8mqeTsyG3rMZBin0QaDoYCM+\n" .
            "5qVZhQBycggsPMPnZ3fvBIslWCd6JBPYZ4agXNLdAsTmxYxjpuyOM+qTN9hdYdzb\n" .
            "jaJ/IVa8NZrrSZU6BxooybSHNJ5+x0dc9Q/6A7txTnjTj8Iy9gfjokXRgpADpFq9\n" .
            "mnf2hxewHnOGRcfAHBgS6vrpuAJ7/yIMewcMtu09ukFY7/d23CDPGVisDdDJwA==\n" .
            "-----END CERTIFICATE-----"
        );

        $configuration->setPrivateKey(
            "-----BEGIN RSA PRIVATE KEY-----\n" .
            "MIIEpQIBAAKCAQEA0t4cnHnAr/05KYwk+2ziYKUAxk/E0LhpG8KSyJp9Kl1G09I8\n" .
            "xBhSnF23XpEm6grgKmxzbGtj8t8u9P54sNxNrcs0tawV0qHfzsS63hAJ1254LeZA\n" .
            "uTVpWXUnEl4DWI9Pq67OWUovUPL/mQzcZBJShspC6zX0unfWRnoDeNtx07aj/xq0\n" .
            "PXXtqOEJhyY6EyRsO9XWPVKIm5ZnVCBg9mtrZZkwwROETlD65meCE6gYC6WFrB5F\n" .
            "UvjS72CnA0ZynFj/Vb4Ymi6Ot5M3f0NmGG9q0kweOQfNyv+e/QoB7KVHLrpMdcKO\n" .
            "70D+ItPK4wdUlOfbTZJYWUaK6F/z2LkF0APD0QIDAQABAoIBAFrSRZpzqjViqHMn\n" .
            "pGoSLLKZfurrQobvVn4ZYOU7/Pr5L99d5sRDAZnNl4QImq0lQAWlrlUdL/BUhkIJ\n" .
            "NGxghqh7JFm3I7MT+3RwMVghqkt6jhKe4HOk+JoKJmj3yxMirprwcHnuxNBlyQbf\n" .
            "jjEf3yGlDguGssB5ivXR6ZrtUWpwsK9OBiRctSeceFE4r68ldDKRFVLNURkK1AEd\n" .
            "lCbhWp1a8W5CKvPjj6Rpq9r1kmTJA1h9NSkLum4f7aewvFhG6bHWEcjA6EWieipj\n" .
            "2zk74/1HBDpujHJSUzTcXbiIsOVtY2Qh+74CMzHUUS41dGQNk/l/qUk7tRljwjFm\n" .
            "PerH1FECgYEA6IKDDTbaLNsK4BefqlXZvCXbm0irxCb3XvvcsTqcDyZG0KWOCoXw\n" .
            "B24xrsMfbheR0L6x4JUS6RM4bvTEhK4gJzDDeFhfPj2Kuav9nl1oEOZaJ5rxLlz7\n" .
            "90g/f6kqjW3qlBVSFtz/jVrAk+lju9piHudwerjLA7TXLLm0tJZf7N0CgYEA6Cvc\n" .
            "HzDhxdNYVakWsTBKI/uOUwt7cbHUr7OfoQA5dTxqHvFKBjrY3rgcI3/4vU3cEwRm\n" .
            "a4X6RRSljyKAel54h4eJndP9+dB3VrOOkvuHXOLEVwwzfdaO+4FRQXR+0i9T46RK\n" .
            "7FJy6XLfhPwZozebXbSTg/WZJ5UczVmxBYzquYUCgYEAu1t/0wQiZwbTCqS+qnmn\n" .
            "jK9M+SJkFxn3N/joa3/5BVQouDTP8rbfJn2rV1IwX3xqqbUgjQJTTLGKRg7C1M+j\n" .
            "ZTEsMiu0A+l/ggKPyi8mjoewmj2Gn3+aIjd7w5lDitfJsS5FCdtnqjY4/HeTQGrH\n" .
            "qnOA9cM3BHOS+J1keii6f5kCgYEAofbO9bdtGUuJySBPY0azwgxgSlCtSjBrljLx\n" .
            "vihg7Qc7ZOCg6l2tIxo/DwjcZntldqLQLFxnrj9sC8Fe7X7wCGQmPcNA30BtsD9M\n" .
            "y/7KfKL5o1wwo63FS3D4VXhGbKx1kk3vspMF9ROdGLGh1Poa2bD6Y8k2kaV1VVAn\n" .
            "rR6UNN0CgYEAgWw0NRz9X3V5K0WfrXnqBEvDiJ9MnsO3Y0SmV+zbTVYQ2zf2iYT+\n" .
            "Wp4Tpjfc2k8s1dU33YnsrLaecB3gEFeEHJdN9qOPkk/yElVrcCKfFEUmPu7wvHZI\n" .
            "yCLqC4NXGoXossGlQ2XPCSYacEQ5JJTtv+sBufhJZTwuqEBSGS7PurA=\n" .
            "-----END RSA PRIVATE KEY-----"
        );
        $configuration->setCommerceMail($commerceMail);
        $configuration->setWebpayCert(Webpay::defaultCert());
        return $configuration;
    }

}
