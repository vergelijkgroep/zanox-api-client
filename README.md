# Zanox API client

Library to retrieve sales from the Zanox publisher API.

Usage:

```php
<?php
require 'vendor/autoload.php';

$client = new \vergelijkgroep\ZanoxApi\ZanoxClient('1234567890ABCDEF1234', 'yoursecret');
$sales = $client->getSalesForDate(new \DateTime('2016-10-28'));

print_r($sales);

/* Returns:

Array
(
    [0] => vergelijkgroep\ZanoxApi\Sale Object
        (
            [id] => 77917c85-f2cc-4e56-86b6-7d6f6c3264a7
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

            [adSpace] => Beste Internet Provider
            [adMedium] => TV Internet max
            [program] => Ziggo NL
            [clickId] => 2222303472823702528
            [amount] => 0
            [commission] => 60
            [currency] => EUR
            [gpps] => Array
                (
                    [zpar0] => 8e72d59d8946540189541009a5bedcef
                )

        )

    [1] => vergelijkgroep\ZanoxApi\Sale Object
        (
            [id] => 7b3bc3c6-bd0a-4488-bcc6-aec3f11131d6
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

            [adSpace] => www.energie-aanbiedingen.com
            [adMedium] => 500x500 Energiedirect icm EUR 100 Bol.com bon
            [program] => DealDirect NL
            [clickId] => 2227053694141412352
            [amount] => 1
            [commission] => 30
            [currency] => EUR
            [gpps] => Array
             (
             )
     )
 */
```