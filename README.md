# Zanox API client

[![Latest Stable Version](https://img.shields.io/packagist/v/whitelabeled/zanox-api-client.svg)](https://packagist.org/packages/whitelabeled/zanox-api-client)
[![Total Downloads](https://img.shields.io/packagist/dt/whitelabeled/zanox-api-client.svg)](https://packagist.org/packages/whitelabeled/zanox-api-client)
[![License](https://img.shields.io/packagist/l/whitelabeled/zanox-api-client.svg)](https://packagist.org/packages/whitelabeled/zanox-api-client)

Library to retrieve leads and sales from the Zanox publisher API.

Usage:

```php
<?php
require 'vendor/autoload.php';

$client = new \whitelabeled\ZanoxApi\ZanoxClient('1234567890ABCDEF1234', 'yoursecret');
$sales = $client->getSalesForDate(new \DateTime('2016-10-28'));
$leads = $client->getLeadsForDate(new \DateTime('2016-10-28'));

print_r($sales);
print_r($leads);

/* Returns:

Array
(
    [0] => whitelabeled\ZanoxApi\Sale Object
        (
            [id] => 09517c85-f2cc-4e33-86b6-7d61233264a7
            [reviewState] => open
            [reviewNote] => U1P
            [trackingDate] => DateTime Object
                (
                    [date] => 2016-10-28 12:47:30.837000
                    [timezone_type] => 1
                    [timezone] => +02:00
                )

            [clickDate] => DateTime Object
                (
                    [date] => 2016-10-15 11:20:36.323000
                    [timezone_type] => 1
                    [timezone] => +02:00
                )

            [modifiedDate] => DateTime Object
                (
                    [date] => 2016-10-28 12:47:32.130000
                    [timezone_type] => 1
                    [timezone] => +02:00
                )

            [adMedium] => TV Internet max
            [program] => Ziggo NL
            [clickId] => 2223423049892302528
            [amount] => 0
            [commission] => 60
            [currency] => EUR
            [gpps] => Array
                (
                    [zpar0] => 8e72d59d9572394923402009a5bedcef
                )

            [mediaId] => 1234567
            [mediaName] => Your website name

        )
    [1] => whitelabeled\ZanoxApi\Sale Object
        (
            [id] => 7b3bc3c6-b234-4488-bcc6-ae95849303d6
            [reviewState] => open
            [reviewNote] => 
            [trackingDate] => DateTime Object
                (
                    [date] => 2016-10-28 14:01:25.587000
                    [timezone_type] => 1
                    [timezone] => +02:00
                )

            [clickDate] => DateTime Object
                (
                    [date] => 2016-10-28 13:56:17.340000
                    [timezone_type] => 1
                    [timezone] => +02:00
                )

            [modifiedDate] => DateTime Object
                (
                    [date] => 2016-10-28 14:01:27.637000
                    [timezone_type] => 1
                    [timezone] => +02:00
                )

            [adSpace] => Your website
            [adMedium] => 500x500 Energiedirect icm EUR 100 Bol.com bon
            [program] => DealDirect NL
            [clickId] => 9348234023481412352
            [amount] => 1
            [commission] => 30
            [currency] => EUR
            [gpps] => Array
             (
             )
            [trackingCategory] => Zorg Basis + Aanvullend
            [trackingCategoryId] => 91291

            [mediaId] => 1234568
            [mediaName] => Your second website name
     )

Array
(
    [0] => whitelabeled\ZanoxApi\Lead Object
        (
            [id] => 8eb8fa43-c85c-4508-855e-7bc3c30057c1
            [reviewState] => rejected
            [trackingDate] => DateTime Object
                (
                    [date] => 2016-11-19 06:55:20.247000
                    [timezone_type] => 1
                    [timezone] => +01:00
                )

            [clickDate] => DateTime Object
                (
                    [date] => 2016-11-19 06:47:40.620000
                    [timezone_type] => 1
                    [timezone] => +01:00
                )

            [modifiedDate] => DateTime Object
                (
                    [date] => 2016-11-19 09:14:20.827000
                    [timezone_type] => 1
                    [timezone] => +01:00
                )

            [adMedium] => Zorg 2016-2017 premie berekenen Vergelijkers
            [program] => ZEKUR NL
            [clickId] => 1234567890123456789
            [commission] => 45
            [currency] => EUR
            [gpps] => Array
                (
                    [zpar0] => 12345678901
                    [zpar1] => 12345
                )

            [mediaId] => 1234567
            [mediaName] => Your website name
        )
    )
 */
```

## License

© Whitelabeled BV

MIT license, see [LICENSE.txt](LICENSE.txt) for details.