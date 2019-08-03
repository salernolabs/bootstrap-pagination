# pagination

A simple library that wraps some common pagination stuff and can build bootstrap HTML. Yes I know a billion of these exist, I've been offloading old code into individual tested libraries for organization purposes as I move some sites over to Symfony. I may add more formatters at some point, I've been playing with material ui as well, but its not here yet. PR's welcome.

## Installation

    composer require salernolabs/pagination
    
## How to Use

The idea is to build a pagination object (base or formatted), input some values, retrieve all the pagination info plus html you want.

### Base Pagination Class

The constructor takes several optional arguments. They can also be set with set* methods.

    $p = new \SalernoLabs\Pagination\Pagination(
      $pageNumber,
      $numberOfItemsPerPage,
      $totalItems
    );

Get all the calculated pagination data with `$p->getPaginationData()`;

### PageData Response Class

The `->getPaginationData()` method will return the [PageData](src/PageData.php) response object. The following methods are available on this object:

| Method | Return Type | Info |
|--------|------|-------|
| `getPageNumber()` | int | The current page number, unless it exceeds calculated total pages in which case the last page number is returned. |
| `getTotalItems()` | int | The total number of items, this is what you originally entered |
| `getItemsPerPage()` | int | The total number of items per page, this is what you originally entered. |
| `getOffset()` | int | The calculated database row offset value, suitable for queries |
| `getTotalPages()` | int |  The calculated total number of pages |
    
### BootstrapHTML Generator

The [BootstrapHTML](src/Formatter/BootstrapHTML.php) formatter object extends the base pagination class and provides an extra function for generating HTML suitable for raw output in a template.

#### `->generateOutput($paginationUrl, $pageNumberConstant, $additionalUrlData)`

This method will generate the output for you using the input parameters to format the urls. If your paginated URLs are of the format `/news/1` for page 1, `/news/2` etc, your first parameter would be `'/news/#'`.

If your URL format is more like `'/articles/index?pageNumber=44'` you could do `'/articles/index?pageNumber=#'`

If you need to change the value `#` in the url template, the second parameter can change it.

Finally the third parameter just adds extra stuff to the end of your URLs. 

#### Usage Example

    $articleCount = /* query article count */ 500;

    $pagination = new \SalernoLabs\Pagination\Formatter\BootstrapHTML();
    $pagination
        ->setPageNumber(1)
        ->setNumberOfItemsPerPage(20)
        ->setTotalItems($articleCount);
    $page = $pagination->getPaginationData();
    
    // eg. LIMIT $page->getOffset(), $page->getItemsPerPage()
    
    $paginationHTML = $page->generateOutput('/news/#', '#');

At this point you should have the HTML you need to output.

### Testing

Testing is just PHPunit. Example build with coverage report if you've loaded composer dev dependencies:

    php vendor/phpunit/phpunit/phpunit --coverage-html build/coverage-report
    
We aimed for 100% coverage in version 1.#