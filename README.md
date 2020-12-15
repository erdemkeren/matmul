A laravel API app that multiplies the given matrices. 

## Validation

The application validates the given matrices before multiplying them.

## API request

The commands `composer install` and `php artisan serve` could be run respectively
on command-line to serve the application.

```bash
$ composer install
$ php artisan serve --host=127.0.0.1 --port=8000
```

A postman collection can be found on the root level to send a call to the API:

| Method | Url                                 |
|--------|-------------------------------------|
| POST   | http://127.0.0.1:8000/api/multiply  |

See: mat-mul.postman_collection.json

**Example Data:**

```json
{
    "first_matrix": [[1, 1]],
    "second_matrix": [[1, 1], [0, 25]]
}
```

## Resulting matrix

The application returns the product of the multiplication as a matrix of 0-indexed-letters.
If the results are not integers; the result will be the string representation of
`intval(result)`

**Example for **`[[1, 26]]`

```json
{
    "product": [
        [
            "B",
            "AA"
        ]
    ]
}
```

## How to run tests

```bash
$ php artisan test
```

## Technical Details
* PHP 7.4 
* Laravel
* PSR-12 coding standard
* strict type hinting
* unit tests
