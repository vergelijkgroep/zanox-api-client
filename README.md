# Zanox API client

Library to retrieve sales from the Zanox publisher API.

Usage:

```php
<?php
require 'vendor/autoload.php';

$client = new \whitelabeled\ZanoxApi\ZanoxClient('1234567890ABCDEF1234', 'yoursecret');
$sales = $client->getSalesForDate(new \DateTime('2016-10-28'));

print_r($sales);

/* Returns:

Array
(
    [0] => vergelijkgroep\ZanoxApi\Sale Object
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

            [adSpace] => Your website
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

        )
    [1] => vergelijkgroep\ZanoxApi\Sale Object
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
     )
 */
```

## License

© Whitelabeled BV

MIT license, see [LICENSE.txt](LICENSE.txt) for details.